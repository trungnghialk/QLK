<?php 
include ("../../connect.php");
$materials_name = $_GET["materials_name"];
$warehouse_id = $_GET["warehouse_id"];
$sql = "select * from materials AS a inner join warehouse_contain AS b on a.materials_id = b.materials_id where a.materials_name = '$materials_name' AND b.warehouse_id = '$warehouse_id'";
$result = mysql_query($sql);
while ($row = mysql_fetch_array($result)) {
	echo ('<input style="width: 100px" class="txtbox" type="text" name="materials_total" value="'.$row["warehouse_contain_total"].'">');}
	?>
