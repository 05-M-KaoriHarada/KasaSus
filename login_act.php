<?php
//最初にSESSIONを開始！！ココ大事！！
session_start();

//POST値 loginIDとpwをPOST通信で受け取る
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];
$_SESSION['user_id'] = $lid;

//1.  DB接続します
include("funcs.php");
$pdo = db_conn();

//2. データ登録SQL作成  lidとlpwが一致するデータが存在するのかを確認しにいく。
//* PasswordがHash化→条件はlidのみ！！
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE lid = :lid"); 
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status==false){
    sql_error($stmt);
}

//4. 抽出データ数を取得
$val = $stmt->fetch();         //1レコードだけ取得する方法
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()



//5.該当１レコードがあればSESSIONに値を代入
//入力したPasswordと暗号化されたPasswordを比較！[戻り値：true,false]
$pw = password_verify($lpw, $val["lpw"]);
if($pw){ 
  //Login成功時
  $_SESSION["chk_ssid"]  = session_id();
  $_SESSION["kanri_flg"] = $val['kanri_flg'];
  $_SESSION["user_name"]      = $val['user_name'];
  //Login成功時（リダイレクト）
  redirect('user_index.php');
}else{
  //Login失敗時(Logoutを経由：リダイレクト)
  redirect('login.php');
}

exit();


