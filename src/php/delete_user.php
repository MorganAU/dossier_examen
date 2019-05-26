<?php 
	include 'sql_connect.php';
	include 'log.php';
	include 'objects/class-user.php';

	if (session_id()) {
		session_start();
	}


	$user = new User();

	$user->setId($_POST['id']);

	if ($user->getId() != null) {
		$user->deleteUser($user->getId());
		adminLog('delete_success');
	}



/**************************************
**		Fonction pour envoyer un mail de confirmation à l'utilisateur pour son compte supprimé
**************************************/