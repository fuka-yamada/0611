<?php

//データの受け取り
$input_id=$_POST["id"];
$input_pass=$_POST["pass"];

//確認用にidとpass（本来はデータベースからselectで取ってくる）
$id="yamada";
$pass="56789";//本来は暗号化したものが入る。

//入力されたidとpassが、ｄｂのidとpassが一致したら
if($input_id == $id && $input_pass == $pass){
    echo "ログイン成功！！";
    session_start();//セッション情報を扱う
    $_SESSION["id"]=$input_id;//セッション情報を保存する
    echo "ログインしているのは{$_SESSION["id"]}さんです";//セッション情報の使用

    header("location:kanrisha.php");//
    
}else{
    echo "ログイン失敗・・・ID、パスワードが違います。";
}
