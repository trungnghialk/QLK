<?php 
include ("../../connect.php");
$goodstransfer_id = $_GET["goodstransfer_id"];
if (isset($_GET["goodstransfer_id"])) {
	$SQL = "DELETE FROM goods_transfer WHERE goodstransfer_id = '$goodstransfer_id'";
	mysql_query($SQL);
	$SQL = "DELETE FROM goods_transfer_contain WHERE goodstransfer_id = '$goodstransfer_id'";
	mysql_query($SQL);
	header('Location: ../../index.php?id=chuyenkho&view=true');
}
?>