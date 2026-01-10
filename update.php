<?php
$id = $_POST['id'];
$name = $_POST['name'];
$url = $_POST['url'];
$comment = $_POST['comment'];

require_once('config.php');
$pdo = new PDO(
  'mysql:dbname='.DB_NAME.';charset=utf8;host='.DB_HOST,
  DB_USER,
  DB_PASS
);

$sql = "UPDATE gs_bm_table 
        SET name=:name, url=:url, comment=:comment 
        WHERE id=:id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':url', $url, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status === false) {
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:" . $error[2]);
} else {
  header("Location: select.php");
  exit();
}
