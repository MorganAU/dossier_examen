<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/comment-add/objects/class-comment.php';

	$aComment = array();

	$comments = new User();

	$aComment = $comments->getAllComments();

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
					<td>' . $aComment[$i]['author_id'] . '</td>
					<td>' . $aComment[$i]['test_comment'] . '</td>
			';
		}

	?>
		
	</tr>
</table></center></div>
