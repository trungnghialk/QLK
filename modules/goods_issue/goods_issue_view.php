 <?php 
 $goodsissue_id = $_GET["goodsissue_id"];
 $SQL = "SELECT goodsissue_id FROM goods_issue WHERE goodsissue_id ='$goodsissue_id'";
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
    $sql = "SELECT * FROM goods_issue INNER JOIN warehouse ON goods_issue.warehouse_id = warehouse.warehouse_id  WHERE goodsissue_id = '$goodsissue_id' ";
    $result = mysql_query($sql);
    while ( $row = mysql_fetch_array($result)) {  ?>
    <form name="add_name" id="add_name" action="" method="POST">  

      <div class="modal-body">
        <div class="lbcode">Mã phiếu: <input style="text-align: center;" name="goodsissue_id" id="goodsissue_id" readonly="readonly" value="<?php echo $_GET['goodsissue_id']; ?>"></div>
        <div class="lfield">
          Kho nhận hàng: 
          <input type="text" readonly="readonly" name="warehouse_name" style="width: 120px;" value="<?php echo $row["warehouse_name"] ?>">
        </div>
        <div class="lfield">Ngày nhận dự kiến: <input class="txtbox" style="width: 100px;" type="text" name="goodsissue_date" value="<?php echo date('d-m-Y',time($row['goodsissue_date'])); ?>" readonly="readonly" ></div>
        <div class="clear"></div>
        <div>
          Nhà cung cấp: 
          <input type="text" readonly="readonly" name="supplier_name" style="width: 690px;" value="">
        </div>
        <div style="padding-top: 10px">
          Người nhận: 
          <input class="txtbox" type="text" readonly="readonly" name="goodsissue_user" style="width: 120px; margin-left: 10px" value="<?php echo $row["goodsissue_user"] ?>">
        </div>
        <div class="clear" style="height: 30px"></div>
      </div>
      <?php } ?>
      <table class="table table-striped table-hover">
        <thead>
         <tr>
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
        $sql = "SELECT * FROM goods_issue_contain AS a INNER JOIN materials AS b ON a.materials_id = b.materials_id INNER JOIN materials_category AS c ON b.materials_cat_id = c.materials_cat_id WHERE a.goodsissue_id = '$goodsissue_id'";
        $result = mysql_query($sql);
        while ($row = mysql_fetch_array($result)) {
          ?>
          <tr>
            <td><?php echo $row["materials_id"] ?></td>
            <td><?php echo $row["materials_name"] ?></td>
            <td><?php echo $row["materialscount"] ?></td>
            <td><?php echo $row["materials_unit"] ?></td>
            <td><?php echo $row["materials_cat_name"] ?></td>
          </tr>
          <?php } ?>

        </tbody>
      </table>
      <div class="modal-footer">
        <input style="float: left;" type="submit" name="print" id="checkout" class="btn btn-danger" value="In phiếu" />  
        <a href="index.php?id=xuatkho&view=true"><input type="button" class="btn btn-default" data-dismiss="modal" value="Đóng"></a>
      </div>
    </form> 
  </div>
</div>
<!-- Edit Modal HTML -->
<script src="js/custom.js"></script>}
<?php } ?>