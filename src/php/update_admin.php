<!DOCTYPE html>
<html>
<head></head>
<header></header>
<body>
	<?php 
		include_once 'sql_connect.php';
		include_once 'objects/customer.php';

		if(!session_id()) {
			session_start();
		}

		var_dump($_SESSION);

		if (isset($_SESSION['connect']) && $_SESSION['connect'] == 1 && $_SESSION['admin'] == 1) {
			
				$admin = new Customer();
				$admin->readAdmin();
			echo '
				<div id="center">
					<center id="main">
						<h1>Identifiants de connexion</h1>
						<h2>Votre adresse mail</h2>
						<input type="email" placeholder="Votre email" name="mail" maxlength="40" size="40"  value="' . $admin->getMail() . '" /><br />
						<input type="button" name="button" value="Sauvegarder" onclick="self.location.href=update_admin_login.php" style="background-color:#3cb371" style="color:white; font-weight:bold"onclick> 
						<h2>Votre mot de passe</h2>
						<input type="password" placeholder="Ancien mot de passe" name="oldPass" maxlength="40" size="40" /><br />
						<input type="password" placeholder="Nouveau mot de passe" name="newPass" maxlength="40" size="40" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{12,40}$"/><br />
						<input type="password" placeholder="Vérifier le nouveau mot de passe" name="newPassConfirm" maxlength="40" size="40" /><br />
						<input type="button" name="button" value="Sauvegarder" onclick="self.location.href=" style="background-color:#3cb371" style="color:white; font-weight:bold"onclick> 
					</center>
				</div>
				';
				var_dump($admin);
		} else {
			//header('Location: connect.php');	
		}
	?>
	<br />
</body>
</html>
