<?php
echo "予約情報一覧画面表示。<br>";

//データベースへのログイン情報
$dsn = "mysql:host=localhost;dbname=akua;charset=utf8";
$user = "testuser";
$pass = "testpass";

$origin=[];//ここに、処理前のデータが入る
if(isset($_SESSION)){
    $origin+=$_SESSION;//$originに処理前のGETデータを入れる
}
if(isset($_POST)){
    $origin+=$_POST;//$originに処理前のGETデータを入れる
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
    
    if(isset($input["mode"])){
        
        if($input["mode"] == "delete"){
            delete();//削除処理  
        }elseif($input["mode"] == "update"){
            update();
        }
       
        
    }
    echo "管理者が接続しています。<br>";
    display();

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
    select * from user where flag=1;

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
        $id = $row["ID"];


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
        $insert = str_replace("!id!", $id, $insert);


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

//userテーブルに入っている情報を削除。

function delete(){
    global $dbh;
    global $input;

    //sql文を用意
    $sql=<<<sql
    update user set flag=0 where id=?;
sql;
    $stmt=$dbh->prepare($sql);

      $stmt->bindParam(1,$input["id"]);
      $stmt->execute();

}

function update(){
    global $dbh;
    global $input;

    $sql=<<<sql

    update user set age=dat where; 

sql;
$stmt=$dbh->prepare($sql);

$stmt->bindParam(1,$input["dat"]);
$stmt->bindParam(2,$input["time"]);
$stmt->bindParam(3,$input["mai"]);
$stmt->execute();



}
   

   
