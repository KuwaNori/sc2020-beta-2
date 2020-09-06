<?php
function getDoneID($db){
  $get = 'select * from sc2020_done order by done_time desc;';
  $result = pg_query($db ,$get) or die('Query failed1: ' . pg_last_error());
  $array=array();
  foreach ($result as $v) {
    $array[] = $v;
  }
  return $array;
}
function SearchDone($db,$dones,$key){
  $get = "select post_id from sc2020_posts where title like '%{$key}%';";
  $result = pg_query($db ,$get) or die('Query failed1: ' . pg_last_error());
  $array=array();
  foreach ($result as $v) {
    if (in_array($v,$dones)){
      $array[]=$v;
    }
  }
  return $array;
}
function getPosts($db,$user_id){
  $get = "select * from sc2020_posts where po_user_id={$user_id}";
  $result = pg_query($db,$get) or die('Query failed1: ' . pg_last_error());
  $array=array();
  while ($line = pg_fetch_row($result)) {
    $list=[$line[0],$line[1],$line[2],$line[3],$line[4]];
    $array[]= $list;
  }
  return $array;
}
?>
