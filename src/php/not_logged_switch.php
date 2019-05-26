<?php
	
	if(!session_id()) {
		session_start();
	}


	if (isset($_SESSION['connect']) && isset($_SESSION['admin'])) {
		if ($_SESSION['connect'] == 1 && $_SESSION['admin'] == 0) {
			include 'logged_post_comment.php';
		} else if ($_SESSION['connect'] == 1 && $_SESSION['admin'] == 1) {
			include 'logged_admin.php';
		}
	} else {
		include 'not_logged_post_comment.html';
	}

