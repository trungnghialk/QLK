 <?php 
$goodsreceipt_id = $_GET["goodsreceipt_id"];
$SQL = "SELECT goodsreceipt_id FROM goods_receipt WHERE goodsreceipt_id ='$goodsreceipt_id'";
$result = mysql_query($SQL);
if (mysql_fetch_row($result) != NULL){  ?>
<div class="container">
  <div class="table-wrapper" style="width: 900px; margin: 80px auto;">
    <div class="table-title">
      <div class="row">
        <div class="modal-header"> 
          <h4 class="modal-title">Thông tin phiếu nhập kho</h4>
        </div>
      </div>
    </div>
    <?php
    $sql = "SELECT * FROM goods_receipt INNER JOIN warehouse ON goods_receipt.warehouse_id = warehouse.warehouse_id  WHERE goodsreceipt_id = '$goodsreceipt_id' ";
    $result = mysql_query($sql);
    while ( $row = mysql_fetch_array($result)) {  ?>
    <form name="add_name" id="add_name" action="" method="POST">  

      <div class="modal-body">

        <table class="tablec">
          <tr class="tr">
            <td class="tdlabel">Mã phiếu:</td>
            <td class="tdbox"><input class="textbox id" name="goodsreceipt_id" id="goodsreceipt_id" readonly="readonly" value="<?php echo $_GET['goodsreceipt_id']; ?>"></td>
            <td class="tdlabel">Kho nhận:</td>
            <td class="tdbox"><input class="textbox" type="text" readonly="readonly" name="warehouse_name" value="<?php echo $row["warehouse_name"] ?>"></td>
            <td class="tdlabel">Ngày nhận:</td>
            <td class="tdbox"><input class="textbox" type="date" name="goodsreceipt_date" value="<?php echo $row['goodsreceipt_date']; ?>" readonly="readonly" ></td>
          </tr>
          <tr class="tr">
            <td class="tdlabel">Người nhận:</td>
            <td colspan="5" class="tdbox"><input class="textbox_wide" type="text" name="" value="<?php echo $row['goodsreceipt_user']; ?> "></td>
          </tr>
          <tr class="tr">
            <td class="tdlabel">Diễn giải:</td>
            <td colspan="5" class="tdbox"><textarea rows="3" cols="108" class="textarea" style="margin: 1%"></textarea></td>
          </tr>
        </table>
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
          $sql = "SELECT * FROM goods_receipt_contain AS a INNER JOIN materials AS b ON a.materials_id = b.materials_id INNER JOIN materials_category AS c ON b.materials_cat_id = c.materials_cat_id WHERE a.goodsreceipt_id = '$goodsreceipt_id'";
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
          <a href="index.php?id=nhapkho&view=true"><input type="button" class="btn btn-default" data-dismiss="modal" value="Đóng"></a>
        </div>
      </form> 
    </div>
  </div>
  <!-- Edit Modal HTML -->
  <script src="js/custom.js"></script>}
  <?php } ?>