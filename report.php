<?php
if (isset($_GET['warehouse_card']) == "true") {
  include ("/modules/report/warehouse_card.php");
}
if (isset($_GET['warehouse_in_out']) == "true") {
  include ("/modules/report/warehouse_in_out.php");
}
if (isset($_GET['warehouse_check']) == "true") {
  include ("/modules/report/warehouse_check.php");
}
if (isset($_GET['view']) == "true") {
  include ("/modules/report/report_list.php");
}
if (isset($_GET['warehouse_contain']) == "true") {
  include ("/modules/report/warehouse_contain.php");
}
if (isset($_GET['warehouse_contain1']) == "true") {
  include ("/modules/report/goods_issue_new.php");
}
?>

