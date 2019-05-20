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
<center><table>
	<tr>
		<th>Id</th>
		<th>Pseudo</th>
		<th>Email</th>
		<th>Mot de passe</th>
	</tr>
	<?php
		for ($i = 0, $c = count($aUsers) ; $i < $c ; $i++) {
			echo '
				<tr>
					<td>' . $aUsers[$i]['registered_id'] . '</td>
					<td>' . $aUsers[$i]['nickname'] . '</td>
					<td>' . $aUsers[$i]['mail'] . '</td>
					<td><input type="button" name="admin_button" value="Changer le mot de passe" onclick="button()"></td>
			';
		}

	?>
		
	</tr>
</table></center>
<script type="text/javascript">
	function button()
	{
		document.location.href="mail_for_pass.php";
	}
</script>
