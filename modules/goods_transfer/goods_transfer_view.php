 <?php 
 $goodstransfer_id = $_GET["goodstransfer_id"];
 $SQL = "SELECT goodstransfer_id FROM goods_transfer WHERE goodstransfer_id ='$goodstransfer_id'";
 $result = mysql_query($SQL);
 if (mysql_fetch_row($result) != NULL){  ?>
 <div class="container">
  <div class="table-wrapper" style="width: 900px; margin: 80px auto;">
    <div class="table-title">
      <div class="row">
        <div class="modal-header"> 
          <h4 class="modal-title">Thông tin phiếu chuyển kho</h4>
        </div>
      </div>
    </div>
    <?php
    $sql = "SELECT goodstransfer_id, b.warehouse_name as warehouse_name_out, c.warehouse_name as warehouse_name_in, goodstransfer_send_date, goodstransfer_receive_date, goodstransfer_status FROM goods_transfer as a INNER JOIN warehouse as b ON a.warehouse_id_send = b.warehouse_id INNER JOIN warehouse as c ON a.warehouse_id_receive = c.warehouse_id WHERE goodstransfer_id = '$goodstransfer_id' ";
    $result = mysql_query($sql);
    while ( $row = mysql_fetch_array($result)) {  ?>
    <form name="add_name" id="add_name" action="" method="POST">  

      <div class="modal-body">
        <div class="lbcode">Mã phiếu: <input style="text-align: center;" name="goodstransfer_id" id="goodstransfer_id" readonly="readonly" value="<?php echo $_GET['goodstransfer_id']; ?>"></div>
        <div class="lfield">
          Kho Xuất hàng: 
          <input type="text" readonly="readonly" name="warehouse_name_out" style="width: 120px;" value="<?php echo $row["warehouse_name_out"] ?>">
        </div>
                <div class="lfield">
          Kho Nhận hàng: 
          <input type="text" readonly="readonly" name="warehouse_name_in" style="width: 120px;" value="<?php echo $row["warehouse_name_in"] ?>">
        </div>
        <div class="clear"></div>
        <div class="lfield" style="padding-left: 275px">Ngày xuất: <input class="txtbox" style="width: 120px;" type="text" name="goodstransfer_send_date" value="<?php echo date('d-m-Y',time($row['goodstransfer_send_date'])); ?>" readonly="readonly" ></div>
        <div class="lfield" style="padding-left: 30px">Ngày nhận: <input class="txtbox" style="width: 120px;" type="text" name="goodstransfer_receive_date" value="<?php echo date('d-m-Y',time($row['goodstransfer_receive_date'])); ?>" readonly="readonly" ></div>
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
        $sql = "SELECT * FROM goods_transfer_contain AS a INNER JOIN materials AS b ON a.materials_id = b.materials_id INNER JOIN materials_category AS c ON b.materials_cat_id = c.materials_cat_id WHERE a.goodstransfer_id = '$goodstransfer_id'";
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
        <a href="index.php?id=chuyenkho&view=true"><input type="button" class="btn btn-default" data-dismiss="modal" value="Đóng"></a>
      </div>
    </form> 
  </div>
</div>
<!-- Edit Modal HTML -->
<script src="js/custom.js"></script>}
<?php } ?>