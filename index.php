<?php
session_start();
require_once('config.php');
require_once('funcs.php');
sschk();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ブックマーク登録</title>
</head>

<body>
  <h1>ブックマーク登録</h1>

  <form method="POST" action="insert.php">
    <div>
      書籍名：<input type="text" name="name" required>
    </div>

    <div>
      書籍URL：<input type="text" name="url">
    </div>

    <div>
      コメント：<input type="text" name="comment">
    </div>
    <input type="submit" value="登録">
  </form>

  
</body>

</html>