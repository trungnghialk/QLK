<div class="container">
  <div class="table-wrapper" style="width: 900px; margin: 80px auto;">
    <div class="table-title">
      <div class="row">
        <div class="modal-header"> 
          <h4 class="modal-title">Thẻ kho</h4>
        </div>
      </div>
    </div>
    <form name="add_name" id="add_name" action="" method="POST">  
      <div class="modal-body">
        <table class="tablec">
          <tr class="tr">
            <td class="tdlabel">Kho hàng:</td>
            <td class="tdbox">
              <select class="textbox" name="warehouse_id" id="warehouse_id" required="" onchange="select_material_cat()">
                <option value="">Vui lòng chọn</option>
                <?php
                $sql = "select * from warehouse";
                $result = mysql_query($sql);
                while ($row = mysql_fetch_array($result)) {
                  ?>
                  <option value="<?php echo $row['warehouse_id']; ?>"><?php echo $row['warehouse_name']; ?></option>
                  <?php } ?>
                </select></td>
                <td class="tdlabel">Từ ngày:</td>
                <td class="tdbox"><input required="" type="date" class="textbox" name="report_from_date"></td>
                <td class="tdlabel">Đến ngày:</td>
                <td class="tdbox"><input required="" class="textbox" type="date" min="2018-01-01" max="2020-12-31" name="report_to_date"></td>
              </tr>
              <tr class="tr">
                <td class="tdlabel">Nhóm hàng:</td>
                <td class="tdbox">
                  <select class="textbox" id="materials_cat_name" name="materials_cat_name" onchange="select_issue_material()">
                    <option value="">Vui lòng chọn</option>
                  </select></td>
                  <td class="tdlabel">Hàng hóa:</td>
                  <td class="tdbox"><select class="textbox" id="materials_name" name="materials_name" onchange="select_issue_materialID()"><option value="">Vui lòng chọn</option></select></td>
                  <td class="tdlabel">Mã hàng:</td>
                  <td class="tdbox"><div readonly="readonly" id="get_materials_id" name="get_materials_id"><input readonly="readonly" class="textbox" type="text" name="materials_id"></div></td>
                  <div id="get_materials_unit" name="get_materials_unit" style="display: none"><input type="text" name="materials_unit"></div>
                </tr>
              </table>
              <a style="float: right; margin: 0px 10px" href="index.php?id=baocao&view=true"><input type="button" class="btn btn-default" data-dismiss="modal" value="Quay lại"></a>
              <input style="float: right; margin-bottom: 20px;" type="submit" name="search_cart" id="addtocart" class="btn btn-success" value="Xem báo cáo" />
              <div class="clear" style="margin-top: 20px;"></div>
              <table style="width: 900px border: 1px solid;">
                <tr style="font-weight:bold; text-align: center">
                  <td rowspan="3" style=" width: 5%; border: 1px solid grey">STT</td>
                  <td rowspan="3" style=" width: 10%; border: 1px solid grey">Ngày tháng cập nhật</td>
                  <td colspan="2" style=" width: 10%; border: 1px solid grey">Số hiệu chứng từ</td>
                  <td rowspan="3" style=" width: 25%; border: 1px solid grey">Diễn giải</td>
                  <td colspan="5" style=" width: 40%; border: 1px solid grey">Nhập vào/Xuất ra khỏi kho</td>
                  <td rowspan="3" style=" width: 10%; border: 1px solid grey">Ghi chú</td>
                </tr>
                <tr style="font-weight:bold; text-align: center">
                  <td rowspan="2" style="border: 1px solid grey">Nhập</td>
                  <td rowspan="2" style="border: 1px solid grey">Xuất</td>
                  <td colspan="2" style="border: 1px solid grey">Nhập</td>
                  <td colspan="2" style="border: 1px solid grey">xuất</td>
                  <td rowspan="2" style="border: 1px solid grey">Tồn thực tế</td>
                </tr>
                <tr style="font-weight:bold; text-align: center">
                  <td style="border: 1px solid grey">Số lượng</td>
                  <td style="border: 1px solid grey">Cộng dồn</td>
                  <td style="border: 1px solid grey">Số lượng</td>
                  <td style="border: 1px solid grey">Cộng dồn</td>
                </tr>
                <?php 
                if (!isset($_POST["warehouse_id"])) {
                  unset($_SESSION["warehouse_id"]);
                  unset($_SESSION["report_from_date"]);
                  unset($_SESSION["report_to_date"]);
                  unset($_SESSION["materials_cat_name"]);
                  unset($_SESSION["materials_id"]);
                }
                if (isset($_POST["search_cart"])) {
                  $receive_total = 0;
                  $send_total = 0;
                  $_SESSION["warehouse_id"] = $_POST["warehouse_id"];
                  $_SESSION["report_from_date"] = $_POST["report_from_date"];
                  $_SESSION["report_to_date"] = $_POST["report_to_date"];
                  $_SESSION["materials_cat_name"] = $_POST["materials_cat_name"];
                  $_SESSION["materials_id"] = $_POST["materials_id"];

                  $warehouse_id = $_POST["warehouse_id"];
                  $report_from_date = $_POST["report_from_date"];
                  $report_to_date = $_POST["report_to_date"];
                  $materials_cat_name = $_POST["materials_cat_name"];
                  $materials_id = $_POST["materials_id"];
                  $sql = "(SELECT warehouse_id, goods_issue_contain.goodsissue_id as goods_id, materials_id, materialscount, goodsissue_date AS goods_date FROM goods_issue_contain INNER JOIN goods_issue ON goods_issue_contain.goodsissue_id = goods_issue.goodsissue_id WHERE warehouse_id = '$warehouse_id' AND materials_id ='$materials_id' AND goodsissue_date >= '$report_from_date' AND goodsissue_date <= '$report_to_date') UNION (SELECT warehouse_id, goods_receipt_contain.goodsreceipt_id AS goods_id,materials_id, materialscount, goodsreceipt_date AS goods_date FROM goods_receipt_contain INNER JOIN goods_receipt ON goods_receipt_contain.goodsreceipt_id = goods_receipt.goodsreceipt_id WHERE warehouse_id = '$warehouse_id' AND materials_id ='$materials_id' AND goodsreceipt_date >= '$report_from_date' AND goodsreceipt_date <= '$report_to_date') ORDER BY goods_date";
                  $result = mysql_query($sql);
                  $sort = 1;
                  while ($row = mysql_fetch_array($result)) {
                    ?>
                    <tr style="font-weight:bold; text-align: center">
                      <td style="border: 1px solid grey"><?php echo $sort ?></td>
                      <td style="border: 1px solid grey"><?php echo date('d/m/Y',strtotime($row["goods_date"])) ?></td>
                      <td style="border: 1px solid grey"><?php if(strpos($row["goods_id"], "PNK") == TRUE ){echo "x";} ?></td>
                      <td style="border: 1px solid grey"><?php if(strpos($row["goods_id"], "PXK") == TRUE ){echo "x";} ?></td>
                      <td style="border: 1px solid grey"></td>
                      <td style="border: 1px solid grey"><?php 
                      if(strpos($row["goods_id"], "PNK") == TRUE ){
                        echo $row["materialscount"];
                        $receive_total += $row["materialscount"];
                      } 
                      ?></td>
                      <td style="border: 1px solid grey"><?php if(strpos($row["goods_id"], "PNK") == TRUE ){echo $receive_total; } ?></td>
                      <td style="border: 1px solid grey"><?php 
                      if(strpos($row["goods_id"], "PXK") == TRUE ){
                        echo $row["materialscount"];
                        $send_total += $row["materialscount"];
                      } 
                      ?></td>
                      <td style="border: 1px solid grey"><?php if(strpos($row["goods_id"], "PXK") == TRUE ){echo $send_total;} ?></td>
                      <td style="border: 1px solid grey"></td>
                      <td style="border: 1px solid grey">.</td>
                    </tr>
                    <?php 
                    $sort++;
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
