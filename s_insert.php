<?php
//1. POSTデータ取得
$id = $_POST['id'];
$category = $_POST['category'];
$spot_name = $_POST['spot_name'];
$address = $_POST['address'];
$lon = $_POST['lon'];
$lat = $_POST['lat'];
$indate = $_POST['indate'];

//2. DB接続
include("funcs.php");
$pdo = db_conn();

//３．データ登録SQL作成⭐️⭐️⭐️
$stmt = $pdo->prepare("INSERT INTO spot_table(category,spot_name,address,lon,lat,indate)VALUES(:category, :spot_name, :address, :lon, :lat, sysdate());");
$stmt->bindValue(':category', $category, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':spot_name', $spot_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':address', $address, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lon', $lon, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lat', $lat, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//解説
// 1行目： 今からこのSQL文を実行する準備をする(prepare)。VALUESには、:xxxを入れますよ
// 2行目： :nameには、1.POSTデータで取得した変数$nameを、文字列(PDO::PARAM_STR)としてくっつけます(baindValue)
// 3行目： :emailには、、、
// 4行目： :naiyouには、、、
// 5行目： $stmt(1〜4行目)を実行した結果を、表示するための変数を $status


//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  sql_error($stmt);

}else{
  //５．リダイレクト
  redirect("success.php");
  exit();
}
?>
