<?php

/**
 * 
 */
class FileClass
{
	/*
	* アップロードしたファイルの情報取得	
	* @param id DBから取得するID
	* 
	*
	*
	*/
	public function getFileAll($id=null, $user_id)
	{
		require 'func/DbManager.php';
		$db = getDb();
		if ($id === null) {
			$stt = $db->prepare("SELECT * FROM file WHERE user_id=:user_id");
			$stt->bindValue(':user_id', $user_id);
			$stt->execute();
			$row = $stt->fetchAll();
			return $row;
		}else{
			$stt = $db->prepare("SELECT * FROM file WHERE id=:id AND user_id=:user_id");
			$stt->execute();
			$stt->bindValue(':id', $id);
			$stt->bindValue(':user_id', $user_id);
			$row = $stt->fetchAll();
			return $row;
		}
	}

	/*
	* ファイルの情報 insert/file.php	
	* @param files $_FILES
	* @param user_id  
	*
	*
	*/
	public function insertFileName($files, $user_id)
	{
		require '../func/DbManager.php';

		$src = $files["file"]["tmp_name"];
		$uploads_dir = './uploads/';
		foreach ($files["file"]["error"] as $key => $error) {
		    if ($error == UPLOAD_ERR_OK) {
		        $tmp_name = $files["file"]["tmp_name"][$key];
		        $name = basename($files["file"]["name"][$key]);
		        if(!file_exists($uploads_dir)){
					 mkdir($uploads_dir, 0777, true);  
				}
		        
		        move_uploaded_file($tmp_name, $uploads_dir.$name);

		        $db = getDb();
		        $stt = $db->prepare("INSERT INTO file(user_id, name, file) VALUES(:user_id, 'endo',:name)");
		        $stt->bindValue(':name', $name);
		        $stt->bindValue(':user_id', $user_id);
		        $stt->execute();
		    }
		}
	}
}