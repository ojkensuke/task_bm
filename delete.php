<?php
$id = $_GET['id'];

require_once('config.php');
$pdo = new PDO(
  'mysql:dbname='.DB_NAME.';charset=utf8;host='.DB_HOST,
  DB_USER,
  DB_PASS
);

$sql = "DELETE FROM gs_bm_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status === false) {
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:" . $error[2]);
} else {
  header("Location: select.php");
  exit();
}
