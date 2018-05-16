<?php 
  include ("../../connect.php");
  $materials_name = "xi măng";
  $warehouse_id = 1;
  $sql = "select * from materials AS a inner join warehouse_contain AS b on a.materials_id = b.materials_id where a.materials_name = '$materials_name' AND b.warehouse_id = '$warehouse_id'";
  $result = mysql_query($sql);
while ($row = mysql_fetch_array($result)) {
}
?>
