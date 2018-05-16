<?php 
  include ("connect.php");
  $materials_cat_name = $_GET["materials_cat_name"];
  $warehouse_id = $_GET["warehouse_id"];
  $sql = "select * from materials AS a inner join materials_category AS b on a.materials_cat_id = b.materials_cat_id INNER JOIN warehouse_contain AS c on a.materials_id = c.materials_id where b.materials_cat_name = '$materials_cat_name' AND c.warehouse_id = '$warehouse_id'";
  $result = mysql_query($sql); ?>
  <option value="">Vui lòng chọn</option>
<?php while ($row = mysql_fetch_array($result)) { ?>
<option name="materials_get_id" id="materials_get_id" value="<?php echo $row["materials_name"]; ?>"><?php echo $row["materials_name"]; ?></option>
<?php }?>
