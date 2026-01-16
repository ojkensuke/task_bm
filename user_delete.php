<?php
session_start();
include("funcs.php");
sschk();

if ($_SESSION["kanri_flg"] != 1) {
  exit("権限がありません");
}

$id = $_GET["id"];

$pdo = db_conn();
$sql = "DELETE FROM gs_user_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();
if ($status == false) {
  sql_error($stmt);
}

header("Location: user_select.php");
exit();
