<?php
  session_start();
  header('Expires: -1');
  header('Cache-Control:');
  header('Pragma:');
  require_once('connectDB.php');
  require_once('loginFunc.php');
  require_once('posts.php');
  $db = connectDB();
  if (isset($_SESSION['email'])){
    $user = auth($db);
  } else {
    $user = loginFunc($db);
  }
  $user_id = $user[0];
  $name = $user[1];
  $img = $user[2];
  $email = $user[3];
  $doneposts = getDoneID($db);
  if (isset($_POST['search'])){
    $key = $_POST['search'];
    $doneposts = searchDone($db,$doneposts,$key);
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100&display=swap" rel="stylesheet"　type="text/css">
    <link rel="stylesheet" href="./css/main.css" type="text/css">
    <link rel="stylesheet" href="./css/header.css" type="text/css">
  </head>
  <body>
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
              <li><a href="./mypage.php">マイページ</a></li>
              <li><a href="./useredit.php">ユーザー情報編集</a></li>
              <li><a href="./logout.php">ログアウト</a></li>
          </ul>
      </nav>
    </header>
    <div class="welcome"><?php echo $name; ?>さん、ようこそ</div>
    <!-- 検索
    <div class="">
      <form class="" action="main.php" method="post" id="content">
        <input type="text" name="search" id="search-input" class="input" placeholder="キーワード、ユーザー名">
        <button type="reset" class="search" id="search-btn"></button>
      </form>
    </div>-->

    <!-- 検索 new-->
    <div class="ccc">
      <form class="ddd" action="main.php" method="post" id="content">
        <input type="text" name="search" id="search-input" class="input" placeholder="キーワード、ユーザー名">
        <button type="reset" class="search" id="search-btn"></button>
      </form>
    </div>

    <!-- タイムライン -->
    <div class="tl"><p>解決済みの質問</p></div>
    <div class="">
      <?php foreach($doneposts as $post): ?>
        <div class="tl"><p><?php echo $post[1]; ?></p></div>
        <p>11</p>
      <?php endforeach ?>
    </div>


    <script type="text/javascript" src="./js/search.js"></script>
  </body>
</html>
