<?php

/**
 * 
 */
class IpAdress
{
	public function checkIp($ip)
	{
		require_once 'func/DbManager.php';
		$db = getDb();
		$stt = $db->prepare("SELECT id FROM login_user_info WHERE login_ip=:ip");
		$stt->bindValue(':ip', $ip);
		$stt->execute();
		$user_id = $stt->fetch(PDO::FETCH_ASSOC);
		if (empty($user_id)) {
			header('Locatoin: error/404.html');
		}
		return $user_id;
	}
}