<?php 

	if (!isset($_SESSION['connect']) || $_SESSION['connect'] == 0){
		include 'sql_connect.php';
		include 'log.php';
		include 'objects/customer.php';

		if (!session_id()) {
			session_start();
		}

		
		$sMail = $_SESSION['mail'] = $_POST['mail'];
		$sPassword = $_SESSION['password'] = $_POST['password'];

		//Vérifie si ce mail fait parti d'un compte admin
		$user = new Customer();

		$user->setMail($sMail); 
		$bIsAdmin = $user->readUserStatus($sMail);




		var_dump($user);die();
		if (empty($_POST['mail']) || empty($_POST['password'])) {
			$_SESSION['connect'] = 0;
			logoutLog('empty_var');
		} else {
			if (existingMail()) {
				$user->readUserByMail($sMail);

				$nickNameRecup = $_SESSION['nickname'] = $user->getNickname();
				$mailRecup = $user->getMail();
				$passRecup = $user->getPass();

				if ($mailRecup == $sMail && password_verify($sPassword, $passRecup)) {
					$_SESSION['connect'] = 1;
					if ($mailRecup == $aRecupAdmin['mail'] && password_verify($sPassword, $aRecupAdmin['pass'])) {
						$_SESSION['admin'] = 1;
						loginLog('welcome_admin');
					} else {
						$_SESSION['admin'] = 0;
						loginLog('welcome_message');
					}
				} else {
					$_SESSION['connect'] = 0;
					logoutLog('error_connect');
				}
			} else {
				$_SESSION['connect'] = 0;
				logoutLog('wrong_mail');
			}
		}
	} else {
		header('Location: not_logged_switch.php');	
	}


	?>