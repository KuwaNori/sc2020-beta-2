<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/login.css" type="text/css">
    <title>moyamoya login</title>
  </head>
  <body>
    <div class="logo"><img src="./img/moyamoya.png"></div>
    <div class="login">
     <form class="logform" action="main.php" method="post">
       <div class="cp">
        <!--email-->
        <div class="cp_iptxt">
	        <label class="ef">
	        <input type="text" name="email" placeholder="email" required>
	        </label>
        </div>
        <!-- password-->
        <div class="cp_iptxt">
          <label class="ef">
          <input type="password" name="password" placeholder="password" required>
          </label>
        </div>
        <!-- botton -->
        <button type="submit" class="btn">ログイン</button><br>
        <a href="./regist.php" class="btn">新規登録</a>
      </div>
     </form>
    </div>
  </body>
  </html>
