<?php

	function getDb(){	
		// ここに左の接続情報を入れます。
		$dsn='mysql:dbname=iten; host=localhost; charset=utf8';
		$user='root';
		$pass ='';
		$db = new PDO($dsn,$user,$pass);
		return $db;
	}
