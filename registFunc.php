<?php
function registFunc($db){
  if (isset($_POST['email'])){$email=$_POST['email'];}
  if (isset($_POST['name'])){$name=$_POST['name'];}
  if (isset($_POST['pass1'])){$pass1=$_POST['pass1'];}
  if (isset($_POST['pass2'])){$pass2=$_POST['pass2'];}
  if (isset($email) && isset($name) && isset($pass1) && isset($pass2)){
    if ($pass1 !== $pass2){
      $a = "パスワードが一致しませんでした。";
    } else{
       $sql="select * from sc2020_users where email='{$email}';";
       $result = pg_query($db,$sql) or die('Query failed: ' . pg_last_error());
       if(pg_num_rows($result)==0){
         $cpass=password_hash($pass1, PASSWORD_BCRYPT);
         $sql="insert into sc2020_users(name, email, password) values ('{$name}','{$email}','{$cpass}');";
         pg_query($sql) or die('Query failed: '.pg_last_error());
         // メール送信
         // $mailfr="mtymkh223@gmail.com(新しいタブが開きます)";
         // $mailsb="May Project group2 ユーザ登録完了";
         // $mailms="下記のとおりユーザ登録を完了しました。\n\n"."   ユーザ名:　".$unf."\n"."   email:　" . $emf . "\n\n"."こちらのURLよりログインしてください:　http://gms.gdl.jp/~kuwanori/MayGroup2/login2.html\n\n";
         // if (mb_send_mail($emf, $mailsb, $mailms, "From: ". $mailfr)) {
         //   echo "<p>メールが送信されました。</p>";
         // } else {
         //   echo "<p>メールの送信に失敗しました。</p>";
         // }
         // echo "<a href=\"./login2.html\">戻る</a>";
         echo "<p>登録が完了しました。</p>";
         $a = 0;
         $b = 0;
        } else {
         $b = "すでに存在するメールアドレスです。";
      }
    }
    $array =[$a,$b];
    return $array;
  } else {
    $array =[0,0];
    return ;
  }
}
 ?>
