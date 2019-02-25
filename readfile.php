<?php
	require 'DbManager.php';
	$db = getDb();
	$stt = $db->prepare("SELECT id, file, created_at FROM file where id<>4");
	$stt->execute();
	$row = $stt->fetchAll();

	// ファイルを読み込む
	$uploads_dir = './uploads/';
?>

<!DOCTYPE html>
<html>
<head>
	<title>sample</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<style type="text/css">
	#wrapp{
		width: 77%;
		padding: 12px;
		margin-left: 5%;
		float: left;
	}
	#sidebar{
		float: left;
		width: 18%;
		background: #000080;
		color: #fff;
		height: 100vw;
	}
	#sidebar a:link {
		color: #fff;
		text-align: center;
		margin: 15px;
	}
		#fileForms{
			width: 70%;
			float: left;
			padding: 15px;
			height: 80vw;
			overflow: scroll;
		}
		#files{
			width: 20%;
			margin-left: 12px;
			float: left;
		}
		.clear{
			clear: both;
		}
	</style>
</head>
<body>
<?php include 'sideBar.php'; ?>
<div id="wrapp">
	<h2>アップロードされたファイルを読み込みました</h2>
	<div id="fileForms">
	<?php
		foreach ($row as $key => $value) {
		$filename = $uploads_dir.$value["file"];
		$readfile = file($filename);
		foreach ($readfile as $key => $value) {
			$value = mb_convert_encoding($value,"UTF-8",mb_detect_encoding($value, "ASCII,JIS,UTF-8,CP51932,SJIS-win", true));
			// $value = mb_convert_encoding($value, 'utf8');
			$value = trim($value);
			$value = str_replace('	', '', $value);
			$value = str_replace('          ', '', $value);
			echo $value;
		}

	}
	?>
	</div><!--  // fileForms-->
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
	<div class="clear"></div>
</div><!--  // wrapp-->
<div class="clear"></div>
</body>
</html>