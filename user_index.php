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
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Show all "Infoboxes" in the area</title>
    <meta charset="utf-8">
    <style>html,body{height:100%;}body{padding:0;margin:0;}h1{padding:0;margin:0;font-size:50%;color:white;}</style>
</head>
<body>
<!-- Navigation Barの読み込み -->
<?php include("navbar.php"); ?>

<h1 id="h1">Infobox :  infoboxs</h1>
<div id="myMap" style='width:100%;height:450px;'></div>


<!-- [ infobox Object ] https://msdn.microsoft.com/en-us/library/mt712658.aspx -->
<script src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=At4mxfA7230wZ0J1p5zCj08EgTkRtznwii8mhXpyrEl8-yRncii_lSUHORnSYIKV' async defer></script>
<script>
let infoboxs  = []; //Put infobox in an array
let locations = []; //Put location in an array
let map;
    //Maps Init
    function GetMap() {
        map = new Microsoft.Maps.Map('#myMap', {
            center: new Microsoft.Maps.Location(35.654861466496875, 139.73955073327352),
            zoom: 20
        });

        //Set:Infobox
        locations[0] = map.getCenter();
        const infobox0 = new Microsoft.Maps.Infobox(locations[0], {
            title: 'コンビニ',
            description: '<a href="s_stock.php?id=49">ここで借りる</a><br><a href="s_return.php?id=49">ここで返却</a>'

        });
        infoboxs.push(infobox0);
                
        //Set:Infobox
        locations[1] = new Microsoft.Maps.Location(35.65653730332855, 139.73598935632054);
        const infobox1 = new Microsoft.Maps.Infobox(locations[1], {
            title: '駅　　',
            description: '<a href="s_stock.php?id=44">ここで借りる</a><br><a href="s_return.php?id=44">ここで返却</a>'
        });
        infoboxs.push(infobox1);
        
        //Set:Infobox
        locations[2] = new Microsoft.Maps.Location(35.653438926244824, 139.73651696772097);
        const infobox2 = new Microsoft.Maps.Infobox(locations[2], {
            title: 'コンビニ',
            description: '<a href="s_stock.php?id=38">ここで借りる</a><br><a href="s_return.php?id=38">ここで返却</a>'

        });
        infoboxs.push(infobox2);
        
        //Set:Infobox
        locations[3] = new Microsoft.Maps.Location(35.654871209835896, 139.7369306630236);
        const infobox3 = new Microsoft.Maps.Infobox(locations[3], {
            title: '駅',
            description: '<a href="s_stock.php?id=42">ここで借りる</a><br><a href="s_return.php?id=42">ここで返却</a>'

        });
        infoboxs.push(infobox3);
        
        
        //Add:Place an infobox on the map.
        for(var i=0;i<infoboxs.length;i++){
            infoboxs[i].setMap(map); //Add infobox to Map
        }

        //Change the display of the map.
        map.setView({
            bounds: Microsoft.Maps.LocationRect.fromLocations(locations), //fromLocations or fromShapes
            padding: 100
        });



    }
</script>
</body>
</html>
