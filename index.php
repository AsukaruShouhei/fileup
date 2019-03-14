<?php
	require 'DbManager.php';
	$db = getDb();
	$stt = $db->prepare("SELECT * FROM file");
	$stt->execute();
	$row = $stt->fetchAll();

	$ip = $_SERVER["REMOTE_ADDR"];
	$stt = $db->prepare("SELECT id FROM login_user_info WHERE login_ip=:ip)");
	$stt->bindValue(':ip', $ip);
	$stt->execute();
	$user_id = $stt->fetch(PDO::FETCH_ASSOC);
	if (empty($user_id)) {
		header('Locatoin: error/404.html');
	}else{
		$stt = $db->prepare("INSERT INTO login_user_info(login_ip) VALUES(:ip)");
		$stt->execute();
	}
?>

<?php include 'header.php'; ?>
<?php include 'sideBar.php'; ?>
<div id="wrapp">
	<div id="fileForms">
		<?php
		if (isset($_SESSION["joutai"])) {
			?>
			<div class="alert alert-light" role="alert">アップロード完了</div>
			<?php
		}

		?>
	<form action="file.php" method="post" enctype="multipart/form-data">
		<span class="red">※　画像データはアップロードしても表示できません。</span>
		<div class="form-group">
			<label for="exampleFormControlFile1">Example file input</label>
			<input type="file" class="form-control-file" id="exampleFormControlFile1" name="file[]">
		</div>
		<div class="form-group">
			<label for="exampleFormControlFile1">Example file input</label>
			<input type="file" class="form-control-file" id="exampleFormControlFile1" name="file[]">
		</div>
		<div class="form-group">
			<label for="exampleFormControlFile1">Example file input</label>
			<input type="file" class="form-control-file" id="exampleFormControlFile1" name="file[]">
		</div>
		<input type="submit" name="btn" value="submit">
	</form>
	</div><!--  // fileForms-->
	<div id="files">
		<table class="table table-bordered">
			<table class="table">
				<tr>
					<th scope="col">No</th>
					<th scope="col">アップロードしたファイル</th>
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
	<div class="clear"></div>
</div><!--  // wrapp-->
<div class="clear"></div>
</body>
</html>