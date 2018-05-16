<?php 
	include ("../../connect.php");
	$username = $_SESSION["username"];
	$sql = "SELECT * FROM permission_asign WHERE ussename = $username";
	$result = mysql_query($sql);
	$warehouse_count = 1;
	while ($row = mysql_fetch_array($result)) {
		$_SESSION["permit_warehouse".$warehouse_count] = $row["warehouse_id"];
		$_SESSION["permit_id".$warehouse_count] = $row["permission_id"];
		$warehouse_count++;
		$_SESSION["warehouse_count"] = $warehouse_count;
	}
?>