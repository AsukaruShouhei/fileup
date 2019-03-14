<?php

/**
 * 
 */
class IpAdressClass
{
	public function checkIp($ip)
	{
		require 'func/DbManager.php';
		$db = getDb();
		$stt = $db->prepare("SELECT id FROM login_user_info WHERE login_ip=:ip");
		$stt->bindValue(':ip', $ip);
		$stt->execute();
		$user_id = $stt->fetch(PDO::FETCH_ASSOC);
		return $user_id;
	}
}