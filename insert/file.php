<?php
	session_start();
	$user_id = $_SESSION["user_id"];
	if (!$_SESSION["joutai"]) {
		unset($_SESSION["joutai"]);
	}

	require_once '../func/FileClass.php';
	try{
		$fc = new FileClass();
		$fc->insertFileName($_FILES, $user_id);
		$_SESSION["joutai"] = "アップロード完了しました。";
		header('Location: ../index.php');
	}catch(Exception $e){
		$_SESSION["joutai"] = $e;
		header('Location: ../index.php');
	}