<?php include("./dbConfig.php"); ?>
<?php
//エラー表示
session_start();
ini_set("display_errors", 1);

$id = $_SESSION["id"];
$name = $_POST["name"];
$value = $_POST["value"];
$category = $_POST["category"];
$discount = $_POST["discount"];
$review = $_POST["review"];
$image_path = "../images/" . basename($_FILES["image"]["name"]); //ファイル名を取得

include("../functions/funcs.php");
$pdo = db_conn();

//データ更新SQL作成

if (move_uploaded_file($_FILES["image"]["tmp_name"], $image_path)) {
    $sql = "UPDATE products SET name=:name, value=:value,category=:category,discount=:discount,review=:review,image_path=:image_path,created_at=sysdate() WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':value', $value, PDO::PARAM_STR);
    $stmt->bindValue(':category', $category, PDO::PARAM_STR);
    $stmt->bindValue(':discount', $discount, PDO::PARAM_STR);
    $stmt->bindValue(':review', $review, PDO::PARAM_STR); 
    $stmt->bindValue(':image_path', $image_path, PDO::PARAM_STR); 
    $stmt->bindValue(':id', $id, PDO::PARAM_STR); 
    $status = $stmt->execute(); // SQL実行
}
if ($status == false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $updatestmt->errorInfo();
  exit("SQLUpdateError:" . $error[2]);
} else {
  header("Location: main.php");
  exit();
}
?>