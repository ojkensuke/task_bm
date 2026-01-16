<?php
session_start();
include("funcs.php");
sschk();

if($_SESSION["kanri_flg"]!=1){
    exit("権限がありません");
}

$id = $_GET["id"];
$pdo = db_conn();
$sql = "SELECT * FROM gs_user_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();
if($status==false){
    sql_error($stmt);
}
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー編集</title>
</head>
<body>
    
    <h1>ユーザー編集</h1>
    <form method="POST" action="user_update.php">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
        名前：<input name="name" value="<?= h($user["name"]) ?>"><br>

        権限：
        <select name="kanri_flg">
            <option value="0"  <?= $user["kanri_flg"]==0?"selected":"" ?>>一般</option>
            <option value="1"  <?= $user["kanri_flg"]==1?"selected":"" ?>>管理者</option>
        </select>

        状態：
        <select name="life_flg">
            <option value="0"<?= $user["life_flg"]==0?"selected":"" ?>>アクティブ</option>
            <option value="1" <?= $user["life_flg"]==1?"selected":"" ?>>非アクティブ</option>
        </select>
        <br>

        <input type="submit" value="登録">
    </form>

    <a href="user_select.php">戻る</a>
  


</body>
</html>