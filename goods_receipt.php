<?php
if (isset($_GET['goods_receipt']) == "true") {
  include ("modules/goods_receipt/goods_receipt_view.php");
}
if (isset($_GET['view']) == "true") {
  include ("modules/goods_receipt/goods_receipt_list.php");
}
?>