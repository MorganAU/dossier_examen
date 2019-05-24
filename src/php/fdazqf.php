<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . '/comment-add/load_comment.php';
	if (!session_id()) {
		session_start();
	}
	if (empty($_SESSION['connect']) || $_SESSION['connect'] != 1) {
		
		echo '<!--<style>
				#classic_button {
					text-align: center;
					display: inline-block;
					min-width: 150px;
					font-weight: 700;
					color: #fff;
					padding: 10px 18px;
					background: #e64946;
					cursor: pointer;
					text-transform: uppercase;
					-webkit-transition: all 0.1s linear;
					-moz-transition: all 0.1s linear;
					transition: all 0.1s linear;
					border: 0;
					-webkit-appearance: none;
					border-radius: 5px;
					width: 200px;
					vertical-align: middle;
				}
				#classic_button:hover {
					background: #2a2a2a;
				}
				#pass {
					width:60%;
				}
				#pass:hover {
					border: 1px solid #e64946;
				}
			</style>
			<div style="background-color:white">
			<h3>Se connecter pour poster un commentaire</h3>
			<form action="connect_process.php" method="POST">
				<input type="email" placeholder="Email" name="mail" title="Format Email" maxlength="40" size="40" /><br />
				<input type="password" placeholder="Mot de passe" name="password" maxlength="40" size="40"/><br />
				<input type="submit" name="submit" value="Se connecter" class="bouton">
				<input type="button" name="registration_button" value="S\'inscrire" onclick="button()"> 
			</form>
			<script type="text/javascript">
					function button()
					{
						document.location.href="https://csvillars42.fr/logout.php";
					}
			</script>-->';
	}
?>	