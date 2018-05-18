<?php
if (isset($_GET['goods_issue']) == "true") {
 include ("/modules/goods_issue/goods_issue_view.php") ;
}
if(isset($_GET['view_item']) == "true") {
 include ("modules/goods_issue/goods_issue_view.php") ;
}
if(isset($_GET['new']) == "true") {
 include ("modules/goods_issue/goods_issue_new.php") ;
}
if (isset($_GET['view']) == "true") {
  include ("modules/goods_issue/goods_issue_list.php") ;
}
?>
