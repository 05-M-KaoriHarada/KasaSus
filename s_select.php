<?php
//0. SESSION開始！！
session_start();
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id']; // ログインしたユーザーIDを取得
} 

echo $user_id;

//1.DB接続*** 外部ファイルを読み込む ***
include("funcs.php");
//loginチェック
sschk();
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM spot_table;");
$status = $stmt->execute();

//３．データ表示
$view="";
$view .= '<table border="1" id="fav-table">';
$view .= '<tr>
  <th>登録日</th>
  <th>カテゴリ</th>
  <th>設置スポット名称</th>
  <th>住所</th>
  <th>緯度</th>
  <th>経度</th>
  <th> </th>
  <th> </th>
  </tr>';

if($status==false) {
    //execute（SQL実行時にエラーがある場合）
    sql_error($stmt);
    
}else{
  while( $res = $stmt->fetch(PDO::FETCH_ASSOC)){   
    $view .= '<tr>';
    $view .= '<td>'.h($res['indate']).'</td>';
    $view .= '<td>'.h($res['category']).'</td>';
    $view .= '<td>'.h($res['spot_name']).'</td>';
    $view .= '<td>'.h($res['address']).'</td>';
    $view .= '<td>'.h($res['lat']).'</td>';
    $view .= '<td>'.h($res['lon']).'</td>';
    $view .= '<td><button><a href="s_detail.php?id='.h($res["id"]).'">';
    $view .= 'Update';
    $view .= '</a></button></td>';
    $view .= '<td><button class="delete-btn" data-id="' . h($res["id"]) . '">';
    $view .= 'Delete';
    $view .= '</button></td>';
    
    $view .= '</tr>';
  }
}

$view .= '</table>';

echo <<<EOM
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // 削除ボタンクリック時の処理
    $(document).on('click', '.delete-btn', function() {
        var id = $(this).data('id');
        if (confirm('データを本当に削除しますか？')) {
            location.href = 's_delete.php?id=' + id;
        }
    });
});
</script>
EOM;
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
    <div class="container jumbotron"><?=$view?></div>
</div>
<!-- Main[End] -->

</body>

</html>

