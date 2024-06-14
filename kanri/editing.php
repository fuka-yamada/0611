<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
     <link rel="stylesheet" href="../CSS/design_kan2.css"> 
</head>

<body>

<?php
//データベースの接続
$dsn = "mysql:host=localhost;dbname=akua;charset=utf8";
$user = "testuser";
$pass = "testpass";

$origin=[];//ここに、処理前のデータが入る

if(isset($_POST)){
    $origin+=$_POST;
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

    echo "入力完了しました。";
    edit();
    echo "<button><a href = 'kanrisha.php'  style='width:60px;height:30px'>戻る</a></button>";
    //register();
} catch (PDOException $e) {
    echo "エラー内容：" .$e->getMessage();
}
function edit()
{
    global $dbh;
    global $input;

    // var_dump($input);

    //sql文を用意
    $sql = <<<sql
    update user set dat=?,time=? ,mai=? ,name=? ,furi=? ,phone=? ,gender=? ,birthday=? ,prefecture=?  where id=?;
sql;
    $stmt = $dbh->prepare($sql);

    $stmt->bindParam(1, $input["dat"]);
    $stmt->bindParam(2, $input["time"]);
    $stmt->bindParam(3, $input["mai"]);
    $stmt->bindParam(4, $input["name"]);
    $stmt->bindParam(5, $input["furi"]);
    $stmt->bindParam(6, $input["phone"]);
    $stmt->bindParam(7, $input["gender"]);
    $stmt->bindParam(8, $input["birthday"]);
    $stmt->bindParam(9, $input["prefecture"]);
    $stmt->bindParam(10, $input["id"]);
    $stmt->execute();

}
?>
 </body>
 <link rel="stylesheet" href="../CSS/design.css">



