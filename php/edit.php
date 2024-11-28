<?php 
session_start();
$linktext = " ";
$signin =" ";
$title="商品編集画面";
$link =" ";
$editform ="ari";
$id = $_POST["productid"];
$send ="./update.php";
include("./formtemplate.php");

$_SESSION["id"]=$id;
?>


<?php
//エラー表示
ini_set("display_errors", 1);
include("../functions/funcs.php");
$pdo = db_conn();



echo '<a href="./delete.php?id=' . htmlspecialchars($id, ENT_QUOTES, 'UTF-8') . '">削除</a>';

?>