<?php
session_start();
ini_set("display_errors", 1);

//1. POSTデータ取得
$name   = $_POST["name"];
$mail  = $_POST["mail"];
$number    = $_POST["number"];
$password = $_POST["password"];


//2. DB接続します
//*** function化する！  *****************
include("../functions/funcs.php");
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO users( name, mail, password, number, created_at, updated_at, deleted_flg) VALUES (:name,:mail,:password,:number,sysdate(),sysdate(),0)");

$stmt->bindValue(':name',   $name,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':mail',  $mail,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':password',    $password,    PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':number', $number, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行


//４．データ登録処理後
if ($status == false) {
    //*** function化する！*****************
    sql_error($stmt);
} else {
    //*** function化する！*****************
    $_SESSION['name'] = $name; // 入力された名前をそのままセッションに保存
    header("Location: main.php");//商品一覧画面へ飛ぶ
    exit();
}
