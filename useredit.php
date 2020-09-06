<?php
session_start();
header('Expires: -1');
header('Cache-Control:');
header('Pragma:');
require_once('connectDB.php');
require_once('loginFunc.php');
require_once('createFunc.php');
$db = connectDB();
$user = auth($db);
$user_id = $user[0];
$name = $user[1];
$img = $user[2];
$email = $user[3];
$superior = $user[4];
if(isset($_POST['superior'])){
  $superior=$_POST['superior'];
  $sql="update sc2020_users set superior='$superior' where user_id=$user_id;";
  pg_query($db,$sql) or die('Query failed: ' . pg_last_error());
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="./css/useredit.css">
<title>ユーザー情報編集</title>
</head>
<body>
<div class="title">
 <p><?php echo $name; ?>さんのユーザー情報</p>
</div>
<div class="info">
  <p class="info-index">ユーザーネーム</p>
  <div class="data"><?php echo "<p>" . $name . "</p>"; ?></div>
  <p class="info-index">emailアドレス</p>
  <div class="data"><?php echo "<p>" . $email . "</p>"; ?></div>
  <p class="info-index">得意分野</p>
  <p><?php
   // if(isset($superior)){ echo $superior;}
   ?></p>
  <!-- テキストボックス -->
  <form method="post" action="./useredit.php">
  <div class="cp_iptxt">
    <label class="ef">
    <input type="text" name="superior" value="<?php if(isset($superior)){ echo $superior;} ?>" class="info-txt">
  </label>
  </div>

  <!-- テキストボックス のボタン-->
  <div class="submit">
    <input type="submit" name="" value="OK" class="submit-btn">
  </div>
  </form>
</div>

  <!-- 戻る　-->
  <div class="back">
  <a href="./main.php" class="back-btn">戻る</a>
  </div>

</body>
</html>
