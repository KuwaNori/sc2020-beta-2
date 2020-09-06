<?php
session_start();
header('Expires: -1');
header('Cache-Control:');
header('Pragma:');
require_once('connectDB.php');
require_once('loginFunc.php');
require_once('createFunc.php');
require_once('posts.php');
require_once('getChat.php');
$db = connectDB();
$user = auth($db);
$user_id = $user[0];
$name = $user[1];
$img = $user[2];
$email = $user[3];
if (isset($_POST['pid'])){
  $pid= $_POST['pid'];
  $_SESSION['pid'] =$post_id;
} else {
  $pid = $_SESSION['pid'];
}
$chats = getChats($db,$pid);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>チャットサンプル</title>
    <link type="text/css" rel="stylesheet" href="./css/bmesse.css" />
</head>
<body>
    <!-- 自分やユーザーの情報 -->
    <h3 id="me" user_id="1">あなたはユーザー1です</h3>
   <h3 id="partner" thread_id="1">相手</h3>
   <div id="users">
       <button class="user" user_id="2">ユーザー2</button>
    </div>
    <br>
    <div id="your_container">

        <!-- チャットの外側部分① -->
        <div id="bms_messages_container">
            <!-- ヘッダー部分② -->
            <div id="bms_chat_header">
                <!--ステータス-->
                <div id="bms_chat_user_status">
                <div id="bms_status_icon">●</div>
                <!--ユーザー名-->
                <div id="bms_chat_user_name">ユーザー</div>
              </div>
            </div>

            <!-- タイムライン部分③ -->
            <div id="bms_messages">
              <!--メッセージ１-->
              <?php foreach ($chats as $chat):?>
              <?php if ($chat[2] == $user_id): ?>
                <div class="bms_message bms_right">
                    <div class="bms_message_box">
                        <div class="bms_message_content">
                            <div class="bms_message_text"><?php echo $chat[3]; ?></div>
                        </div>
                    </div>
                </div>
                <div class="bms_clear"></div><!-- 回り込みを解除（スタイルはcssで充てる） -->
              <?php else: ?>
                <!--メッセージ２-->
                <div class="bms_message bms_left">
                      <div class="bms_message_box">
                          <div class="bms_message_content">
                              <div class="bms_message_text"><?php echo $chat[3]; ?></div>
                          </div>
                      </div>
                  </div>
                  <div class="bms_clear"></div><!-- 回り込みを解除（スタイルはcssで充てる） -->
              <?php endif ?>
            </div>
          <?php endforeach ?>
            <!-- テキストボックス、送信ボタン④ -->
            <div id="bms_send">
                <textarea id="bms_send_message"></textarea>
                <div id="bms_send_btn">送信</div>
            </div>
        </div>
    </div>
</body>
</html>
