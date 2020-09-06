<?php
require_once("connectDB.php");
require_once("registFunc.php");
$db = connectDB();
$row = registFunc($db);
$a = $row[0];
$b = $row[1];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="./css/login.css" type="text/css">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./css/regist.css">
  </head>
  <body>
    <div class="parent">
      <p class="sample">
        <img src="./img/moyamoya.png">
      </p>
    <form class="" action="regist.php" method="post">
      <h1>新規登録</h1>
      <h3>下記のフォームから新規登録をしてください</h3>
      <div class=""><input type="text" name="name" placeholder="名前"></div>
      <div class=""><input type="email" name="email" placeholder="Email">
      <?php if ($b !== 0){echo $b;} ?></div>
      <div class=""><input type="password" name="pass1" placeholder="パスワード"></div>
      <div class=""><input type="password" name="pass2" placeholder="パスワード（確認）">
      <?php if ($a !== 0){echo $a;} ?></div>
      <button type="submit" class="btn">新規登録</button><br>
      <a href="./login.php" class="btn">
        <span data-text="ログイン">ログイン</span></a>
    </form>
    </div>
  </body>
</html>
