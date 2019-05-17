<!DOCTYPE html>
<html>
<head></head>
<header></header>
<body>
	<?php 
		include_once 'sql_connect.php';
		include_once 'customer.php';

		if (isset($_SESSION['connect']) && $_SESSION['connect'] == 1 && $_SESSION['admin'] == 1) {
			echo '
			<div id="center">
				<center id="main">
					<form action="update_process.php" method="post">
						<h1>Identifiants de connexion</h1>
						<h2>Votre adresse mail</h2>
						<input type="email" placeholder="Votre email" name="mail" maxlength="40" size="40"  value="' . $customerSettings['mail'] . '" /><br />
						<button class="loginButton" type="submit">Sauvegarder</button>
					</form>
				</center>
			</div>
				';
				$admin = new Customer();
				$admin->readAdmin();
				var_dump($admin);
			} else {
				header('Location: connect.php');	
			}
	?>
	<br />
</body>
	<?php include_once("include/footer.php"); ?>
</html>
