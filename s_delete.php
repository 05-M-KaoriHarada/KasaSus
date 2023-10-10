<?php
//0. SESSION開始！！
session_start();

//1. POSTデータ取得
$id = $_GET["id"];

//2. DB接続します
include("funcs.php");  //funcs.phpを読み込む（関数群）
sschk();//LOGINチェック 
$pdo = db_conn();      //DB接続関数

//３．データ登録SQL作成
$sql = "DELETE FROM spot_table WHERE id=:id";  //WHEREを入れ忘れるとTABLE毎削除されるので注意！！
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id',$id, PDO::PARAM_INT);  //IDは、Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect("s_select.php");
}

?>