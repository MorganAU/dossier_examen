<?php
	function destroySession()
	{
		if (!empty($_SESSION['mail'])) {
		unset($_SESSION['mail']);
		}
		if (!empty($_SESSION['password'])) {
			unset($_SESSION['password']);
		}
		if (!empty($_SESSION['nicknameRecup'])) {
			unset($_SESSION['nicknameRecup']);
		}
		if (!empty($_SESSION['nickname'])) {
			unset($_SESSION['nickname']);
		}
		if (!empty($_SESSION['mailRecup'])) {
			unset($_SESSION['mailRecup']);
		}
		if (!empty($_SESSION['passRecup'])) {
			unset($_SESSION['passRecup']);
		}
		if (!empty($_SESSION['passwordConfirm'])) {
			unset($_SESSION['passwordConfirm']);	
		}
		if (!empty($_SESSION['admin'])) {
			unset($_SESSION['admin']);	
		}
		
		if(session_id()) {
			session_destroy();		
		}

	}

	function logoutLog($sOption) 
	{		
		if(!session_id()) {
			session_start();
		}
		$_SESSION['connect'] = 0;
	

		switch ($sOption) {
			case 'disconnect':
				echo 'Vous êtes déconnecté. À bientôt !';
				header( "refresh:3;url=not_logged_switch.php" );
				break;
			
			case 'error_connect':
				echo 'Erreur de connexion !';
				header( "refresh:3;url=not_logged_switch.php" );
				break;
			
			case 'empty_var':
				echo 'Certains champs sont vides !';
				header( "refresh:3;url=not_logged_switch.php" );
				break;
			
			case 'error_passwords':
				echo 'Les mots de passe ne correspondent pas';
				header( "refresh:3;url=registered_form.html" );
				break;

			case 'empty_registering_var':
				echo 'Certains champs sont vides !';
				header( "refresh:3;url=registered_form.html" );
				break;
			
			case 'database_error':
				echo 'Un problème est survenu, essayez ultèrieurement !';
				header( "refresh:3;url=not_logged_switch.php" );
				break;
			
			case 'wrong_mail':
				echo 'Cet utilisateur n\'existe pas !';
				header( "refresh:3;url=not_logged_switch.php" );
				break;
			
			case 'already_existing_mail':
				echo 'Ce mail est déjà utilisé, veuillez en choisir un autre';
				header( "refresh:3;url=registered_form.html" );
				break;
			
			case 'already_existing_nickname':
				echo 'Ce pseudo est déjà utilisé, veuillez en choisir un autre';
				header( "refresh:3;url=registered_form.html" );
				break;
			
			case 'registration_sucess':
				echo 'Inscription réussite, veuillez vous connecter !';
				header( "refresh:3;url=not_logged_switch.php" );
				break;
			
			case 'error_between_pass':
				echo 'Les mots de passe ne correspondent pas';
				header( "refresh:3;url=registered_form.php" );
				break;
			
			case 'emptyVarPasswords':
				echo 'Certains champs de mot de passe sont vides !';
				header( "refresh:3;url=registered_form.php" );
				break;
			
			case 'already existing mail update':
				echo 'Ce mail est déjà utilisé, veuillez en choisir un autre';
				header( "refresh:3;url=update_customer.php" );
				break;
			
			case 'pass update':
				echo 'Mot de passe modifié, veuillez vous reconnecter';
				header( "refresh:3;url=index.php" );
				break;
			
			case 'delete_success':
				echo '<h3>Votre compte à bien été supprimé, nous sommes tristes de vous voir partir :(</h3>';
				header( "refresh:3;url=not_logged_switch.php" );
				break;

			default:
				echo 'Erreur inconnu !';
				header( "refresh:3;url=not_logged_switch.php" );
				break;
		}

		destroySession();
	}

	function loginLog($sOption) 
	{
		$_SESSION['connect'] = 1;

		switch ($sOption) {			
			case 'welcome_message':
				echo '<h3>Vous êtes connecté ' . $_SESSION['nickname'] . '</h3>';
				header( "refresh:3;url=not_logged_switch.php" );
				break;
			
			case 'welcome_admin':
				echo '<h3>Vous êtes connecté sur le compte Administrateur</h3>';
				header( "refresh:3;url=not_logged_switch.php" );
				break;
			
			case 'update_sucess':
				echo '<h3>Informations mises à jour</h3>';
				header( "refresh:3;url=update_user.php" );
				break;
			
			default:
				echo 'Erreur inconnu !';
				header( "refresh:3;url=not_logged_switch.php" );
				break;
		}
	}


