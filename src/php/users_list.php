<?php
	include_once 'logged_admin.php';
	include_once 'objects/class-user.php';

	$aUsers = array();

	$users = new User();

	$aUsers = $users->getAllUsers();

?>
<style type="text/css">
	table, th, td {
		border: 1px solid black;
		padding: 5px;
	}
</style>
<div style="background-color:white">
<center><table>
	<tr>
		<th>Id</th>
		<th>Pseudo</th>
		<th>Email</th>
		<th>Mot de passe</th>
		<th>Supprimer</th>
	</tr>
	<?php
		for ($i = 0, $c = count($aUsers) ; $i < $c ; $i++) {
			echo '
				<tr>
					<td>' . $aUsers[$i]['registered_id'] . '</td>
					<td>' . $aUsers[$i]['nickname'] . '</td>
					<td>' . $aUsers[$i]['mail'] . '</td>
					<td><input type="button" name="admin_button" value="Changer le mot de passe" onclick="button()"></td>
					<td><input type="button" name="admin_button" value="Supprimer le profil" onclick="button()"></td>
			';
		}

	?>
		
	</tr>
</table></center></div>
<script type="text/javascript">
	function button()
	{
		document.location.href="mail_for_pass.php";
	}
</script>
<?php 
	require('./wp-blog-header.php');
	include $_SERVER['DOCUMENT_ROOT']."/wp-content/themes/mh-magazine-lite/footer.php";
?>
