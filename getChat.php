<?php
function getChats($db,$pid){
  $get = "select * from sc2020_chat where post_id='{$pid}';";
  $result = pg_query($db,$get) or die('Query failed1: ' . pg_last_error());
  $array=array();
  while ($line = pg_fetch_row($result)) {
    $list=[$line[0],$line[1],$line[2],$line[3],$line[4],$line[5]];
    $array[]= $list;
  }
  return $array;
}
 ?>
