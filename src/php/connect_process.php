<?php 
	include 'sql_connect.php';
	include 'log.php';
	include 'objects/class-user.php';
	include 'wp-includes/class-phpass.php';
	
	
	if (!session_id()) {
		session_start();
	}



	if (!isset($_SESSION['connect']) || $_SESSION['connect'] == 0) {
		
		$sMail = $_POST['mail'];
		$sPassword = $_POST['password'];

		if (empty($_POST['mail']) || empty($_POST['password'])) {
			// Si un des champs est vide on l'affiche à l'utilisateur
			logoutLog('empty_var');
		} else {
			//Vérifie si ce mail fait parti d'un compte admin
			// Instanciation d'un objet Customer
			$user = new User();

			// On récupère son status
			$user->setMail($sMail); 
			$user->readUserStatus($sMail);
				
			// Si son statut est égal à 10, c'est un admnin
			if ($user->getStatus() == 10) {
				// On récupère les infos
				$user->readAdmin($sMail);
				$sMailRecup = $user->getMail();
				$sPassRecup = $user->getPass();

				// On instancie un objet PasswordHash d'une classe native à WP
				$wp_hasher = new PasswordHash(8, TRUE);

				// On utilise sa méthode Checkout() pour vérifier la concordance des deux mots de passe
				if ($sMail == $sMailRecup && $wp_hasher->CheckPassword($sPassword, $sPassRecup)) {
					$_SESSION['connect'] = 1;
					$_SESSION['admin'] = 1;

					// Si tout est bon l'admin peut se connecter
					loginLog('welcome_admin');
				} else {
					logoutLog('error_connect');
				}
			} else if ($user->getStatus() != 10) {
				// On fait la même chose pour un utilisteur classique
				$user->readUserByMail($sMail);

				if ($user->getId() != null) {
					$sMailRecup = $user->getMail();
					$sPassRecup = $user->getPass();

					$wp_hasher = new PasswordHash(8, TRUE);

					if ($sMail == $sMailRecup && $wp_hasher->CheckPassword($sPassword, $sPassRecup)) {
						$_SESSION['connect'] = 1;
						$_SESSION['admin'] = 0;
						$_SESSION['nickname'] = $user->getNickname();
						loginLog('welcome_message');
					} else {
						logoutLog('error_connect');
					}
				} else {
					logoutLog('wrong_mail');
				}
			}
		}
	} else {
		header('Location:' . $_SERVER['HTTP_REFERER']);	
	}

	