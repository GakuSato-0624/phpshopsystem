<?php
session_start();
$_SESSION=array();
if(isset($_COOKIE[session_name()])==true)
{
	setcookie(session_name(),'',time()-42000,'/');
}
session_destroy();
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>ろくまる農園</title>
</head>
<body>
    ログアウトしました。<br>
    <br>
    <a href="shop_list.php">ログイン画面へ</a>
</body>
</html>