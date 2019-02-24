<?php
	function getDb(){	
		// ここに左の接続情報を入れます。
		$dsn='mysql:dbname=test; host=localhost; charset=utf8';
		$user='root';
		$pass ='';
		$db = new PDO($dsn,$user,$pass);
		return $db;
	}

	$src = $_FILES["file"]["tmp_name"];
	print_r($src);
	// foreach ($src as $key => $value) {
	// 	$dest = mb_convert_encoding($value, 'SJIS-WIN', 'UTF-8');
	// 	if (!move_uploaded_file($value, $dest)) {
	// 		$error_msg = 'アップロード処理に失敗しました。';
	// 	}else{
	// 		$error_msg = "success";
	// 	}
	// }
	// print_r($error_msg);
	$uploads_dir = '/uploads';
	foreach ($_FILES["file"]["error"] as $key => $error) {
	    if ($error == UPLOAD_ERR_OK) {
	        $tmp_name = $_FILES["file"]["tmp_name"][$key];
	        // basename() で、ひとまずファイルシステムトラバーサル攻撃は防げるでしょう。
	        // ファイル名についてのその他のバリデーションも、適切に行いましょう。
	        $name = basename($_FILES["file"]["name"][$key]);
	        print_r($name);
	        move_uploaded_file($tmp_name, "./".$name);
	    }
	}