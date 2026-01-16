<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    
    <h2>ログイン</h2>
    <form action="login_act.php" method="POST">
        ID: <input type="text" name="lid"><br>
        PW: <input type="password" name="lpw"><br>
        <input type="submit" value="ログイン">
    </form>

</body>
</html>