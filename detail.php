<?php

$id = $_GET['id'];
require_once('config.php');

$pdo = new PDO(
  'mysql:dbname='.DB_NAME.';charset=utf8;host='.DB_HOST,
  DB_USER,
  DB_PASS
);

$sql = "SELECT * FROM gs_bm_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$v = $stmt->fetch(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ブックマーク更新</title>
</head>

<body>
  <h1>ブックマーク更新</h1>

  <form method="POST" action="update.php">
    <input type="hidden" name="id" value ="<?= $v['id']  ?>">

    <div>
      書籍名：<input type="text" name="name" value ="<?= htmlspecialchars($v['name']) ?>" required>
    </div>

    <div>
      書籍URL：<input type="text" name="url" value="<?= htmlspecialchars($v['url']) ?>">
    </div>

    <div>
      コメント：<input type="text" name="comment" value="<?= htmlspecialchars($v['comment']) ?>">
    </div>
    <input type="submit" value="更新">
  </form>

  
</body>

</html>