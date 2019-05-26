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
		<input type="button" id="classic_button" name="logout_button" value="Déconnexion" onclick="button()" /> 
	</form>
	<script type="text/javascript">
		function button()
		{
			document.location.href="https://csvillars42.fr/logout.php";
		}
	</script>
</body>
</html>

