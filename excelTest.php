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