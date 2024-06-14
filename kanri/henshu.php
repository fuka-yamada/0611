<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
     <link rel="stylesheet" href="../CSS/design_kan2.css"> 
</head>

<body>

<?php
//データベースへのログイン情報

use function PHPSTORM_META\sql_injection_subst;

$dsn = "mysql:host=localhost;dbname=akua;charset=utf8";
$user = "testuser";
$pass = "testpass";

$origin=[];//ここに、処理前のデータが入る
if (isset($_POST)) {
    $origin += $_POST; // $originに処理前のGETデータを入れる
}

//echo $_POST["mode"];

// 文字コードとhtmlエンティティズの処理を繰り返し行う
foreach ($origin as $key => $value) {
    // 文字コードを処理
    $mb_code = mb_detect_encoding($value);
    $value = mb_convert_encoding($value, "utf-8", $mb_code);

    // htmlエンティティズ処理
    $value = htmlentities($value, ENT_QUOTES);

    // 処理が終わったデータを、$inputに入れなおす
    $input[$key] = $value;
}
try {
    $dbh = new PDO($dsn, $user, $pass);
    echo "";
  
   
} catch (PDOException $e) {
    echo "エラー内容：" .$e->getMessage();
}


 //テンプレートファイルの読み込み
 $fh = fopen("editing.html", "r+"); //読み込みモード
 $fs = filesize("editing.html"); //ファイルサイズを調べる（のちのfread関数で
 $editing_html = fread($fh, $fs); //ファイルの読み込みを行う
 fclose($fh);
 
 
 
//SQLを用意
//SELECTはuserテーブル（表）からデータを抽出する。
$sql = <<<sql
     SELECT * FROM user  WHERE id=?;
     
sql;
    $e = $dbh->prepare($sql);
    $e->bindParam(1, $input["id"]);
    // $e->bindParam(1, $input["dat"]);
    // $e->bindParam(2, $input["time"]);
    // $e->bindParam(3, $input["mai"]);
    // $e->bindParam(4, $input["name"]);
    // $e->bindParam(5, $input["furi"]);
    // $e->bindParam(6, $input["phone"]);
    // $e->bindParam(7, $input["gender"]);
    // $e->bindParam(8, $input["birthday"]);
    // $e->bindParam(9, $input["prefecture"]);
    $e->execute();
 //$blockがテキストかつ中身がないことを定義する
        $block = "";

        while ($row = $e->fetch()) {
            // 差し込み用テンプレートを初期化する
            $insert = $editing_html;
    
            // データベースの値を、PHPで使用する値として、変数に入れなおす
            $dat = $row["dat"];
            $time = $row["time"];
            $mai = $row["mai"];
            $name = $row["name"];
            $furi = $row["furi"];
            $phone = $row["phone"];
            $gender = $row["gender"];
            $birthday = $row["birthday"];
            $prefecture = $row["prefecture"];
            $dbid = $row["id"];
    
            // テンプレートファイルの文字置き換え
            $insert = str_replace("!dat!", $dat, $insert);
            $insert = str_replace("!time!", $time, $insert);
            $insert = str_replace("!mai!", $mai, $insert);
            $insert = str_replace("!name!", $name, $insert);
            $insert = str_replace("!furi!", $furi, $insert);
            $insert = str_replace("!phone!", $phone, $insert);
            $insert = str_replace("!gender!", $gender, $insert);
            $insert = str_replace("!birthday!", $birthday, $insert);
            $insert = str_replace("!prefecture!", $prefecture, $insert);
            $insert = str_replace("!id!", $dbid, $insert);
            $insert = str_replace("!na!", $dbid, $insert);
    
            $block .= $insert; //
        }

 echo $block;


 ?>
 </body>