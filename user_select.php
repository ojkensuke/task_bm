<?php
session_start();
include("funcs.php");
sschk();

if($_SESSION["kanri_flg"]!=1){
    exit("権限がありません");
}

$pdo=db_conn();
$sql="SELECT * FROM gs_user_table";
$stmt=$pdo->prepare($sql);
$status=$stmt->execute();       
if($status==false){
    sql_error($stmt);
}
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー一覧</title>
</head>
<body>
    
    <a href="user_index.php">新規ユーザー登録</a> 

    <h1>ユーザー管理</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>名前</th>
            <th>ログインID</th>
            <th>ログインパスワード</th>
            <th>管理フラグ</th>
            <th>ライフフラグ</th>
            <th>更新</th>
            <th>削除</th>
        </tr>

        <?php foreach($users as $u){ ?>
        <tr>
            <td><?= htmlspecialchars($u['id']) ?></td>
            <td><?= htmlspecialchars($u['name']) ?></td>
            <td><?= htmlspecialchars($u['lid']) ?></td>
            <td><?= htmlspecialchars($u['lpw']) ?></td>
            <td><?= htmlspecialchars($u['kanri_flg']) ?></td>
            <td><?= htmlspecialchars($u['life_flg']) ?></td>
            <td><a href="user_detail.php?id=<?= $u['id'] ?>">更新</a></td>
            <td><a href="user_delete.php?id=<?= $u['id'] ?>">削除</a></td>
        </tr>
        <?php } ?>


</body>
</html>