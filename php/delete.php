//エラー表示

<?php
ini_set("display_errors", 1);
include("../functions/funcs.php");
$pdo = db_conn();
$id = $_GET["id"];


//データ更新SQL作成
$deleteSql = "DELETE FROM  products WHERE id=:id";
$deletestmt = $pdo->prepare($deleteSql);
$deletestmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $deletestmt->execute();

if ($status == false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $deletestmt->errorInfo();
  exit("SQLDeleteError:" . $error[2]);
} else {
  header("Location: main.php");
  exit();
}
?>