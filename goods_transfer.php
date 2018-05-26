<?php
if (isset($_GET['approve']) == "true") {
  include ("modules/goods_transfer/goods_transfer_approve.php");
}
if (isset($_GET['edit']) == "true") {
  include ("modules/goods_transfer/goods_transfer_edit.php");
}
if (isset($_GET['send']) == "true") {
  include ("modules/goods_transfer/goods_transfer_send.php");
}
if (isset($_GET['receive']) == "true") {
  include ("modules/goods_transfer/goods_transfer_receive.php");
}
if (isset($_GET['goods_transfer']) == "true") {
 include ("modules/goods_transfer/goods_transfer_view.php") ;
}
if(isset($_GET['view_item']) == "true") {
 include ("modules/order/order_view.php") ;
}
if(isset($_GET['new']) == "true") {
 include ("modules/goods_transfer/goods_transfer_new.php") ;
}
if (isset($_GET['view']) == "true") {
  include ("modules/goods_transfer/goods_transfer_list.php") ;
}
?>

