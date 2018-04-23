<?php 
include ("../../connect.php");
$order_id = $_GET["order_id"];
if (isset($_GET["order_id"])) {
	$SQL = "DELETE FROM ORDERS WHERE order_id = '$order_id'";
	mysql_query($SQL);
	$SQL = "DELETE FROM ORDERS_CONTAIN WHERE order_id = '$order_id'";
	mysql_query($SQL);
	header('Location: ../../index.php?id=dathang&view=true');
}
if (isset($_GET["clear"])) {
	$i = $_GET["clear"];
	unset($_SESSION["materials_id".$i]);
	unset($_SESSION["materials_name".$i]);
	unset($_SESSION["materialscount_in".$i]);
	unset($_SESSION["materials_unit".$i]);
	unset($_SESSION["materials_cat_name".$i]);
	
}
?>