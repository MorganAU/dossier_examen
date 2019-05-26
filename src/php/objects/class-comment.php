<?php
	include_once 'sql_connect.php';

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
 
		public function getAllComments($idPost)
		{
			$pdo = databaseConnect();
						
			$q = $pdo->prepare('SELECT * FROM mod582_comments_add WHERE article_id = :id');

			$aObjects = array();
			$q->bindParam(':id', $idPost);



			if($q->execute() != false) {
				$aObjects = $q->fetchAll();	
			}
			return $aObjects; 
		}


		/*********************************************************************
		*								UPDATE 								 *
		*********************************************************************/

		
		/*********************************************************************
		*								DELETE 								 *
		*********************************************************************/

		
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
 

