<?php
//    	php ../../composer.phar
	require 'DbManager.php';
	$db = getDb();
	$stt = $db->prepare("SELECT id, file, created_at FROM file where id<>4 AND id<>9 AND id<>10");
	$stt->execute();
	$row = $stt->fetchAll();

	// ファイルを読み込む
	$uploads_dir = './uploads/';
?>

<?php include 'header.php'; ?>
<?php include 'sideBar.php'; ?>
<div id="wrapp">
	<h2>アップロードされたファイルを読み込みました</h2>
	<button type="button" class="btn btn-info" id="file_menu_button">ファイル一覧</button>
	<div id="files">
		<table class="table table-bordered">
			<table class="table">
				<tr>
					<th scope="col">No</th>
					<th scope="col">読み込んだファイル</th>
					<th scope="col">アップロード日</th>
				</tr>
				<?php
					foreach ($row as $key => $value) {
						echo "<tr><th scope='row' >" . $value["id"] . "</th><td>". $value["file"] ."</td><td>". $value["created_at"] ."</td></tr>";
					}
				?>
			</table>
		</table>
	</div><!--  // files-->
	<div id="fileForms">
		<form action="download.php" method="post">
			<button type="submit" class="btn btn-success">Word形式でダウンロード</button>
	<?php
		foreach ($row as $key => $value) {
		$filename = $uploads_dir.$value["file"];
		$readfile = file($filename);
		foreach ($readfile as $key => $value) {
			// $value = mb_convert_encoding($value,"UTF-8",mb_detect_encoding($value, "ASCII,JIS,UTF-8,CP51932,SJIS-win", true));
			// $value = mb_convert_encoding($value, 'utf8');
			// $value = trim($value);
			// $value = str_replace('	', '', $value);
			// $value = str_replace('          ', '', $value);
			$line .= $value;
		}
	}
	?>
	<div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="50" cols="8" name="message">
    	<?php 
    	if (!empty($line)) {		
        	echo $line; 
    	}
    	?>    		
    </textarea>
  </div>
	</form>
	</div><!--  // fileForms-->
	<div class="clear"></div>
</div><!--  // wrapp-->
<div class="clear"></div>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript">
$("#file_menu_button").click(function () {
  $("#files").slideToggle();
});
</script>
</body>
</html>