<?php
	require('./wp-blog-header.php');
	include $_SERVER['DOCUMENT_ROOT']."/wp-content/themes/mh-magazine-lite/header.php";

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
	
		echo '<h3><div style="background-color:white">';
		switch ($sOption) {
			case 'disconnect':
				echo 'Vous êtes déconnecté. À bientôt !';
				header( 'refresh:3;url=https://' . $_SERVER['HTTP_HOST']);
				break;
			
			case 'error_connect':
				echo 'Erreur de connexion !';
				header( 'refresh:3;url=' . $_SERVER['HTTP_REFERER']);
				break;
			
			case 'empty_var':
				echo 'Certains champs sont vides !';
				header( 'refresh:3;url=' . $_SERVER['HTTP_REFERER']);
				break;
			
			case 'error_passwords':
				echo 'Les mots de passe ne correspondent pas';
				header( 'refresh:3;url=' . $_SERVER['HTTP_REFERER']);
				break;

			case 'empty_registering_var':
				echo 'Certains champs sont vides !';
				header( 'refresh:3;url=' . $_SERVER['HTTP_REFERER']);
				break;
			
			case 'database_error':
				echo 'Un problème est survenu, essayez ultèrieurement !';
				header( 'refresh:3;url=' . $_SERVER['HTTP_REFERER']);
				break;
			
			case 'wrong_mail':
				echo 'Cet utilisateur n\'existe pas !';
				header( 'refresh:3;url=' . $_SERVER['HTTP_REFERER']);
				break;
			
			case 'already_existing_mail':
				echo 'Ce mail est déjà utilisé, veuillez en choisir un autre';
				header( 'refresh:3;url=' . $_SERVER['HTTP_REFERER']);
				break;
			
			case 'already_existing_nickname':
				echo 'Ce pseudo est déjà utilisé, veuillez en choisir un autre';
				header( 'refresh:3;url=' . $_SERVER['HTTP_REFERER']);
				break;
			
			case 'registration_sucess':
				echo 'Inscription réussite, veuillez vous connecter !';
				header( 'refresh:3;url=' . $_SESSION['path']);
				break;
			
			case 'error_between_pass':
				echo 'Les mots de passe ne correspondent pas';
				header( 'refresh:3;url=' . $_SESSION['path']);
				break;
			
			case 'already_existing_mail_update':
				echo 'Ce mail est déjà utilisé, veuillez en choisir un autre';
				header( "refresh:3;url=update_customer.php" );
				break;
			
			case 'pass_update':
				echo 'Mot de passe modifié, veuillez vous reconnecter';
				header( "refresh:3;url=index.php" );
				break;
			
			case 'delete_success':
				echo 'Votre compte à bien été supprimé, nous sommes tristes de vous voir partir :(';
				header( 'refresh:3;url=' . $_SERVER['HTTP_REFERER']);
				break;

			default:
				echo 'Erreur inconnu !';
				header( 'refresh:3;url=https://' . $_SERVER['HTTP_HOST']);
		}

		echo '</div></h3>';

		destroySession();
		require('./wp-blog-header.php');
		include $_SERVER['DOCUMENT_ROOT']."/wp-content/themes/mh-magazine-lite/footer.php";
	}

	function loginLog($sOption) 
	{
		$_SESSION['connect'] = 1;
		echo '<h3><div style="background-color:white">';

		switch ($sOption) {			
			case 'welcome_message':
				echo '<h3>Vous êtes connecté ' . $_SESSION['nickname'] . '</h3>';
				header( 'refresh:3;' . $_SESSION['path']);
				break;
			
			case 'welcome_admin':
				echo '<h3>Vous êtes connecté sur le compte Administrateur</h3>';
				header( 'refresh:3;url=logged_admin.php');
				break;
			
			case 'update_sucess':
				echo '<h3>Informations mises à jour</h3>';
				header( "refresh:3;url=update_user.php" );
				break;
			
			default:
				echo 'Erreur inconnu !';
				header( 'refresh:3;url=https://' . $_SERVER['HTTP_HOST']);
		}
		echo '</div></h3>';

		require('./wp-blog-header.php');
		include $_SERVER['DOCUMENT_ROOT']."/wp-content/themes/mh-magazine-lite/footer.php";
	}

	function postLog($sOption) 
	{
		$_SESSION['connect'] = 1;
		echo '<h3><div style="background-color:white">';

		switch ($sOption) {			
			case 'comment_posted':
				echo '<h3>Commentaire ajouté</h3>';
				header( 'refresh:3;url=' . $_SERVER['HTTP_REFERER']);
				break;
			
			default:
				echo 'Erreur inconnu !';
				header( 'refresh:3;url=https://' . $_SERVER['HTTP_HOST']);
		}
		echo '</div></h3>';

		require('./wp-blog-header.php');
		include $_SERVER['DOCUMENT_ROOT']."/wp-content/themes/mh-magazine-lite/footer.php";
	}

	function registerErrorLog($sOption)
	{
		$_SESSION['connect'] = 0;
	
		echo '<h3><div style="background-color:white">';
		switch ($sOption) {
			case 'empty_registering_var':
				echo 'Certains champs sont vides !';
				header( 'refresh:3;url=' . $_SERVER['HTTP_REFERER']);
				break;
			
			case 'database_error':
				echo 'Un problème est survenu, essayez ultèrieurement !';
				header( 'refresh:3;url=' . $_SERVER['HTTP_REFERER']);
				break;
			
			case 'already_existing_mail':
				echo 'Ce mail est déjà utilisé, veuillez en choisir un autre';
				header( 'refresh:3;url=' . $_SERVER['HTTP_REFERER']);
				break;
			
			case 'already_existing_nickname':
				echo 'Ce pseudo est déjà utilisé, veuillez en choisir un autre';
				header( 'refresh:3;url=' . $_SERVER['HTTP_REFERER']);
				break;
			
			case 'registration_sucess':
				echo 'Inscription réussite, veuillez vous connecter !';
				header( 'refresh:3;url=' . $_SESSION['path']);
				break;
			
			case 'error_between_pass':
				echo 'Les mots de passe ne correspondent pas';
				header( 'refresh:3;url=' . $_SESSION['path']);
				break;
			
			default:
				echo 'Erreur inconnu !';
				header( 'refresh:3;url=https://' . $_SERVER['HTTP_HOST']);
		}
		echo '</div></h3>';

		require('./wp-blog-header.php');
		include $_SERVER['DOCUMENT_ROOT']."/wp-content/themes/mh-magazine-lite/footer.php";
	}

	