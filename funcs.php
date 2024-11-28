<?php
//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続関数：db_conn()
function db_conn(){
    try {
        // $pdo = new PDO('mysql:dbname=pioneer-mind_php_insta;charset=utf8;host=mysql80.pioneer-mind.sakura.ne.jp', 'pioneer-mind_php_insta', 'Ka12183002'); //さくら
        $db_name="pioneer-mind_nukizon";
        $db_id   = "pioneer-mind_nukizon";      //アカウント名
        $db_pw   = "Ka12183002";          //パスワード：XAMPPはパスワード無し or MAMPはパスワード”root”に修正してください。
        $db_host = "mysql80.pioneer-mind.sakura.ne.jp"; //DBホスト

        // $db_name = "Nukizon";    //データベース名
        // $db_id   = "root";      //アカウント名
        // $db_pw   = "";          //パスワード：XAMPPはパスワード無し or MAMPはパスワード”root”に修正してください。
        // $db_host = "localhost"; //DBホスト
        return new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
    } catch (PDOException $e) {
        exit('DB Connection Error:'.$e->getMessage());
    }
}

//SQLエラー関数：sql_error($stmt)
function sql_error($stmt){
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
}

//リダイレクト関数: redirect($file_name)
function redirect($filename){
    header("Location: ".$filename);
    exit();
}