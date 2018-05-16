<?php 
  include ("connect.php");
  $warehouse_id = $_GET["warehouse_id"];
  $_SESSION["warehouse_id"] = $warehouse_id;
  $sql = "select DISTINCT materials_cat_name from materials_category as a INNER JOIN materials AS b on a.materials_cat_id = b.materials_cat_id INNER JOIN warehouse_contain as c on b.materials_id = c.materials_id where warehouse_id = '$warehouse_id' ";
  $result = mysql_query($sql); ?>
  <option value="">Vui lòng chọn</option>
  <?php 
  while ($row = mysql_fetch_array($result)) {
    ?>
    <option value="<?php echo $row['materials_cat_name']; ?>"><?php echo $row['materials_cat_name'];?></option>
    <?php } ?>