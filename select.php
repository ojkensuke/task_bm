<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once(__DIR__ . '/funcs.php');
sschk(); // ログインチェック

// DB接続（★ここが重要）
$pdo = db_conn();

// データ取得
$sql = "SELECT * FROM gs_bm_table";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

if ($status === false) {
    $error = $stmt->errorInfo();
    exit("SQL_ERROR:" . $error[2]);
}

$values = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ブックマーク一覧</title>
    </head>

    <body>

        <h1>ブックマーク一覧</h1>

        <table border="1">
            <tr>
                <th>ID</th>
                <th>書籍名</th>
                <th>URL</th>
                <th>コメント</th>
                <th>登録日時</th>
                <th>更新</th>
                <th>削除</th>
            </tr>


            <?php foreach ($values as $v) { ?>

                <tr>
                    <td><?= htmlspecialchars($v['id']) ?></td>
                    <td><?= htmlspecialchars($v['name']) ?></td>
                    <td><?= htmlspecialchars($v['url']) ?></td>
                    <td><?= htmlspecialchars($v['comment']) ?></td>
                    <td><?= htmlspecialchars($v['datetime']) ?></td>
                    <td>
                        <a href="detail.php?id=<?= $v['id'] ?>">更新</a>
                    </td>

                    <td>
                        <a href="delete.php?id=<?= $v['id'] ?>" onclick="return confirm('削除しますか？')">削除</a>
                    </td>
                </tr>

            <?php } ?>
        </table>

        <br>
        <a href="index.php">登録画面に戻る</a>

<?php if($_SESSION["kanri_flg"] == 1){ ?>
  <a href="user_select.php">ユーザー管理</a>
<?php } ?>

    </body>

    </html>