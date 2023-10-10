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

// データベースから位置情報を取得
$sql = "SELECT * FROM spot_table;";
$result = $pdo->query($sql);

// 取得した位置情報をJavaScriptの配列に格納
$locations = array();
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $locations[] = array(
        'spot_name' => $row['spot_name'],
        'lat' => $row['lat'],
        'lon' => $row['lon']
    );
}

// PHPでJavaScriptにデータを渡す
echo "<script>";
echo "var locations = " . json_encode($locations) . ";";
echo "</script>";

// データベース接続を閉じる
// $pdo = null;

?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!-- Navigation Barの読み込み -->
<?php include("navbar.php"); ?>

    <!-- MAP[START] -->
<h1>Basic template</h1>
<div id="myMap" style='width:100%;height:450px;'></div>
<!-- MAP[END] -->

<!-- jQuery&GoogleMapsAPI -->
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<!-- /jQuery&GoogleMapsAPI -->

<!-- [ MapTypeId ] https://msdn.microsoft.com/en-us/library/mt712700.aspx -->
<script src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=At4mxfA7230wZ0J1p5zCj08EgTkRtznwii8mhXpyrEl8-yRncii_lSUHORnSYIKV' async defer></script>

<!-- javascript -->
<script>
//1．位置情報の取得に成功した時の処理
function mapsInit(position) {
    //lat=緯度、lon=経度 を取得
    const lat = position.coords.latitude;
    const lon = position.coords.longitude;
    const map = new Microsoft.Maps.Map('#myMap', {
            center: new Microsoft.Maps.Location(lat, lon), //Location center position
            mapTypeId: Microsoft.Maps.MapTypeId.load, //Type: [load, aerial,canvasDark,canvasLight,birdseye,grayscale,streetside]
            zoom: 18  //Zoom:1=zoomOut, 20=zoomUp[ 1~20 ]
        });
};

//2． 位置情報の取得に失敗した場合の処理
function mapsError(error) {
  let e = "";
  if (error.code == 1) { //1＝位置情報取得が許可されてない（ブラウザの設定）
    e = "位置情報が許可されてません";
  }
  if (error.code == 2) { //2＝現在地を特定できない
    e = "現在位置を特定できません";
  }
  if (error.code == 3) { //3＝位置情報を取得する前にタイムアウトになった場合
    e = "位置情報を取得する前にタイムアウトになりました";
  }
  alert("エラー：" + e);
};

//3.位置情報取得オプション
const set ={
  enableHighAccuracy: true, //より高精度な位置を求める
  maximumAge: 20000,        //最後の現在地情報取得が20秒以内であればその情報を再利用する設定
  timeout: 10000            //10秒以内に現在地情報を取得できなければ、処理を終了
};

function GetMap() {
    //Main:位置情報を取得する処理 //getCurrentPosition :or: watchPosition
    navigator.geolocation.getCurrentPosition(mapsInit, mapsError, set);
}

window.onload = function () {
    // 位置情報を表示する関数
    function showLocations(locations) {
        const map = new Microsoft.Maps.Map('#myMap', {
            center: new Microsoft.Maps.Location(locations[0].lat, locations[0].lon), // 最初の位置を中心にする
            mapTypeId: Microsoft.Maps.MapTypeId.load,
            zoom: 18
        });

        // 位置情報をループしてピンを表示
        locations.forEach(function (location) {
            const pin = new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(location.lat, location.lon), {
                title: location.spot_name
            });

            map.entities.push(pin);
        });
    }

    // 上記のPHPコードで取得した位置情報を使用して地図を表示
    showLocations(locations);
};

</script>
</body>
</html>