<?php 
	include 'objects/class-comment.php';
	include 'log.php';

	if (!session_id()) {
		session_start();
	}
	
	if ($_SESSION['connect'] == 1) {
		$sAuthor = $_SESSION['nickname'];
		$sComment = $_POST['comment'];
		$nPostId = $_SESSION['post_id'];

		$newComment = new Comment();

		$newComment->setIdPost($nPostId);
		$newComment->setAuthor($sAuthor);
		$newComment->setContent($sComment);

		$newComment->createComment();
	} else {
		logoutLog('unknow_error');
	}

