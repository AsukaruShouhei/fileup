<?php
require_once 'vendor/autoload.php';
$phpWord = new \PhpOffice\PhpWord\PhpWord();
$section = $phpWord->addSection();
//文字
$msg = htmlspecialchars($_POST["message"], ENT_QUOTES, 'utf-8');
$cr = array("\r\n", "\r");   // 改行コード置換用配列を作成しておく
    // 改行コードを統一
    //str_replace ("検索文字列", "置換え文字列", "対象文字列");
$urls = str_replace($cr, "\n", $msg);
    //改行コードで分割（結果は配列に入る）
$lines_array = explode("\n", $urls);
foreach ($lines_array as $key => $value) {
	$section->addText($value);
}



//ダウンロード用
    header("Content-Description: File Transfer");
    header('Content-Disposition: attachment; filename="sample.docx"');
    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Expires: 0');
    $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    ob_end_clean(); //バッファ消去
    $xmlWriter->save("php://output");