<?php
//0. SESSION開始！！
session_start();
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id']; // ログインしたユーザーIDを取得
} 

echo $user_id;

$um_id = $_GET['id'];

echo $um_id;

// 外部ファイルを読み込む ***
include("funcs.php");
sschk();//LOGINチェック 
$pdo = db_conn();//1.DB接続


//２．SQLから特定のidを取り出して表示する
$stmt = $pdo->prepare("SELECT * FROM um_table WHERE um_id=:um_id;");
$stmt->bindValue(":um_id", $um_id, PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  sql_error($stmt);
  
}else{
  //SQL成功の場合
  $row = $stmt->fetch();//1レコードだけ取得する方法 stmt->fetch
}


?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>傘を借りる</title>

</head>
<body>
<!-- Navigation Barの読み込み -->
<?php include("navbar.php"); ?>

<!-- 登録FORM -->
<div class="m-6" >
<form class="w-full max-w-xl" method="post" action="um_update.php">
  <div class="md:flex md:items-center mb-2">
    <div class="md:w-1/4">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
        傘ID
      </label>
    </div>
    <div class="md:w-3/4">
      <?=$row["um_id"]?>
    </div>
  </div>

  <div class="md:flex md:items-center mb-2">
    <div class="md:w-1/4">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
        設置スポットID
      </label>
    </div>
    <div class="md:w-3/4">
      <?=$row["id"]?>
    </div>
  </div>
  
  <input type="hidden" name="user_id" value="<?=$user_id?>"><!-- idを隠して、um_update.phpに送信 -->
  <input type="hidden" name="um_id" value="<?=$row["um_id"]?>"><!-- idを隠して、um_update.phpに送信 -->
  <input type="hidden" name="id" value="<?=$row["id"]?>">
  


  <div class="md:flex md:items-center">
    <div class="md:w-1/4"></div>
    <div class="md:w-3/4">
      <button class="shadow bg-orange-500 hover:bg-orange-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
        傘を借りる
      </button>
    </div>
  </div>
</form>
</div>





</body>
</html>
