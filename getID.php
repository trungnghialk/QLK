<?php 
  include ("connect.php");
  $materials_name = $_GET["materials_name"];
  $sql = "select * from materials where '$materials_name' = materials_name";
  $result = mysql_query($sql); 
  while ($row = mysql_fetch_array($result)) {
	echo ('<input id="materials_id" name="materials_id" readonly="readonly" value = "'.$row["materials_id"].'">');
}?>
