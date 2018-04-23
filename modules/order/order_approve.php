 <?php 
 $order_id = $_GET["order_id"];
 $SQL = "SELECT order_id FROM orders WHERE order_id ='$order_id'";
 $result = mysql_query($SQL);
 if (mysql_fetch_row($result) != NULL){  ?>
 <div class="container">
  <div class="table-wrapper" style="width: 900px; margin: 80px auto;">
    <div class="table-title">
      <div class="row">
        <div class="modal-header"> 
          <h4 class="modal-title">Chỉnh sửa phiếu đặt hàng</h4>
        </div>
      </div>
    </div>
    <?php 
    if(isset($_GET["order_id"])){
      $order_id = $_GET["order_id"];
      $edit = 1;
      $sql = "SELECT * FROM orders_contain as a INNER JOIN materials as b ON a.materials_id = b.materials_id INNER JOIN materials_category as c on b.materials_cat_id = c.materials_cat_id WHERE a.order_id = '$order_id'";
      $result = mysql_query($sql);
      while ($row = mysql_fetch_array($result)) {
        $_SESSION["materials_id".$edit] = $row["materials_id"];
        $_SESSION['materials_name'.$edit] = $row['materials_name'];
        $_SESSION['materials_cat_name'.$edit] = $row['materials_cat_name'];
        $_SESSION['materials_unit'.$edit] = $row['materials_unit'];
        $_SESSION['materialscount_in'.$edit] = $row['materialscount_in'];
        $edit++;
        $_SESSION["item"] = $edit;
      }
    }
    $item = $_SESSION["item"];
    ?>
    <form name="add_name" id="add_name" action="" method="POST">  

      <div class="modal-body">
        <div class="lbcode">Mã phiếu: <input style="text-align: center;" name="order_id" id="order_id" readonly="readonly" value="<?php echo $_GET['order_id']; ?>"></div>
        <div class="lfield">
          Kho nhận hàng: 
          <input type="text" readonly="" name="" style="width: 120px;">
        </div>
        <div class="lfield">Ngày nhận dự kiến: <input class="txtbox" style="width: 100px;" type="text" name="order_accept_date" value="" ></div>
        <div class="clear"></div>
        <div>
          Nhà cung cấp: 
          <input type="text" readonly="" name="" style="width: 690px;">
        </div>
        <div class="clear" style="height: 30px"></div>
      </div>
      <table class="table table-striped table-hover">
        <thead>
         <tr>
          <th></th>
          <th>Mã vật tư</th>
          <th>Tên vật tư</th>
          <th>Số lượng</th>
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
            <td style="width: 300px"><?php echo $_SESSION["materials_name".$i] ?></td>
            <td><?php echo $_SESSION["materialscount_in".$i] ?></td>
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

    <input style="float: left;" type="submit" name="checkout" id="checkout" class="btn btn-danger" value="Hủy phiếu" />  
    <input type="submit" name="checkout" id="checkout" class="btn btn-success" value="Cập nhật" />  
    <a href="index.php?id=dathang&view=TRUE"><input type="button" class="btn btn-default" data-dismiss="modal" value="Hủy"></a>
  </div>
</form> 
</div>
</div>
<!-- Edit Modal HTML -->
<script src="js/custom.js"></script>}
<?php } ?>