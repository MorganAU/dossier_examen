<?php 
	include $_SERVER['DOCUMENT_ROOT'] . '/comment-add/sql_connect.php';
	include $_SERVER['DOCUMENT_ROOT'] . '/comment-add/log.php';
	include $_SERVER['DOCUMENT_ROOT'] . '/comment-add/objects/class-user.php';

	if (session_id()) {
		session_start();
	}

	$sNickname = $_POST['nickname'];
	$sMail = $_POST['mail'];
	$sPassword = $_POST['password'];

	$newUser = new User();

	$newUser->setNickname($sNickname);
	$newUser->setMail($sMail);

	$sPassword = $_POST['password'];
	$sPasswordForVerify = $_POST['passwordForConfirm'];

	$newUser->readUserByMail($sMail);

	if ($newUser->getNickname() == null || $newUser->getMail() == null || empty($_POST['password']) || empty($_POST['passwordForConfirm'])) {
		registerErrorLog('empty_registering_var');
	} else {
		if ($sPassword != $sPasswordForVerify) {
			registerErrorLog('error_between_pass');
		} else if ($newUser->getId() == null) {
			if($newUser->freeNickname($sNickname) == null) {
				$newUser->createUser($newUser->getNickname(), $newUser->getMail(), $sPassword);
			} else {
				registerErrorLog('already_existing_nickname');
			}
		} else {
			registerErrorLog('already_existing_mail');
		}
	}
