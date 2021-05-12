<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>ろくまる農園</title>
</head>
<body>
    <?php
    try {
        #pro_edit_check.phpからのデータ受け取り
        $pro_code = $_POST['code'];
        $pro_name = $_POST['name'];
        $pro_price = $_POST['price'];
        $pro_gazou_name_old = $_POST['gazou_name_old'];
        $pro_gazou_name = $_POST['gazou_name'];

        #エスケープ処理
        $pro_code = htmlspecialchars($pro_code, ENT_QUOTES, 'UTF-8');
        $pro_name = htmlspecialchars($pro_name, ENT_QUOTES, 'UTF-8');
        $pro_price = htmlspecialchars($pro_price, ENT_QUOTES, 'UTF-8');

        $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
        $user = 'root';
        $password = '';
        $dbh = new PDO($dsn, $user, $password);
        $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'UPDATE mst_product SET name = ?, price = ?, gazou = ? WHERE code = ?';
        $stmt = $dbh->prepare($sql);
        $data[] = $pro_name;
        $data[] = $pro_price;
        $data[] = $pro_gazou_name;
        $data[] = $pro_code;
        $stmt -> execute($data);

        $dbh = null;

        #古い画像ファイルが存在し、新しい画像ファイルと名前が違うなら削除 
        if ($pro_gazou_name != $pro_gazou_name_old) {
            if ($pro_gazou_name_old != '') {
                unlink('./gazou/'.$pro_gazou_name_old);
            }
        }

        print '修正しました。<br>';

    } catch (Exception $e) {
        print 'ただいま障害により大変ご迷惑をお掛けしております。';
        exit();
    }
    ?>

    <a href="pro_list.php">戻る</a>
</body>
</html>