<?php
//0. SESSION開始！！
session_start();
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id']; // ログインしたユーザーIDを取得
} 

$um_id = $_POST['um_id'];

echo $user_id;
echo $um_id;

// 外部ファイルを読み込む ***
include("funcs.php");
sschk();//LOGINチェック 
$pdo = db_conn();//1.DB接続

//２．SQLから特定のidを取り出して表示する
$stmt = $pdo->prepare("SELECT * FROM spot_table WHERE id=:id;");
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEMO登録</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<!-- Navigation Barの読み込み -->
<?php include("navbar.php"); ?>

<p>傘MEMO登録画面</p>
<p>この傘にまつわるエピソードや思い出などを登録しましょう。</p>
<!-- 登録FORM -->
<div class="m-6" >
<form class="w-full max-w-xl" method="post" action="memo_insert.php">
  <div class="md:flex md:items-center mb-2">
    <div class="md:w-1/4">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
        傘ID
      </label>
    </div>
    <div class="md:w-3/4">
    <p><?=$um_id?></p>
    </div>
  </div>

  <div class="md:flex md:items-center mb-2">
    <div class="md:w-1/4">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
        MEMO
      </label>
    </div>
    <div class="md:w-3/4">
      <textarea name="memo" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text" value=""></textarea>
    </div>
  </div>

  <input type="hidden" name="user_id" value=<?=$user_id?>>
  <input type="hidden" name="um_id" value=<?=$um_id?>>
  

  <div class="md:flex md:items-center">
    <div class="md:w-1/4"></div>
    <div class="md:w-3/4">
      <button class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
        登録
      </button>
    </div>
  </div>
</form>
</div>



</body>
</html>

