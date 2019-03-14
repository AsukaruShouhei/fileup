<?php

/**
 * 
 */
class FileClass
{
	public function getFileAll($id=null)
	{
		require 'func/DbManager.php';
		$db = getDb();
		if ($id === null) {
			$stt = $db->prepare("SELECT * FROM file");
			$stt->execute();
			$row = $stt->fetchAll();
			return $row;
		}else{
			$stt = $db->prepare("SELECT * FROM file WHERE id=:id");
			$stt->execute();
			$stt->bindValue(':id', $id);
			$row = $stt->fetchAll();
			return $row;
		}
	}
}