<?php
echo "予約情報一覧画面表示。<br>";

//データベースへのログイン情報
$dsn = "mysql:host=localhost;dbname=akua;charset=utf8";
$user = "testuser";
$pass = "testpass";


//データベースへ接続
try {
    $dbh = new PDO($dsn, $user, $pass);

    echo "管理者が接続しています。<br>";
    //register();
} catch (PDOException $e) {
    echo "管理者の接続がエラーになっています。<br>" . $e->getMessage();
}


function display()
{
    //基本処理で定義した変数を使えるように
    global $dbh;
    global $input;

    $sql = <<<sql
    select * from user;

sql;
    $us = $dbh->prepare($sql);
    $us->execute();

    //$blockがテキストかつ中身がないことを定義する
    $block = "";

    //テンプレート
    $fh = fopen("play.tmpl", "r+"); //読み込みモード
    $fs = filesize("play.tmpl"); //ファイルサイズを調べる（のちのfread関数で
    $kakuni_tmpl = fread($fh, $fs); //ファイルの読み込みを行う
    fclose($fh);

    while ($row = $us->fetch()) {
        //差し込み用テンプレートを初期化する
        $insert = $kakuni_tmpl;

        //データベースの値を、PHPで使用する値として、変数に入れなおす
        $dat = $row["dat"];
        $time = $row["time"];
        $mai = $row["mai"];
        $name = $row["name"];
        $furi = $row["furi"];
        $phone = $row["phone"];
        $gender = $row["gender"];
        $birthday = $row["birthday"];
        $prefecture = $row["prefecture"];

        //テンプレートファイルの文字置き換え
        $insert = str_replace("!dat!", $dat, $insert);
        $insert = str_replace("!time!", $time, $insert);
        $insert = str_replace("!mai!", $mai, $insert); 
        $insert = str_replace("!name!", $name, $insert);
        $insert = str_replace("!furi!", $furi, $insert);
        $insert = str_replace("!phone!", $phone, $insert);
        $insert = str_replace("!gender!", $gender, $insert);
        $insert = str_replace("!birthday!", $birthday, $insert);
        $insert = str_replace("!prefecture!", $prefecture, $insert);


        $block.= $insert; //

    }

    $fh = fopen("reserve.html", "r+");
    $fs = filesize("reserve.html");
    $top = fread($fh,$fs);
    fclose($fh);


    //!block!に$blockを差し込む
    $top = str_replace("!block!", $block, $top);

    //すべてを差し替えたデータをブラウザ表示
    echo $top;
   
}
display();
