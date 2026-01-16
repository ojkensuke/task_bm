<?php
session_start();
include("funcs.php");
sschk();

if($_SESSION["kanri_flg"]!=1) {
    exit('権限がありません');
}

$id = $_POST["id"];
$name = $_POST["name"];
$kanri_flg = $_POST["kanri_flg"];
$life_flg = $_POST["life_flg"];

$pdo = db_conn();
$sql = "UPDATE gs_user_table
        SET name=:name, kanri_flg=:kanri_flg, life_flg=:life_flg
        WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);
$stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_INT);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

$status = $stmt->execute();
if ($status == false) {
  sql_error($stmt);
}

header("Location: user_select.php");
exit();