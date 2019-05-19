<?php
	require '../sql_connect.php';
	include 'customer.php';
	include 'class-phpass.php';

	$d = new Customer();

	$d->getAdminPassWP();

	$pass =  $d->getPass();

	$wp_hasher = new PasswordHash(8, TRUE);

	$pass_hashed = '';
	$plain_password = '';
if($wp_hasher->CheckPassword($plain_password, $pass_hashed)) {
    echo "YES, Matched";
} else {
    echo "No, Wrong Password";
}