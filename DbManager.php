<?php
	function getDb(){	
		// ここに左の接続情報を入れます。
		$dsn='mysql:dbname=asukaru_p-school; host=mysql642.db.sakura.ne.jp; charset=utf8';
		$user='asukaru';
		$pass ='as2014es';
		$db = new PDO($dsn,$user,$pass);
		return $db;
	}