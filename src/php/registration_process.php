<?php 
	include 'sql_connect.php';
	include 'log.php';

	if (session_id()) {
		session_start();
	}

	$_SESSION['nickname'] = $_POST['nickname'];
	$_SESSION['mail'] = strtolower($_POST['mail']);
	$sPassword = $_SESSION['password'] = $_POST['password'];
	$sPasswordForVerify = $_SESSION['passwordForConfirm'] = $_POST['passwordForConfirm'];

	isset($_SESSION['nickname']) ? $_SESSION['nickname'] = $_POST['nickname'] : $_SESSION['nickname'] = "";
	isset($_SESSION['mail']) ? $_SESSION['mail'] = $_POST['mail'] : $_SESSION['mail'] = "";
	isset($_SESSION['password']) ? $_SESSION['password'] = $_POST['password'] : $_SESSION['password'] = "";
	isset($_SESSION['passwordForConfirm']) ? $_SESSION['passwordForConfirm'] = $_POST['passwordForConfirm'] : $_SESSION['name'] = "";

	if (empty($_POST['nickname']) || empty($_POST['mail']) || empty($_POST['password']) || empty($_POST['passwordForConfirm'])) {
		logoutLog('empty_registering_var');
	} else if ($sPassword != $sPasswordForVerify) {
		logoutLog('error_passwords');
	} else if (!existingMail()) {
		if(!existingNickname()) {
			addUser();
		} else {
			logoutLog('already_existing_nickname');
		}
	} else {
		logoutLog('already_existing_mail');
	}

	?>