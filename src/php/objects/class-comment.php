<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/comment-add/sql_connect.php';

	class Comment 
	{ 
		private $id;
		private $idPost;
		private $author;
		private $moderate;
		private $content;
 
		public function __construct() 
		{
 			$this->author = 'anonyme';
 			if ($_SESSION['admin'] == 1) {
 				$this->moderate = 1;
 			} else {
 				$this->moderate = 0;
 			}
		}
 
		/*********************************************************************
		*								CREATE 								 *
		*********************************************************************/

		public function createComment() 
		{
			$pdo = databaseConnect();
			$q = $pdo->prepare('INSERT INTO mod582_comments_add (text_comment, moderate, article_id, author_id)
				  				VALUES (:comment, :moderate, :article, :author)');


			$q->bindParam(':comment', $this->getContent());
			$q->bindParam(':moderate', $this->getModerate());
			$q->bindParam(':article', $this->getIdPost());
			$q->bindParam(':author', $this->getAuthor());

			$q->execute();
			
			if ($q->fetch() != false) {
				logoutLog('database_error');
			} else {
				postLog('comment_posted');
			}
 
		}

		/*********************************************************************
		*								READ 								 *
		*********************************************************************/
 
		public function readUserByMail($sMail) 
		{
			$pdo = databaseConnect();
						
			$q = $pdo->prepare('SELECT * FROM mod582_user_coment_add WHERE mail = :mail');

			$q->bindParam(':mail', $sMail);

			if($q->execute() != false) {
				while ($row = $q->fetch()) {
					$this->setId($row['registered_id']);
					$this->setNickname($row['nickname']);
					$this->setMail($row['mail']);
					$this->setPass($row['pass']);
				}	
			}
		}

		public function freeNickname($sNickname)
		{
			$pdo = databaseConnect();
						
			$q = $pdo->prepare('SELECT registered_id FROM mod582_user_coment_add WHERE nickname = :nickname');

			$q->bindParam(':nickname', $sNickname);
			$id = null;
			if($q->execute() != false) {
				while ($row = $q->fetch()) {
					$id = $row['registered_id'];
				}	
			}
			return $id; 
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
			
			$q = $pdo->prepare('SELECT * FROM mod582_users WHERE user_email = :mail');

			$q->bindParam(':mail', $sMail);

			if($q->execute() != false) {
				while ($row = $q->fetch()) {
					$this->setMail($row['user_email']);
					$this->setPass($row['user_pass']);
					$this->setNickname($row['user_nicename']);
				}	
			}
		}

 		public function getAllComments()
		{
			$pdo = databaseConnect();
						
			$q = $pdo->prepare('SELECT * FROM mod582_comments_add');

			$aObjects = array();

			if($q->execute() != false) {
				$aObjects = $q->fetchAll();	
			}
			return $aObjects; 
		}


		/*********************************************************************
		*								UPDATE 								 *
		*********************************************************************/

		public function updateUser($sNickname, $sMail, $sOldMail) 
		{
 			$pdo = databaseConnect();
			
			$q = $pdo->prepare('UPDATE mod582_user_coment_add
								SET nickname = :nickname,
									mail = :mail,
									pass = :pass
								WHERE mail = :oldMail');

			$sPassHash = password_hash($sPass, PASSWORD_DEFAULT);
			$q->bindParam(':nickname', $sNickname);
			$q->bindParam(':mail', $sMail);
			$q->bindParam(':pass', $sPassHash);
			$q->bindParam(':oldMail', $sOldMail);

			$q->execute();
			
			if ($q->fetch() != false) {
				logoutLog('database_error');
			} else {
				loginLog('update_sucess');
			}

		}
 
		public function updatePassUser($sMail, $sNewPassword) 
		{
 			$pdo = databaseConnect();
			
			$q = $pdo->prepare('UPDATE mod582_user_coment_add
								SET pass = :pass
								WHERE mail = :mail');

			$sNewPassword = password_hash($sPass, PASSWORD_DEFAULT);
			$q->bindParam(':mail', $sMail);
			$q->bindParam(':pass', $sNewPassword);

			$q->execute();
			
			if ($q->fetch() != false) {
				logoutLog('database_error');
			} else {
				loginLog('update_sucess');
			}

		}

		/*********************************************************************
		*								DELETE 								 *
		*********************************************************************/

		public function deleteUser($sMail) 
		{
 			$pdo = databaseConnect();
			
			$q = $pdo->prepare('DELETE FROM mod582_user_coment_add 
				 				WHERE mail = :mail');

			$q->bindParam(':mail', $sMail);

			$q->execute();
			
			if ($q->fetch() != false) {
				logoutLog('database_error');
			} else {
				logoutLog('delete_success');
			}

		}

		

		/************************************************************
		*****					MUTATORS						*****
		************************************************************/

		public function setIdPost($sIdPost)
		{
			$this->idPost = $sIdPost;
		}

		public function setAuthor($sAuthor)
		{
			$this->author = $sAuthor;
		}

		public function setModerate($bModerate)
		{
			$this->moderate = $bModerate;
		}

		public function setContent($sContent)
		{
			$this->content = $sContent;
		}

		/************************************************************
		*****					ACCESSORS						*****
		************************************************************/
		public function getId()
		{
			return $this->id;
		}

		public function getIdPost()
		{
			return $this->idPost;
		}

		public function getAuthor()
		{
			return $this->author;
		}

		public function getModerate()
		{
			return $this->moderate;
		}

		public function getContent()
		{
			return $this->content;
		}

	}
 

