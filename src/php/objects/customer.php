<?php
	class Customer 
	{ 
		private $id;
		private $nickname;
		private $mail;
		private $pass;
		private $status;
 
		public function __construct() 
		{
 
		}
 
		public function createUser($sNickname, $sMail, $sPass) 
		{
			$pdo = databaseConnect();
			$isA = 0;

			$q = $pdo->prepare('INSERT INTO mod582_registered_add (nickname, mail, pass, isA)
				  				VALUES (:nickname, :mail, :pass, :isA)');

			$q->bindParam(':nickname', $sNickname);
			$q->bindParam(':mail', $sMail);
			$q->bindParam(':pass', $sPass);
			$q->bindParam(':isA', $isA);

			$q->execute();
			
			if ($q->fetch() != false) {
				logoutLog('database_error');
			} else {
				logoutLog('registration_sucess');
			}
 
		}
 
		public function readUserByMail($sMail) 
		{
			$pdo = databaseConnect();
			
			$q = 'SELECT * FROM mod582_registered_add WHERE mail = "'. $sMail . '"';

			$result = $pdo->query($q);
			if($result->fetch() != false) {
				foreach  ($pdo->query($q) as $row) {
					$this->id = $row['registered_id'];
					$this->nickname = $row['nickname'];
					$this->mail = $row['mail'];
					$this->pass = $row['pass'] ;
				}
			}
		}

		public function readUserByNickname($sNickname) 
		{
			$pdo = databaseConnect();
			
			$q = 'SELECT * FROM mod582_registered_add WHERE nickname = "'. $sNickname . '"';

			$result = $pdo->query($q);
			if($result->fetch() != false) {
					foreach  ($pdo->query($q) as $row) {
					$this->id = $row['registered_id'];
					$this->nickname = $row['nickname'];
					$this->mail = $row['mail'];
					$this->pass = $row['pass'] ;
				}
			}
		}

		public function readUserStatus($sMail)
		{
			$pdo = databaseConnect();
			$metaKey = 'mod582_user_level';

			$q = $pdo->prepare('SELECT meta_value
								FROM mod582_usermeta AS meta
								INNER JOIN mod582_users AS user
								ON user.ID = meta.user_id
								WHERE user_email = :mail
								AND meta.meta_key = :metaKey');

			$q->bindParam(':mail', $sMail);
			$q->bindParam(':metaKey', $metaKey);

			if($q->execute() != false) {
				while ($row = $q->fetch()) {
					$this->setStatus($row['meta_value']);
				}	
			}
		}


		public function readAdmin($sMail) 
		{
			$pdo = databaseConnect();
			
			$q = 'SELECT * FROM mod582_users where user_email = "'. $sMail .'"';

			$result = $pdo->query($q);
			if($result->fetch() != false) {
				foreach  ($pdo->query($q) as $row) {
					$this->mail = $row['user_nicename'];
					$this->pass = $row['user_pass'];
					$this->status = $row['user_status'];
				}
			}

			var_dump($this);
		}
 

 
		public function updateCustomerSettings($sOldMail, $sLastname, $sName, $sAddress, $nCp, $sCity, $sMail) 
		{
 			$pdo = databaseConnect();
			
			$q = 'UPDATE customer 
				  SET customer_lastname = "'. $sLastname . '",
					  customer_name = "'. $sName . '",
					  customer_address = "'. $sAddress . '",
					  customer_cp = "'. $nCp . '",
					  customer_city = "'. $sCity . '",
					  customer_mail = "'. $sMail . '"
				  WHERE customer_mail = "'. $sOldMail . '"';
			$result = $pdo->exec($q);

		}
 
		public function updateCustomerPassword($sMail, $sNewPassword) 
		{
 			$pdo = databaseConnect();
			
			$q = 'UPDATE customer 
				  SET customer_pass = "'. $sNewPassword . '"
				  WHERE customer_mail = "'. $sMail . '"';
			$result = $pdo->exec($q);

		}
 
		public function deleteCustomer($sMail) 
		{
 			$pdo = databaseConnect();
			
			$q = 'DELETE FROM customer 
				  WHERE customer_mail = "'. $sMail . '"';
			$result = $pdo->exec($q);
		}
 
		/************************************************************
		*****					MUTATORS						*****
		************************************************************/

		public function setNickname($sNickname)
		{
			$this->nickname = $sNickname;
		}

		public function setMail($sMail)
		{
			$this->mail = $sMail;
		}

		public function setPass($sPass)
		{
			$this->pass = $sPass;
		}

		public function setStatus($nStatus)
		{
			$this->status = $nStatus;
		}

		
		/************************************************************
		*****					ACCESSORS						*****
		************************************************************/
		public function getId()
		{
			return $this->id;
		}

		public function getNickname()
		{
			return $this->nickname;
		}

		public function getMail()
		{
			return $this->mail;
		}

		public function getPass()
		{
			return $this->pass;
		}

		public function getStatus()
		{
			return $this->status;
		}


		public function getAdminPassWP()
		{
			$pdo = databaseConnect();
			
			$q = 'SELECT * FROM mod582_users ';

			$result = $pdo->query($q);
			if($result->fetch() != false) {
				foreach  ($pdo->query($q) as $row) {
					$this->mail = $row['user_nicename'];
					$this->pass = $row['user_pass'];
				}
			}

			var_dump($this);
		}
 
 
	}
 

