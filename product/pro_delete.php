<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>ろくまる農園</title>
</head>
<body>
    <?php
    try {
        #データ受け取り
        $pro_code = $_GET['procode'];

        #DB connection
        $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
        $user = 'root';
        $password = '';
        $dbh = new PDO($dsn, $user, $password);
        $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        #Query execute
        $sql = 'SELECT name, gazou FROM mst_product WHERE code =?';
        $stmt = $dbh -> prepare($sql);
        $data[] = $pro_code;
        $stmt -> execute($data);

        $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
        $pro_name = $rec['name'];
        $pro_gazou_name = $rec['gazou'];

        $dbh = null;

        if ($pro_gazou_name == '') {

            $diap_gazou = '';
        } else {
            $disp_gazou = '<img src="./gazou/'.$pro_gazou_name.'">';
        }
    } catch (Exception $e) {
        print 'ただいま障害により大変ご迷惑をお掛けしております。';
        exit();
    }

    ?>

    商品削除<br>
    <br>
    商品コード<br>
    <?php print $pro_code; ?>
    <br>
    商品名<br>
    <?php print $pro_name; ?>
    <br>
    <?php print $disp_gazou; ?>
    <br>
    この商品を削除してもよろしいですか？<br>
    <br>
    <form method="POST" action="pro_delete_done.php">
        <input type="hidden" name="code" value="<?php print $pro_code; ?>"><br>
        <input type="hidden" name="gazou_name" value="<?php print $pro_gazou_name; ?>">
        <input type="button" onclick="history.back()" value="戻る"><br>
        <input type="submit" value="OK">
    </form>
</body>
</html>