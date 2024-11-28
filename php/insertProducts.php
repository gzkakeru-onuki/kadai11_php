<?php
session_start();
ini_set("display_errors", 1);

$name = $_POST["name"];
$value = $_POST["value"];
$category = $_POST["category"];
$discount = $_POST["discount"];
$review = $_POST["review"];
$image_path = "../images/" . basename($_FILES["image"]["name"]); //ファイル名を取得


include("../functions/funcs.php");
$pdo = db_conn();



//３．データ登録SQL作成
if (move_uploaded_file($_FILES["image"]["tmp_name"], $image_path)) {
    $sql = "INSERT INTO products(name, value, category, discount, review, image_path, created_at) VALUES (:name,:value,:category,:discount,:review,:image_path,sysdate());";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':value', $value, PDO::PARAM_STR);
    $stmt->bindValue(':category', $category, PDO::PARAM_STR);
    $stmt->bindValue(':discount', $discount, PDO::PARAM_STR);
    $stmt->bindValue(':review', $review, PDO::PARAM_STR); 
    $stmt->bindValue(':image_path', $image_path, PDO::PARAM_STR); 
    $status = $stmt->execute(); // SQL実行
}else {
    echo "ファイル移動処理エラー";
    exit();
}


//４．データ登録処理後
if ($status == false) { // 登録処理にエラーがあれば
    $error = $stmt->errorInfo();
    exit("SQLInsertError: " . $error[2]);
} else {
    redirect('./main.php');
    exit();
}
?>
