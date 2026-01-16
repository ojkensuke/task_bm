<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once("funcs.php");

$lid = $_POST["lid"] ?? '';
$lpw = $_POST["lpw"] ?? '';

if ($lid === '' || $lpw === '') {
  redirect("login.php");
  exit();
}

$pdo = db_conn();

$sql = "SELECT * FROM gs_user_table WHERE lid=:lid AND life_flg=0";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->execute();
$val = $stmt->fetch(PDO::FETCH_ASSOC);

// ★ユーザーがいなければ即戻す（必須）
if (!$val) {
  redirect("login.php");
  exit();
}

// ★パスワードOKならセッション再生成（重要）
if (password_verify($lpw, $val["lpw"])) {
  session_regenerate_id(true);
  $_SESSION["chk_ssid"]  = session_id();
  $_SESSION["kanri_flg"] = $val['kanri_flg'];
  $_SESSION["name"]      = $val['name'];
  $_SESSION["lid"]       = $val['lid'];   // ← sschkをlid判定にするなら必須
  redirect("select.php");
  exit();
} else {
  redirect("login.php");
  exit();
}
