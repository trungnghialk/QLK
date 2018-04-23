<?php 
  include ("connect.php");
  $material_cat_name = $_GET["materials_cat_name"];
  $sql = "select * from materials inner join materials_category on materials.materials_cat_id = materials_category.materials_cat_id where materials_category.materials_cat_name = '$material_cat_name'";
  $result = mysql_query($sql); ?>
<option value="">Vui lòng chọn</option>
<?php while ($row = mysql_fetch_array($result)) { ?>
<option value="<?php echo $row["materials_id"]; ?>"><?php echo $row["materials_name"]; ?></option>
<?php }?>
