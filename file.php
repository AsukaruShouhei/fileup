<?php
	require 'DbManager.php';


	if (!$_SESSION["joutai"]) {
		$_SESSION["joutai"] = '';
	}

	$src = $_FILES["file"]["tmp_name"];
	$uploads_dir = './uploads/';
	foreach ($_FILES["file"]["error"] as $key => $error) {
	    if ($error == UPLOAD_ERR_OK) {
	        $tmp_name = $_FILES["file"]["tmp_name"][$key];
	        $name = basename($_FILES["file"]["name"][$key]);
	        if(!file_exists($uploads_dir)){
				 mkdir($uploads_dir, 0777, true);  
			}
	        
	        move_uploaded_file($tmp_name, $uploads_dir.$name);

	        $db = getDb();
	        $stt = $db->prepare("INSERT INTO file(name, file) VALUES( 'endo',:name)");
	        $stt->bindValue(':name', $name);
	        $stt->execute();
	    }
	 $_SESSION["joutai"] = true;
	 header('Location: index.php');
	}