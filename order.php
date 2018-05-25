<?php
if(isset($_GET['view_order']) == "true") {
 include ("modules/order/order_view.php") ;
}
if(isset($_GET['new']) == "true") {
 include ("modules/order/order_new.php") ;
}
if (isset($_GET['edit']) == "true") {
  include ("modules/order/order_edit.php");
}
if (isset($_GET['approve']) == "true") {
  include ("modules/order/order_approve.php");
}
if (isset($_GET['goods_receipt']) == "true") {
  include ("modules/goods_receipt/goods_receipt_new.php");
}
if (isset($_GET['view']) == "true") {
  include ("modules/order/order_list.php") ;
}
?>