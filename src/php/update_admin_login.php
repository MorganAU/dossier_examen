<?php 
	include 'sql_connect.php';
	include 'disconnect_process.php';

	if (isset($_SESSION['connect']) && $_SESSION['connect'] != 0 ) {
		$_SESSION['newMail'] = strtolower($_POST['mail']);

	if ($_SESSION['admin'] == 0) {
		$_SESSION['newLastname'] = $_POST['lastname'];
		$_SESSION['newName'] = $_POST['name'];
		$_SESSION['newStreet'] = $_POST['street'];
		$_SESSION['newCp'] = $_POST['cp'];
		$_SESSION['newCity'] = $_POST['city'];

		isset($_SESSION['newLastname']) ? $_SESSION['newLastname'] = $_POST['lastname'] : $_SESSION['newLastname'] = "";
		isset($_SESSION['newName']) ? $_SESSION['newName'] = $_POST['name'] : $_SESSION['newName'] = "";
		isset($_SESSION['newStreet']) ? $_SESSION['newStreet'] = $_POST['street'] : $_SESSION['newStreet'] = "";
		isset($_SESSION['newCp']) ? $_SESSION['newCp'] = $_POST['cp'] : $_SESSION['newCp'] = "";
		isset($_SESSION['newCity']) ? $_SESSION['newCity'] = $_POST['city'] : $_SESSION['newCity'] = "";
	} else {
		$_SESSION['newLastname'] = 'admin';
		$_SESSION['newName'] = '';
		$_SESSION['newStreet'] = '';
		$_SESSION['newCp'] = '';
		$_SESSION['newCity'] = '';
	}
		

		if (empty($_POST['mail'])) {
			$_SESSION['newMail'] = $_SESSION['mail'];
		} else if (!empty($_POST['mail'])) {
			if (existingMailForUpdate()) {
				updateCustomer();
				$_SESSION['mail'] = $_SESSION['newMail'];
				errorUpdateForm('updated_success');
			} else {
			errorUpdateForm('already existing mail');
			}
		} else {
			errorUpdateForm('other');
		}
	} else {
		header('Location: connect.php');						
	}


	



