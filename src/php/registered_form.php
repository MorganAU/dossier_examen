<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>
	<h3>Inscription</h3>

	<ul>
		<b>Le mot de passe doit contenir :</b>
		<li>Une majuscule</li>
		<li>Une minuscule</li>
		<li>Un caractère spéciale commme  !@#$%^&*_=+-</li>
		<li>Un chiffre</li>
		<li>Doit contenir entre 12 et 40 caractères</li>
	</ul>

	<form action="registration_process.php" method="POST">
		<input type="text" placeholder="Pseudo" name="nickname" maxlenght="20" size="40" /><br />
		<input type="email" pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" placeholder="Email" name="mail" title="Format Email" maxlength="40" size="40" /><br />
		<input type="password" placeholder="Mot de passe" name="password" maxlength="40" size="40" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{12,40}$"/><br />
		<input type="password" placeholder="Vérifier le mot de passe" name="passwordForConfirm" maxlength="40" size="40" /><br />
		<input type="submit" name="submit" value="Valider l'inscription" class="bouton">
		<input type="button" name="registration_button" value="Retour" onclick="self.location.href='not_logged_switch.php'" style="background-color:#3cb371" style="color:white; font-weight:bold"onclick> 
	</form>
</body>
</html>