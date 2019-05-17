<?php
	// Création d'un DSN (Data Source Name)
	$dsn = 'mysql:host=csvillarhg416.mysql.db;dbname=csvillarhg416;port=3306;charset=utf8';
			
	try {
		// Instanciation d'un objet PDO
		$pdo = new PDO($dsn, 'csvillarhg416', 'egbeTsdPhFk5N95k');
	}
			
	//Gestion des erreurs
	catch (PDOException $exception) {
		echo 'Erreur : ' . $exception->getMessage() . '<br />';
		echo 'N° : ' . $exception->getCode() . '<br />';
		//mail('augereau.morgan42@gmail.com', 'PDOException', $exception->getMessage());
		exit('Erreur de connexion à la base de données');
	}

	//Requête pour créer la première table mod582_registered_add 
	$q = 'CREATE TABLE IF NOT EXISTS `mod582_registered_add` (
				`registered_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				`nickname` VARCHAR(20) NOT NULL,
				`mail` VARCHAR(45),
				`pass` VARCHAR(255),
				PRIMARY KEY (registered_id)
			)
			ENGINE=InnoDB';
			
	//On execute la requête
	$rows_affected=$pdo->exec($q);
			
	//Gestion si il y a des erreurs
	if ($rows_affected === FALSE) {
		print_r($pdo->errorInfo());
	} else {
		print_r($rows_affected);
	}

	//Requête pour créer la seconde table mod582_comments_add
	$q = 'CREATE TABLE IF NOT EXISTS `mod582_comments_add` (
				`comment_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				`text_comment` TEXT NOT NULL,
				`moderate` BOOL NOT NULL DEFAULT 0,
				`article_id` INT UNSIGNED NOT NULL,
				`pass` VARCHAR(255),
				PRIMARY KEY (comment_id)
			)
			ENGINE=InnoDB';
	
	$rows_affected=$pdo->exec($q);
			
	if ($rows_affected === FALSE) {
		print_r($pdo->errorInfo());
	} else {
		print_r($rows_affected);
	}


	