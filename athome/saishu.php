<?php
session_start();
echo "情報の登録が完了しました。";

//データベースへのログイン情報
$dsn = "mysql:host=localhost;dbname=akua;charset=utf8";
$user = "testuser";
$pass = "testpass";

//受け取ったデータを処理する
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


//データベースへ接続
try {
    $dbh = new PDO($dsn, $user, $pass);

    echo "接続しました。";
    register();
} catch (PDOException $e) {
    echo "エラー内容：" .$e->getMessage();
}

//関数機能

function register()
{
    //グローバル宣言をして、基本処理で作成した変数を関数内で使用可能になる。
    global $dbh;
    global $input;

    //userテーブルのdate,time,mai,name,furi,phone,gender,birthday,prefectureの値に、入力された情報を登録
    //sql文を用意
    $sql = <<<sql
    insert into user(dat,time,mai,name,furi,phone,gender,birthday,prefecture) values(?,?,?,?,?,?,?,?,?);
sql;
    //prepare()メゾットを使って、sqlの実行結果を$usオブジェクトに保留
    $us = $dbh->prepare($sql);
    //プレイスホルダーに紐づける。
    $us->bindParam(1, $input["dat"]);
    $us->bindParam(2, $input["time"]);
    $us->bindParam(3, $input["mai"]);
    $us->bindParam(4, $input["name"]);
    $us->bindParam(5, $input["furi"]);
    $us->bindParam(6, $input["phone"]);
    $us->bindParam(7, $input["gender"]);
    $us->bindParam(8, $input["birthday"]);
    $us->bindParam(9, $input["prefecture"]);

    //sql実行
    $us->execute();
}

function display()
{
    //基本処理で定義した変数を使えるように
    global $dbh;
    global $input;

    //sql文を用意
    $sql = <<<sql
    select * from user where flag=1;
    
sql;
    $us = $dbh->prepare($sql);
    $us->execute();

    //$blockがテキストかつ中身がないことを定義する
    $block = "";

    //テンプレートファイルの読み込み
    $fh = fopen("kakuni.tmpl", "r+"); //読み込みモード
    $fs = filesize("kakuni.tmpl"); //ファイルサイズを調べる（のちのfread関数で
    $kakuni_tmpl = fread($fh, $fs); //ファイルの読み込みを行う
    fclose($fh);



    //レコードを１行ずつ繰り返し$blockに入れる
    while ($row = $us->fetch()) {
        //差し込み用テンプレートを初期化する
        $insert = $kakuni_tmpl;

        //データベースの値を、PHPで使用する値として、変数に入れなおす
        $dat = $row["dat"];
        $time = $row["time"];
        $mai = $row["mai"];
        $name = $row["name"];
        $furi = $row["firi"];
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


    $fh = fopen("nyuryoku.html", "r+");
    $fs = filesize("nyuryoku.html");
    $top = fread($fh,$fs);
    fclose($fh);


    //!block!に$blockを差し込む
    $top = str_replace("!block!", $block, $top);

    //すべてを差し替えたデータをブラウザ表示
    echo $top;
}

function delete()
{
    global $dbh;
    global $input;

    //sql文を用意
    $sql = <<<sql
    update uesr set dat=?,time=? ,mai=? ,name=? ,furi=? ,phone=? ,gender=? ,birthday=? ,prefecture=? ;
sql;
    $stmt = $dbh->prepare($sql);

    $stmt->bindParam(1, $input["dat"]);
    $stmt->bindParam(1, $input["time"]);
    $stmt->bindParam(2, $input["mai"]);
    $stmt->bindParam(3, $input["name"]);
    $stmt->bindParam(4, $input["furi"]);
    $stmt->bindParam(5, $input["phone"]);
    $stmt->bindParam(6, $input["gender"]);
    $stmt->bindParam(7, $input["birthday"]);
    $stmt->bindParam(8, $input["prefecture"]);
    $stmt->execute();
}

