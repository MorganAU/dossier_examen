<?php 
	require $_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php';
	include $_SERVER['DOCUMENT_ROOT']. '/wp-content/themes/mh-magazine-lite/header.php';
?>
<h3>
	<div style="background-color:white">
		<div class="button">
			<center><input type="button" name="admin_button" value="Voir les derniers commentaires" onclick="self.location.href=coments_list.php"></center>
		</div>
		<div class="button">
			<center><input type="button" name="admin_button" value="Voir les comptes utilisateurs" onclick="self.location.href='users_list.php'"></center>
		</div>
		<div class="button">
			<center><input type="button" id="classic_button" name="logout_button" value="Déconnexion" onclick="button()" /></center>
		</div>
	</div>
	<script type="text/javascript">
		function button()
		{
			document.location.href="logout.php";
		}
	</script>

<?php 
	if ($_SERVER['SCRIPT_NAME'] == '/logged_admin.php') {
	require $_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php';
	include $_SERVER['DOCUMENT_ROOT']. '/wp-content/themes/mh-magazine-lite/footer.php';
	}
