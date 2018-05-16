<?php 
  include ("connect.php");
  $warehouse_id = $_GET["warehouse_id"];
  $sql = "SELECT * FROM warehouse WHERE warehouse_id != '$warehouse_id'";
  $result = mysql_query($sql); ?>
  <option value="">Vui lòng chọn</option>
  <?php 
  while ($row = mysql_fetch_array($result)) {
    ?>
    <option value="<?php echo $row['warehouse_id']; ?>"><?php echo $row['warehouse_name'];?></option>
    <?php } ?>