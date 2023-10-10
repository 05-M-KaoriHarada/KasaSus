<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>傘データ登録</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<!-- Navigation Barの読み込み -->
<?php include("navbar.php"); ?>

<p>傘ID発行画面</p>
<!-- 登録FORM -->
<div class="m-6" >
<form class="w-full max-w-xl" method="post" action="um_insert.php">
  
<div class="md:flex md:items-center mb-2">
    <div class="md:w-1/4">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
        発行スポットID
      </label>
    </div>
    
    <div class="md:w-3/4">
      <input name="id" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text" value="">
      <p>※現在は、38、42、44、49のいずれかを入力😅</p>
    
    </div>
  </div>


  <div class="md:flex md:items-center">
    <div class="md:w-1/4"></div>
    <div class="md:w-3/4">
      <button class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
        傘ID発行
      </button>
    </div>
  </div>
</form>
</div>



</body>
</html>

