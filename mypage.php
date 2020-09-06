<?php
session_start();
header('Expires: -1');
header('Cache-Control:');
header('Pragma:');
require_once('connectDB.php');
require_once('loginFunc.php');
require_once('createFunc.php');
require_once('posts.php');
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
$chats = getPosts($db,$user_id);
$_SESSION["token"] = $token = mt_rand();
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">

     <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>タイトル</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
      <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100&display=swap" rel="stylesheet"　type="text/css">
   </head>

   <!-- CSS -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
   <link rel="stylesheet" type="text/css" href="./css/mypage.css">
   <link rel="stylesheet" type="text/css" href="./css/header.css">


    <!-- jQuery,JS-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>



   <body>
     <!-- ヘッダー -->
     <header>
     <div class="headerinner">
       <div class="icon"> <a href="./mypage.php"> <img src="./img/<?php echo $img; ?>" alt="" style="height:40px; border-radius:50%;">
        <?php echo $name; ?></a></div>
        <div style="text-align:center"><img class="logo" src="./img/moyamoya.png"></div>
     </div>
   <!--メニュ-->
     <input type="checkbox" class="check" id="checked">
     <label class="menu-btn" for="checked">
         <span class="bar top"></span>
         <span class="bar middle"></span>
         <span class="bar bottom"></span>
         <span class="menu-btn__text">MENU</span>
     </label>
     <label class="close-menu" for="checked"></label>
     <nav class="drawer-menu">
         <ul>
             <li><a href="./main.php">Main</a></li>
             <li><a href="./useredit.php">ユーザー情報編集</a></li>
             <li><a href="./logout.php">ログアウト</a></li>
         </ul>
     </nav>
   </header>

     <div class="ue">
       <div class="welcome"><?php echo $name; ?>さん、ようこそ</div>
       <div class="mail">Email:<?php echo $email;?> </div>


       <!-- 質問するButton  -->
          <div class="col text-center">
             <button type="button" class="btn btn-dark btn-lg" data-toggle="modal" data-target="#exampleModal">
               質問する<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
             </button>
          </div>


       <!-- 質問フォーム -->
       <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
           <div class="modal-content">
             <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">質問作成</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>
             <div class="modal-body">
               <form class="" action="" method="post">

                 <p><input type="text" name="title" placeholder="タイトル"></p>
                 <p><textarea name="content" rows="6" cols="50" placeholder="質問内容"></textarea></p>
                 <p><input type="text" name="" value="" placeholder="回答者を選択"></p>
                 <input type="submit"  name="" value="送信">
               </form>
             </div>
           </div>
         </div>
       </div>
​
<!-- チャット、解決済み　ボタングループ -->
      <div>
        <div class="btn-group" role="group" aria-label="Basic example">
          <button type="button" class="btn btn-secondary"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>チャット</button>
          <button type="button" class="btn btn-secondary">解決済み<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
          </button>
         </div>
      </div>
    </div>

<!-- チャット内容一覧 -->
      <?php foreach ($chats as $chat):?>
        <div class="card">
          <div class="card-body">
            <form action="./mypage.php" method="post">
              <label class="container">質問タイトル
                <input type="checkbox" name="checkbox[]" value="0">
                <span class="checkmark"></span>
                <button type="submit" class="submit_button">
                  解決<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
                </button>
              </label>
           </form>
           <form action="./chat.php" method="post">
               <input type="hidden" name="pid" value="<?php echo $chat[0]; ?>">
               <button type="submit" class="submit_button">
                 チャットへ<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
               </button>
             </label>
          </form>
          </div>
        </div>
      <?php endforeach ?>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

   </body>
 </html>
