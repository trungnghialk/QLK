<div class="container">
  <div class="table-wrapper" style="width: 900px; margin: 80px auto;">
    <div class="table-title">
      <div class="row">
        <div class="modal-header"> 
          <h4 class="modal-title">Kiểm kho và cập nhật</h4>
        </div>
      </div>
    </div>
    <form name="add_name" id="add_name" action="" method="POST">  
      <div class="modal-body">
        <table class="tablec">
          <tr class="tr">
            <td class="tdlabel">Kho hàng:</td>
            <td class="tdbox">
              <select class="textbox" name="warehouse_id" id="warehouse_id" required="">
                <option value="">Vui lòng chọn</option>
                <?php
                $sql = "select * from warehouse";
                $result = mysql_query($sql);
                while ($row = mysql_fetch_array($result)) {
                  ?>
                  <option value="<?php echo $row['warehouse_id']; ?>"><?php echo $row['warehouse_name']; ?></option>
                  <?php } ?>
                </select>
              </td>
              <td><a style="float: right; margin: 0px 10px" href="index.php?id=baocao&view=true"><input type="button" class="btn btn-default" data-dismiss="modal" value="Quay lại"></a>
                <input style="float: right; margin-bottom: 20px;" type="submit" name="search_cart" id="addtocart" class="btn btn-success" value="Xem báo cáo" /></td>
              </table>

              <div class="clear" style="margin-top: 20px;"></div>
              <table style="width: 900px border: 1px solid;">
                <tr style="font-weight:bold; text-align: center">
                  <td style=" width: 10%; border: 1px solid grey">STT</td>
                  <td style=" width: 20%; border: 1px solid grey">Tên vật tư, hàng hóa</td>
                  <td style=" width: 10%; border: 1px solid grey">Phân loại</td>
                  <td style=" width: 10%; border: 1px solid grey">ĐVT</td>
                  <td style=" width: 10%; border: 1px solid grey">Mã vật tư</td>
                  <td style=" width: 10%; border: 1px solid grey">Tồn kho</td>
                </tr>
                <?php 
                if (isset($_POST["search_cart"])) {
                  $warehouse_id = $_POST["warehouse_id"];
                  $sql = "SELECT * FROM warehouse_contain WHERE warehouse_id = '$warehouse_id'";
                  $result = mysql_query($sql);
                  $sort = 1;
                  while ($row = mysql_fetch_array($result)) {
                    $materials_id = $row["materials_id"];
                    $sql1 = "SELECT * FROM materials inner join materials_category on materials.materials_cat_id = materials_category.materials_cat_id where materials_id = '$materials_id'";
                    $result1 = mysql_query($sql1);
                    while ($row1 = mysql_fetch_array($result1)) {


                      ?>
                      <tr style="font-weight:bold; text-align: center">
                        <td style=" width: 10%; border: 1px solid grey"><?php echo $sort ?></td>
                        <td style=" width: 20%; border: 1px solid grey; text-align: left; padding-left: 10px; "><?php echo $row1["materials_name"] ?></td>
                        <td style=" width: 10%; border: 1px solid grey; text-align: left; padding-left: 10px; "><?php echo $row1["materials_cat_name"] ?></td>
                        <td style=" width: 10%; border: 1px solid grey"><?php echo $row1["materials_unit"] ?></td>
                        <td style=" width: 10%; border: 1px solid grey"><?php echo $row["materials_id"] ?></td>
                        <td style=" width: 10%; border: 1px solid grey"><?php echo $row["warehouse_contain_total"] ?></td>
                      </tr>
                      <?php
                    }
                    $sort++ ;
                  }
                }
                ?>
              </table>         
              <div class="modal-footer">
              </div>
            </form>
          </div>
        </div>
        <!-- Edit Modal HTML -->
        <script src="js/custom.js"></script>}
