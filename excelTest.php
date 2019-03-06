<?php

require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';
require_once 'PHPExcel/Classes/PHPExcel.php';
// 読込するファイル
$readFile = "./uploads/20180105_iTPS_TPD_Qestionnaire_SampleModel_v1.xlsx";
 
// 指定ファイルを読み込む
$objPExcel = PHPExcel_IOFactory::load($readFile);
// 読み込んだエクセルの参照シートを指定
$sheet = $objPExcel->getActiveSheet(0);
// 配列で保持する
$ary = $sheet->toArray(null,true,true,true);

//    	php ../../composer.phar
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
		
		#files{
			display: none;
			width: 20%;
			margin-left: 12px;
			float: left;
			z-index: 99;
		}
		.clear{
			clear: both;
		}
	#fileForms{
		margin-top: 12px;
	}
	</style>
</head>
<body>
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
	<div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="50" cols="8" name="message">
    	<?php 
    	if (!empty($ary)) {		
        	foreach ($ary as $key => $value) {
			echo $value['A']." " ;
			echo $value['B'] ." ";
			echo $value['C'] ." ";
			echo $value['D'] ." ";
			echo $value['E']."\n";
	} 
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