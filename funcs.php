<?php
require_once('config.php');

function db_conn(){
  try {
    return new PDO(
      'mysql:dbname='.DB_NAME.';charset=utf8;host='.DB_HOST,
      DB_USER,
      DB_PASS
    );
  } catch (PDOException $e) {
    exit('DB_CONNECT:' . $e->getMessage());
  }
}

function redirect($file_name){
  header("Location: ".$file_name);
  exit();
}

function h($str){
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// ログインチェック
function sschk(){
  if(!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"] != session_id()){
    exit("Login Error");
  }else{
    session_regenerate_id(true);
    $_SESSION["chk_ssid"] = session_id();
  }
}
