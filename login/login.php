<?php
	session_start();
	unset($_SESSION["msg"]);
	require '../func/SecurityClass.php';
	require '../func/LoginUserClass.php';

	$s = new Security();
	$email = $s->f($_POST["email"]);
	$pass = $s->f($_POST["pass"]);

	$login = new LoginUser();
	$userdata = $login->adminUser($email, $pass);
	if ( is_int($userdata) ) {
		$_SESSION["user_id"] = $userdata;
		header('location: ../index.php');
	}else{
		$_SESSION["msg"] = $userdata;
		header('location: index.php');
	}