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
if (isset($_POST["title"]) && isset($_POST["content"]) && isset($_POST["answerer"])){
  $title = $_POST["title"];
  $content = $_POST["content"];
  $answerer = $_POST['answerer'];
  if ($_SESSION['token'] == $_POST['token']){
    createPost($db,$user_id,$title,$content,$answerer);
    $complete = "<p>投稿しました</p>";
  }
}
$_SESSION["token"] = $token = mt_rand();
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
   </head>
   <body>
     <?php if (isset($complete)){echo $complete;} ?>
     <form class="" action="create.php" method="post">
       <input type="hidden" name="token" value="<?php echo $token;?>">
       <input type="text" name="title" placeholder="タイトル">
       <textarea name="content" rows="6" cols="50" placeholder="質問内容"></textarea>
       <input type="text" name="answerer" value="" placeholder="回答者を選択">
       <input type="submit" name="" value="送信">
     </form>
   </body>
 </html>
