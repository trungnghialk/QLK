 <?php 
 if (!isset($_SESSION["item"])) {
  $_SESSION["item"] = 1;
}
if ($_SESSION["clear"] != "O" || $_SESSION["tam"] != "receive_new")  {
 $_SESSION["tam"] = $_SESSION["item"];
 include("clear.php");
 $_SESSION["clear"] = "O";
 $_SESSION["tam"] = "receive_new";
 $_SESSION["edit"] = 1;
 $_SESSION["item"] = 1;
}
$order_id = $_GET["order_id"];
$SQL = "SELECT order_id FROM orders WHERE order_id ='$order_id'";
$result = mysql_query($SQL);
if (mysql_fetch_row($result) != NULL){  ?>
<div class="container">
  <div class="table-wrapper" style="width: 900px; margin: 80px auto;">
    <div class="table-title">
      <div class="row">
        <div class="modal-header"> 
          <h4 class="modal-title">Tạo phiếu nhập kho</h4>
        </div>
      </div>
    </div>
    <?php 
    if(isset($_GET["order_id"])){
      $edit = 1;
      $sql = "SELECT * FROM orders_contain as a INNER JOIN materials as b ON a.materials_id = b.materials_id INNER JOIN materials_category as c on b.materials_cat_id = c.materials_cat_id WHERE a.order_id = '$order_id'";
      $result = mysql_query($sql);
      while ($row = mysql_fetch_array($result)) {
        $_SESSION["materials_id".$edit] = $row["materials_id"];
        $_SESSION['materials_name'.$edit] = $row['materials_name'];
        $_SESSION['materials_cat_name'.$edit] = $row['materials_cat_name'];
        $_SESSION['materials_unit'.$edit] = $row['materials_unit'];
        $_SESSION['materialscount_in'.$edit] = $row['materialscount_in'];
        $_SESSION['materialscount_out'.$edit] = $row['materialscount_out'];
        $edit++;
        $_SESSION["item"] = $edit;
      }
      $sql =" SELECT * FROM orders as a INNER JOIN supplier as b on a.supplier_id = b.supplier_id INNER JOIN warehouse as c on a.warehouse_id = c.warehouse_id WHERE order_id = '$order_id'";
      $result = mysql_query($sql);
      while ($row = mysql_fetch_array($result)) {
        $supplier_name = $row["supplier_name"];
        $warehouse_name = $row["warehouse_name"];
        $_SESSION["warehouse_id"] = $row["warehouse_id"];
      }
    }
    $item = $_SESSION["item"];
    if(isset($_POST["goodsreceipt_date"])){
      $_SESSION["goodsreceipt_date"] = $_POST["goodsreceipt_date"];
    }
    else {
     $_SESSION["goodsreceipt_date"] = date("Y-m-d",time());
   }
   ?>
   <form name="add_name" id="add_name" action="" method="POST">  
    <?php $result  = mysql_query('select * from count ORDER BY count_receipt DESC');
    while ($row = mysql_fetch_array($result)){
      $a = getdate(); 
      $_SESSION['goodsreceipt_id'] = ($row[2].'-PNK'.$a['year']);
      $_SESSION['count_receipt'] = $row[2];
    } ?>
    <div class="modal-body">

      <table class="tablec">
        <tr class="tr">
          <td class="tdlabel">Mã phiếu:</td>
          <td class="tdbox"><input class="textbox id" name="goodsreceipt_id" id="goodsreceipt_id" readonly="readonly" value="<?php echo $_SESSION['goodsreceipt_id']; ?>"></td>
          <td class="tdlabel">Kho nhận:</td>
          <td class="tdbox"><input class="textbox" type="text" readonly="readonly" name="warehouse_name" value="<?php echo $warehouse_name ?>"></td>
          <td class="tdlabel">Ngày nhận:</td>
          <td class="tdbox"><input class="textbox" type="date" name="goodsreceipt_date" value="<?php echo $_SESSION['goodsreceipt_date']; ?>" ></td>
        </tr>
        <tr class="tr">
          <td class="tdlabel">Nhà cung cấp:</td>
          <td colspan="5" class="tdbox"><input class="textbox_wide" type="text" readonly="readonly" name="supplier_name" value="<?php echo $supplier_name ?>"></td>
        </tr>
        <tr class="tr">
          <td class="tdlabel">Diễn giải:</td>
          <td colspan="5" class="tdbox"><textarea rows="3" cols="108" class="textarea" style="margin: 1%"></textarea></td>
        </tr>
      </table>
      <table class="table table-striped table-hover">
        <thead>
         <tr>
          <th></th>
          <th>Mã vật tư</th>
          <th>Tên vật tư</th>
          <th>SL còn lại</th>
          <th>SL nhập</th>
          <th>Đơn vị tính</th>
          <th>Nhóm vật tư</th>
        </tr>
      </thead>
      <tbody>
        <!-- Xuất các vật tư đã có và đã thêm ra màn hình. Số lượng nằm trong textbox để cập nhật -->
        <?php
        if(isset($_POST["materials_id"]) || isset($_GET["order_id"])){
          for ($i=1; $i < $item; $i++) { 
           ?>
           <tr>
            <td></td>
            <td><?php echo $_SESSION["materials_id".$i] ?></td>
            <td style="min-width: 150px"><?php echo $_SESSION["materials_name".$i] ?></td>
            <td>
              <?php 
              if($_SESSION["materialscount_in".$i] > $_SESSION["materialscount_out".$i]){ 
                echo ($count = $_SESSION["materialscount_in".$i]-$_SESSION["materialscount_out".$i]);}
                else {
                  echo "0";
                }
                ?>
              </td>
              <td><input style="width: 80px" type="text" name="<?php echo ('materialscount_out'.$i) ?>" required = "" value="0"></td>
              <td><?php echo $_SESSION["materials_unit".$i] ?></td>
              <td><?php echo $_SESSION["materials_cat_name".$i] ?></td>
            </tr> 
            <?php 
  // Kết thúc xuaasrt vật tư ra màn hình
          } 
        } ?>
      </tbody>
    </table>
    <div class="modal-footer"> 
      <input type="submit" name="submit" id="checkout" class="btn btn-success" value="Nhập kho" />  
      <a href="index.php?id=dathang&view=TRUE"><input type="button" class="btn btn-default" data-dismiss="modal" value="Đóng"></a>
    </div>
  </form> 
  <?php 
  if (isset($_POST["submit"])) {
    $result  = mysql_query('select * from count ORDER BY count_receipt DESC');
    while ($row = mysql_fetch_array($result)){
      $a = getdate(); 
      $goodsreceipt_id = ($row[2].'-PNK'.$a['year']);
      $count_receipt = $row[2];
    }

    // $goodsreceipt_id = $_SESSION["goodsreceipt_id"];
    $goodsreceipt_note = "Nhập kho";
    $goodsreceipt_date = date("Y-m-d",time($_POST["goodsreceipt_date"]));
    $goodsreceipt_user = $_SESSION["username"];
    $warehouse_id = $_SESSION["warehouse_id"];
    for ($i=1; $i < $item ; $i++) { 
      if ($_POST["materialscount_out".$i] > 0 ){
        $available = "true";
        $materialscount_out = $_POST["materialscount_out".$i] + $_SESSION["materialscount_out".$i];
        $materials_id = $_SESSION["materials_id".$i];
        $warehouse_contain_total = $_POST['materialscount_out'.$i];
        $sql = "UPDATE orders_contain SET materialscount_out = '$materialscount_out' WHERE order_id = '$order_id' and materials_id = '$materials_id'";
        mysql_query($sql);
        $sql = "SELECT * FROM warehouse_contain WHERE materials_id = '$materials_id' AND warehouse_id = '$warehouse_id'";
        $result = mysql_query($sql);
        while ( $row = mysql_fetch_array($result)) {
          $warehouse_contain_total = $_POST["materialscount_out".$i] + $row["warehouse_contain_total"];
          $sql = "UPDATE warehouse_contain SET warehouse_contain_total= '$warehouse_contain_total' WHERE materials_id = '$materials_id' and warehouse_id = $warehouse_id";
          mysql_query($sql);
        }
        if($warehouse_contain_total == $_POST['materialscount_out'.$i]){
          $sql = "INSERT INTO warehouse_contain (warehouse_id, materials_id, warehouse_contain_total) VALUES ('$warehouse_id', '$materials_id', '$warehouse_contain_total') ";
          mysql_query($sql);
        }
      }
    }
    if(isset($available) == "true"){
      $available = "fail";   
      $sql = "INSERT INTO goods_receipt (goodsreceipt_id, goodsreceipt_note, goodsreceipt_date, goodsreceipt_user, warehouse_id, order_id) VALUES ('$goodsreceipt_id','$goodsreceipt_note','$goodsreceipt_date','$goodsreceipt_user','$warehouse_id', '$order_id') ";
      mysql_query($sql);
      // $count_receipt = $_SESSION['count_receipt'];
      $count_receipt++;
      mysql_query("UPDATE count SET count_receipt= '$count_receipt' WHERE id = 1");
    }
    for ($i=1; $i < $item ; $i++) { 
     $materials_id = $_SESSION["materials_id".$i];
     $materialscount_out = $_POST["materialscount_out".$i];
     $sql = "INSERT INTO goods_receipt_contain (goodsreceipt_id, materials_id, materialscount) VALUES ('$goodsreceipt_id', '$materials_id', '$materialscount_out') ";
     $result = mysql_query($sql);
   }
   if ($result) {
    include("success.php");
  }
  else {
   include("failed.php"); 
 }
 echo "<meta http-equiv='refresh' content='2'>";
}
?>
</div>
</div>
<!-- Edit Modal HTML -->
<script src="js/custom.js"></script>}
<?php } ?>







