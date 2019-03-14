<?php

/**
 * login method
 */
class LoginUser
{
	public function checkSession($sessionData)
	{
		if ( $sessionData === null) {
			header('location: login/index.php');
		}
	}


	/*
	*
	* @param $email
	* @param $pass
	*
	* return session
	*/
	public function adminUser($email, $pass)
	{
		require '../func/DbManager.php';
		$db = getDb();
		$stt = $db->prepare("SELECT id FROM users WHERE email=:email AND pass=:pass");
		$stt->bindValue(':email', $email);
		$stt->bindValue(':pass', $pass);
		$stt->execute();
		$row = $stt->fetch(PDO::FETCH_ASSOC);
		if ( empty($row) ) {
			return $_SESSION["msg"] = "入力値に誤りがあります。";
		}else{
			$row = (int)$row['id'];
			return $row;
		}
	}
}