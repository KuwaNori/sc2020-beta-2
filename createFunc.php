<?php
function createPost($db,$user_id,$title,$content,$answerer){
  $post_id = uniqid();
  $createPost = "insert into sc2020_posts (post_id,an_user_id,po_user_id) values('{$post_id}','{$answerer}', {$user_id});";
  pg_query($db,$createPost) or die('Query failed: ' . pg_last_error());
  $createChat = "insert into sc2020_chat (post_id,user_id,chat,title) values('{$post_id}',$user_id,'$content','{$title}');";
  pg_query($db,$createChat) or die('Query failed: ' . pg_last_error());
}
 ?>
