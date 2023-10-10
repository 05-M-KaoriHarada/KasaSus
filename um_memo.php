<?php
//0. SESSION開始！！
session_start();
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id']; // ログインしたユーザーIDを取得
} 
echo $user_id;

$um_id = $_POST['um_id'];
echo $um_id;

//1.DB接続*** 外部ファイルを読み込む ***
include("funcs.php");
//loginチェック
sschk();
$pdo = db_conn();

//２．データ登録SQL作成

$stmt = $pdo->prepare("SELECT * FROM memo_table WHERE um_id=:um_id;");
$stmt->bindValue(":um_id", $um_id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$view="";
$view .= '<table border="1" id="fav-table">';
$view .= '<tr>
  <th>登録日　　　　</th>
  <th>傘ID　　　</th>
  <th></th>
  <th></th>
  </tr>';

if($status==false) {
    //execute（SQL実行時にエラーがある場合）
    sql_error($stmt);
    
}else{
  while( $res = $stmt->fetch(PDO::FETCH_ASSOC)){   
    $view .= '<tr>';
    $view .= '<td>'.h($res['memo_indate']).'</td>';
    $view .= '<td>'.h($res['user_id']).'</td>';
    $view .= '<td>'.h($res['memo']).'</td>';
    $view .= '</tr>';
  }
}

$view .= '</table>';
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BOOKデータ表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">

<!-- Navigation Barの読み込み -->
<?php include("navbar.php"); ?>

<!-- Main[Start] -->
<div>
    <p><?=$user_id?>さんが借りている傘</p>
    <div class="container jumbotron"><?=$view?></div>
</div>
<!-- Main[End] -->



</body>

</html>

