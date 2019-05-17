<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h3>Vous êtes connecté <?php echo $_SESSION['nickname'] ?></h3>

	<form action="comment_send_process.php" method="POST">
		<input type="textarea" placeholder="Votre commentaire" name="comment" style="width:100%" /><br />
		<input type="submit" name="submit" value="Envoyer un commentaire" class="bouton">
	</form>
</body>	<input type="button" name="logout_button" value="Déconnexion" onclick="self.location.href='logout.php'" style="background-color:#3cb371" style="color:white; font-weight:bold"onclick> 

</html>


<!-- Problème avec le bouton de déconnection -->
