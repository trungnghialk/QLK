<?php 
  include ("connect.php");
  $materials_cat_name = $_GET["materials_cat_name"];
  $sql = "select * from materials inner join materials_category on materials.materials_cat_id = materials_category.materials_cat_id where materials_category.materials_cat_name = '$materials_cat_name'";
  $result = mysql_query($sql); ?>
  <option value="">Vui lòng chọn</option>
<?php while ($row = mysql_fetch_array($result)) { ?>
<option name="materials_get_id" id="materials_get_id" value="<?php echo $row["materials_name"]; ?>"><?php echo $row["materials_name"]; ?></option>
<?php }?>
