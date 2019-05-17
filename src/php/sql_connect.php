<?php

	function databaseConnect() 
	{
		include_once 'config.php';

		$dsn = 'mysql:host='. DB_HOST . ';dbname=' . DB_NAME . ';port=3306;charset=' . DB_CHARSET;
		try {
			$pdo = new PDO($dsn, DB_USER, DB_PASSWORD);

		}
		catch (PDOException $exception) {
			echo 'Error : ' . $exception->getMessage() . '<br />';
			echo 'N° : ' . $exception->getCode() . '<br/>';
			logoutLog('database_error');
		}

		return $pdo;
	}

	function getAdminSettings() 
	{
		include_once 'objects/customer.php';
		$config = array();

		$pdo = databaseConnect();

		$admin = new Customer();

		$admin->readAdmin();

		$config = [
				'mail' => $admin->getMail(),
				'pass' => $admin->getPass()
			];

		if(!empty($config)) {
			return $config;
		} else {
			return 0;
		}
	}

	function existingMail()
	{
		require_once 'config.php';
		include_once 'objects/customer.php';
		
		$sUserMail = $_SESSION['mail'];
		$config = array();

		$existingCustomer = new Customer();

		$existingCustomer->readUserByMail($sUserMail);

		if ($existingCustomer->getMail() != NULL) {
			$config = [
				'mail' => $existingCustomer->getMail()
			];
		}
		if(!empty($config)) {
			return 1;
		} else {
			return 0;
		}

	}

	function existingNickname()
	{
		require_once 'config.php';
		include_once 'objects/customer.php';
		
		$sUserNickname = $_SESSION['nickname'];
		$config = array();

		$existingCustomer = new Customer();

		$existingCustomer->readUserByNickname($sUserNickname);

		if ($existingCustomer->getNickname() != NULL) {
			$config = [
				'nickname' => $existingCustomer->getNickname()
			];
		}

		if(!empty($config)) {
			return 1;
		} else {
			return 0;
		}

	}

	function addUser() {
		require_once 'config.php';
		include_once 'log.php';
		$sUserNickname = $_SESSION['nickname'];
		$sUserMail = $_SESSION['mail'];
		$sUserPass = $_SESSION['password'];
		$sPassHash = password_hash($sUserPass, PASSWORD_DEFAULT);

		$newUser = new Customer();

		$newUser->createUser($sUserNickname, $sUserMail, $sPassHash);

	}
	

	function getUserConfig() {
		require_once 'wp-config.php';
		include_once 'disconnect_process.php';
		$sUserMail = $_SESSION['mail'];

		$pdo = databaseConnect();
		
		$q = 'SELECT * FROM mod582_registered_add WHERE mail = "'. $sUserMail . '"';
		
		$result = $pdo->query($q);
		
		if($result->fetch() == false) {
			logoutSession('wrong mail');	
		} else {
			foreach  ($pdo->query($q) as $row) {
				$_SESSION['nicknameRecup'] = $row['nickname'];
				$_SESSION['mailRecup'] = $row['mail'];
				$_SESSION['passRecup'] = $row['pass'];
  			
			}	
		}

	}

	function getCanUseData() {
		require_once 'wp-config.php';
		include_once 'disconnect_process.php';
		$sUserMail = $_SESSION['mail'];
		$sUserNickname = $_SESSION['nickname'];

		$pdo = databaseConnect();

		$qMail = 'SELECT * FROM mod582_registered_add 
			  WHERE mail = "' . $sUserMail . '"';
		
		$qNickmane = 'SELECT * FROM mod582_registered_add 
			  WHERE nickname = "'. $sUserNickname . '"';
		
		$resultMail = $pdo->query($qMail);
		$resultNickmane = $pdo->query($qNickmane);

		if($resultMail->fetch() != false) {
			logoutSession('already existing mail');
		} else if($resultNickmane->fetch() != false) {
			logoutSession('already existing nickname');
		} else {
			addUser();
		}

	}


	
