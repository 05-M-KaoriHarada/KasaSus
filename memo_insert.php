<?php
//1. POSTデータ取得
$user_id = $_POST['user_id'];
$um_id = $_POST['um_id'];
$memo = $_POST['memo'];

// echo $user_id;
// echo $um_id;

//2. DB接続
include("funcs.php");
$pdo = db_conn();

//３．データ登録SQL作成⭐️⭐️⭐️
$stmt = $pdo->prepare("INSERT INTO memo_table(um_id,user_id,memo,memo_indate)VALUES(:um_id, :user_id, :memo, sysdate());");
$stmt->bindValue(':um_id', $um_id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':memo', $memo, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();


//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  sql_error($stmt);

}else{
  //５．リダイレクト
  redirect("user_mypage.php");
  exit();
}
?>
