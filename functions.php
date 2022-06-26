<?php
function GetNav($p, $num_pages){
  if($p > 2){
    $first_page = ' <a href="index.php"><<</a> ';
  }
  else{
    $first_page = '';
  }
  if($p < ($num_pages - 2)){
   $last_page = ' <a href="index.php?page='.$num_pages.'">>></a> ';
  }
  else{
    $last_page = '';
  }
  if($p > 1){
    $prev_page = ' <a href="index.php?page='.($p - 1).'"><</a> ';
  }
  else{
    $prev_page = '';
  }
  if($p < $num_pages){
    $next_page = ' <a href="index.php?page='.($p + 1).'">></a> ';
  }
  else{
    $next_page = '';
  }
  if($p - 2 > 0){
    $prev_2_page = ' <a href="index.php?page='.($p - 2).'">'.($p - 2).'</a> ';
  }
  else{
    $prev_2_page = '';
  }
//
  if($p - 3 > 0){
    $prev_3_page = ' <a href="index.php?page='.($p - 3).'">'.($p - 3).'</a> ';
  }
  else{
    $prev_3_page = '';
  }
  if($p - 4 > 0){
    $prev_4_page = ' <a href="index.php?page='.($p - 4).'">'.($p - 4).'</a> ';
  }
  else{
    $prev_4_page = '';
  }
  if($p - 5 > 0){
    $prev_5_page = ' <a href="index.php?page='.($p - 5).'">'.($p - 5).'</a> ';
  }
  else{
    $prev_5_page = '';
  }
//
  if($p - 1 > 0){
    $prev_1_page = ' <a href="index.php?page='.($p - 1).'">'.($p - 1).'</a> ';
  }
  else{
    $prev_1_page = '';
  }
  if($p + 2 <= $num_pages){
    $next_2_page = ' <a href="index.php?page='.($p + 2).'">'.($p + 2).'</a> ';
  }
  else{
    $next_2_page = '';
  }
  if($p + 1 <= $num_pages){
    $next_1_page = ' <a href="index.php?page='.($p + 1).'">'.($p + 1).'</a> ';
  }
  else{
    $next_1_page = '';
  }
  $nav = $first_page.$prev_page.$prev_2_page.$prev_1_page.$p.$next_1_page.$next_2_page.$next_page.$last_page;
  return $nav;
}
?>