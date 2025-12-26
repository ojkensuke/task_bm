    <?php

    ini_set('display_errors', 1);

    // DB接続
    try {
    $pdo = new PDO(
        'mysql:dbname=wheatmouse45_bm;charset=utf8;host=mysql3112.db.sakura.ne.jp',
        'wheatmouse45_bm',
        'happy-3939'
    );
    } catch (PDOException $e) {
    exit('DB_CONNECT:' . $e->getMessage());
    }

    // データ取得
    $sql = "SELECT * FROM gs_bm_table ORDER BY datetime DESC";
    $stmt = $pdo->prepare($sql);
    $status = $stmt->execute();

    if ($status == false) {
    $error = $stmt->errorInfo();
    exit("SQL_ERROR:" . $error[2]);
    }

    // データを配列で取得
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
            </tr>


            <?php foreach ($values as $v){ ?>

                <tr>
                    <td><?= htmlspecialchars($v['id']) ?></td>
                    <td><?= htmlspecialchars($v['name']) ?></td>
                    <td>
                        <a href="<?= htmlspecialchars($v['url']) ?>" target = "blank">
                    <?= htmlspecialchars($v['url']) ?></a>
                    </td>
                    
                    <td><?= htmlspecialchars($v['comment']) ?></td>
                    <td><?= htmlspecialchars($v['datetime']) ?></td>
                </tr>

        <?php } ?>
        </table>

        <br>
        <a href="index.php">登録画面に戻る</a>
    </body>
    </html>