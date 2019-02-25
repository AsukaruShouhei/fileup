<?php
	function getDb(){	
		// ここに左の接続情報を入れます。
		$dsn='mysql:dbname=; host=; charset=utf8';
		$user='';
		$pass ='';
		$db = new PDO($dsn,$user,$pass);
		return $db;
	}
