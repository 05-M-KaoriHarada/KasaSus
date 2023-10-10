<?php
//1. POSTデータ取得
$id = $_POST['id'];
$um_id = $_POST['um_id'];
// $um_indate = $_POST['um_indate'];

// echo $id;
// echo $um_id;


//*** 外部ファイルを読み込む ***
include("funcs.php");
$pdo = db_conn();

//３．データ登録SQL作成⭐️⭐️⭐️
$stmt = $pdo->prepare("UPDATE um_table SET id=:id, user_id=0 WHERE um_id=:um_id");
// $stmt->bindValue(':id', $id, PDO::PARAM_INT);  // Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_STR);  // Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':um_id', $um_id, PDO::PARAM_INT);  // Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();// 実行


//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  sql_error($stmt);

}else{
  //５．リダイレクト
  redirect("user_index.php");
  exit();
}

?>
