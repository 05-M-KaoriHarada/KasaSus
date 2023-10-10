<?php
//0. SESSION開始！！
session_start();

$id = $_GET['id'];

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
  <title>登録内容</title>

</head>
<body>
<!-- Navigation Barの読み込み -->
<?php include("navbar.php"); ?>

<!-- 登録FORM -->
<div class="m-6" >
<form class="w-full max-w-xl" method="post" action="s_update.php">
  <div class="md:flex md:items-center mb-2">
    <div class="md:w-1/4">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
        カテゴリ
      </label>
    </div>
    <div class="md:w-3/4">
      <input name="category" value="<?=$row["category"]?>" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text">
    </div>
  </div>

  <div class="md:flex md:items-center mb-2">
    <div class="md:w-1/4">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
        設置場所名称
      </label>
    </div>
    <div class="md:w-3/4">
      <input name="spot_name" value="<?=$row["spot_name"]?>" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text">
    </div>
  </div>

  <div class="md:flex md:items-center mb-2">
    <div class="md:w-1/4">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
        住所
      </label>
    </div>
    <div class="md:w-3/4">
      <input name="address" value="<?=$row["address"]?>" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text">
    </div>
  </div>

  <div class="md:flex md:items-center mb-2">
    <div class="md:w-1/4">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
        緯度
      </label>
    </div>
    <div class="md:w-3/4">
      <input name="lon" value="<?=$row["lon"]?>" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text">
    </div>
  </div>

  <div class="md:flex md:items-center mb-2">
    <div class="md:w-1/4">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
        経度
      </label>
    </div>
    <div class="md:w-3/4">
      <input name="lat" value="<?=$row["lat"]?>" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text">
    </div>
  </div>

  
  <input type="hidden" name="id" value="<?=$id?>"><!-- idを隠して、s_update.phpに送信 -->
  
  <div class="md:flex md:items-center">
    <div class="md:w-1/4"></div>
    <div class="md:w-3/4">
      <button class="shadow bg-orange-500 hover:bg-orange-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
        更新
      </button>
    </div>
  </div>
</form>
</div>





</body>
</html>
