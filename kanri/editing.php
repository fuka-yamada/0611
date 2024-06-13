<?php
//データベースの接続
$dsn = "mysql:host=localhost;dbname=akua;charset=utf8";
$user = "testuser";
$pass = "testpass";

$origin=[];//ここに、処理前のデータが入る
if(isset($_SESSION)){
    $origin+=$_SESSION;//$originに処理前のGETデータを入れる
}

//文字コードとhtmlエンティティズの処理を繰り返し行う
foreach($origin as $key=>$value){
    //文字コードを処理
    $mb_code=mb_detect_encoding($value);
    $value=mb_convert_encoding($value,"utf-8",$mb_code);

    //htmlエンティティズ処理
    $value=htmlentities($value,ENT_QUOTES);

    //処理が終わったデータを、＄inputに入れなおす
    $input[$key]=$value;
}

try {
    $dbh = new PDO($dsn, $user, $pass);

    echo "編集画面。";
    //register();
} catch (PDOException $e) {
    echo "エラー内容：" .$e->getMessage();
}




