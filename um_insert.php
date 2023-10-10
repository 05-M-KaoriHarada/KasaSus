<?php
//1. POSTデータ取得
$um_id = $_POST['um_id'];
$id = $_POST['id'];
$um_indate = $_POST['um_indate'];

//2. DB接続
include("funcs.php");
$pdo = db_conn();

//３．データ登録SQL作成⭐️⭐️⭐️
$stmt = $pdo->prepare("INSERT INTO um_table(id,um_indate)VALUES(:id, sysdate());");
$stmt->bindValue(':id', $id, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  sql_error($stmt);

}else{
  //５．リダイレクト
  redirect("um_success.php");
  exit();
}
?>
