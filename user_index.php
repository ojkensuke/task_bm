<?php
session_start();
include("funcs.php");
sschk();

if($_SESSION["kanri_flg"]!=1){
    exit("権限がありません");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー登録</title>
</head>
<body>
    <h1>ユーザー登録</h1>
    <form method="POST" action="user_insert.php">
        名前：<input type="text" name="name"><br>
        ログインID：<input type="text" name="lid"><br>
        ログインパスワード：<input type="password" name="lpw"><br>

        権限：
        <select name="kanri_flg">
            <option value="0">一般</option>
            <option value="1">管理者</option>
        </select>

        状態：
        <select name="life_flg">
            <option value="0">アクティブ</option>
            <option value="1">非アクティブ</option>
        </select>
        <br>

        <input type="submit" value="登録">
    </form>

    <a href="user_select.php">戻る</a>
</body>
</html>