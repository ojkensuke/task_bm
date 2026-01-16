<?php
  
  session_start();
  require_once('config.php'); 
  require_once('funcs.php');  
  sschk();
  if($_SESSION['kanri_flg']!=1){
    exit('LOGIN_ERROR:管理者権限がありません');
  }
  // POSTチェック
if (
    !isset($_POST['name']) || $_POST['name'] === '' ||
    !isset($_POST['lid'])  || $_POST['lid'] === ''  ||
    !isset($_POST['lpw'])  || $_POST['lpw'] === ''
) {
    exit('ParamError');
}
  $name = $_POST['name'];
  $lid = $_POST['lid'];
  $lpw = password_hash($_POST['lpw'], PASSWORD_DEFAULT);
    $kanri_flg = $_POST['kanri_flg'];
    $life_flg = $_POST['life_flg'];

try {
  //Password:MAMP='root',XAMPP=''
$pdo = new PDO(
  'mysql:dbname='.DB_NAME.';charset=utf8;host='.DB_HOST,
  DB_USER,
  DB_PASS
);
} catch (PDOException $e) {
  exit('DB_CONNECT:'.$e->getMessage());
}

//３．データ登録SQL作成
$sql = "INSERT INTO gs_user_table(name,lid,lpw,kanri_flg,life_flg)VALUES(:name, :lid, :lpw, :kanri_flg, :life_flg);";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name',  $name,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', $lid,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw',   $lpw,    PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kanri_flg',   $kanri_flg,    PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':life_flg',   $life_flg,    PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]);
}else{
  redirect("user_select.php");
  exit();
}

  ?>