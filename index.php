<?php
	require 'DbManager.php';
	$db = getDb();
	$stt = $db->prepare("SELECT * FROM file");
	$stt->execute();
	$row = $stt->fetchAll();
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
		width: 75%;
		padding: 12px;
		margin-left: 5%;
	}
	#sidebar{
		float: left;
		width: 20%;
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
			width: 40%;
			float: left;
			padding: 15px;
		}
		#files{
			width: 30%;
			margin-left: 5%;
			float: left;
		}
		.clear{
			clear: both;
		}
		.red{
			color: red;
		}
	</style>
</head>
<body>
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