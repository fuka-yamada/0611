<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>編集画面</title>
     <link rel="stylesheet" href="../CSS/design_kan2.css"> 
</head>

<body>
    <h1>最終確認フォーム</h1>
<?php



session_start();
//nyuryoku.htmlから情報を受け取った。
$input_dat=$_GET["dat"];
$input_time=$_GET["time"];
$input_mai=$_GET["mai"];
$input_name=$_GET["name"];
$input_furi=$_GET["furi"];
$input_phone=$_GET["phone"];
$input_gender=$_GET["gender"];
$input_birthday=$_GET["birthday"];
$input_prefecture=$_GET["prefecture"];
//完了画面で使うためにセッションに情報を持たせる。
$_SESSION["dat"]=$input_dat;
$_SESSION["time"]=$input_time;
$_SESSION["mai"]=$input_mai;
$_SESSION["name"]=$input_name;
$_SESSION["furi"]=$input_furi;
$_SESSION["phone"]=$input_phone;
$_SESSION["gender"]=$input_gender;
$_SESSION["birthday"]=$input_birthday;
$_SESSION["prefecture"]=$input_prefecture;



// tmplファイルを読み込む
$fp = fopen("../tmpl/kakuni.tmpl" ,"r+");
$fps = filesize("../tmpl/kakuni.tmpl");//大切
$kakunin_tmpl = fread($fp,$fps);
fclose($fp);

// 置き換える
$kakunin = str_replace("!dat!",$input_dat,$kakunin_tmpl);
$kakunin = str_replace("!time!",$input_time,$kakunin);
$kakunin = str_replace("!mai!",$input_mai,$kakunin);
$kakunin = str_replace("!name!",$input_name,$kakunin);
$kakunin = str_replace("!furi!",$input_furi,$kakunin);
$kakunin = str_replace("!phone!",$input_phone,$kakunin);
$kakunin = str_replace("!gender!",$input_gender,$kakunin);
$kakunin = str_replace("!birthday!",$input_birthday,$kakunin);
$kakunin = str_replace("!prefecture!",$input_prefecture,$kakunin);

echo $kakunin;

?>
</body>