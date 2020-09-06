<?php
function loginFunc($db){
  $stone = 0;
  if (isset($_SESSION['email'])){$email=$_SESSION['email'];}
  if (isset($_SESSION['password'])){$password=$_SESSION['password'];}
  if (isset($_POST['email'])){$email=$_POST['email'];}
  if (isset($_POST['password'])){$password=$_POST['password'];}
  if (isset($password) && isset($email)){
    $check = "select * from sc2020_users where email ='{$email}';";
    $result = pg_query($db ,$check) or die('Query failed: ' . pg_last_error());
    if (pg_num_rows($result) == 1){
      $row = pg_fetch_row($result);
      if (password_verify($password, $row[3])){
        $_SESSION['email'] = $email;
        $stone = 1;
        $user_id = $row[0];
        $name = $row[1];
        $email = $row[2];
        $img = "info.png";
        $array = [$user_id,$name,$img,$email];
        return $array;
      }
    }
  }
  if ($stone == 0){
    header("location: ./login.php");
  }
}

function auth($db){
  if (isset($_SESSION['email'])){
    $email=$_SESSION['email'];
    $check = "select * from sc2020_users where email ='{$email}';";
    $result = pg_query($db ,$check) or die('Query failed1: ' . pg_last_error());
    $row = pg_fetch_row($result);
    $user_id = $row[0];
    $name = $row[1];
    $email = $row[2];
    $superior = $row[4];
    $img = "info.png";
    $array = [$user_id,$name,$img,$email,$superior];
    return $array;
  } else {
    header("location: ./login.php");
  }
}
 ?>
