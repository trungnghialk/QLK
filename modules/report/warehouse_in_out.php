<div class="container">
  <div class="table-wrapper" style="width: 900px; margin: 80px auto;">
    <div class="table-title">
      <div class="row">
        <div class="modal-header"> 
          <h4 class="modal-title">Báo cáo Nhập - Xuất - Tồn</h4>
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
                </select></td>
                <td class="tdlabel">Từ ngày:</td>
                <td class="tdbox"><input required="" type="date" class="textbox" name="report_from_date"></td>
                <td class="tdlabel">Đến ngày:</td>
                <td class="tdbox"><input required="" class="textbox" type="date" min="2018-01-01" max="2020-12-31" name="report_to_date"></td>
              </table>
              <a style="float: right; margin: 0px 10px" href="index.php?id=baocao&view=true"><input type="button" class="btn btn-default" data-dismiss="modal" value="Quay lại"></a>
              <input style="float: right; margin-bottom: 20px;" type="submit" name="search_cart" id="addtocart" class="btn btn-success" value="Xem báo cáo" />
              <div class="clear" style="margin-top: 20px;"></div>
              <table style="width: 900px border: 1px solid;">
                <tr style="font-weight:bold; text-align: center">
                  <td rowspan="2" style=" width: 5%; border: 1px solid grey">STT</td>
                  <td rowspan="2" style=" width: 25%; border: 1px solid grey">Tên vật tư, hàng hóa xuất ra</td>
                  <td rowspan="2" style=" width: 10%; border: 1px solid grey">Phân loại</td>
                  <td rowspan="2" style=" width: 5%; border: 1px solid grey">ĐVT</td>
                  <td rowspan="2" style=" width: 10%; border: 1px solid grey">Tồn đầu kỳ</td>
                  <td rowspan="2" style=" width: 10%; border: 1px solid grey">Nhập trong kỳ</td>
                  <td rowspan="2" style=" width: 10%; border: 1px solid grey">Xuất trong kỳ</td>
                  <td colspan="2" style=" width: 15%; border: 1px solid grey">Tồn cuối kỳ</td>
                  <td rowspan="2" style=" width: 10%; border: 1px solid grey">Chênh lệch</td>
                </tr>
                <tr style="font-weight:bold; text-align: center">
                  <td style="width: 9%; border: 1px solid grey">Theo sổ sách</td>
                  <td style="width: 6%; border: 1px solid grey">Theo thực tế</td>
                </tr>
                <?php 
                if (!isset($_POST["warehouse_id"])) {
                  unset($_SESSION["warehouse_id"]);
                  unset($_SESSION["report_from_date"]);
                  unset($_SESSION["report_to_date"]);
                  unset($_SESSION["materials_cat_name"]);
                  unset($_SESSION["materials_id"]);
                }
                if (isset($_POST["search_cart"]) && isset($_POST["warehouse_id"])) {
                  $receive_total = 0;
                  $send_total = 0;
                  $_SESSION["warehouse_id"] = $_POST["warehouse_id"];
                  $_SESSION["report_from_date"] = $_POST["report_from_date"];
                  $_SESSION["report_to_date"] = $_POST["report_to_date"];

                  $warehouse_id = $_POST["warehouse_id"];
                  $report_from_date = $_POST["report_from_date"];
                  $report_to_date = $_POST["report_to_date"]; 
                  $sql = "(SELECT warehouse_id, goods_issue_contain.goodsissue_id as goods_id, materials_id, materialscount, goodsissue_date AS goods_date FROM goods_issue_contain INNER JOIN goods_issue ON goods_issue_contain.goodsissue_id = goods_issue.goodsissue_id WHERE warehouse_id = '$warehouse_id' AND goodsissue_date < '$report_from_date') UNION (SELECT warehouse_id, goods_receipt_contain.goodsreceipt_id AS goods_id,materials_id, materialscount, goodsreceipt_date AS goods_date FROM goods_receipt_contain INNER JOIN goods_receipt ON goods_receipt_contain.goodsreceipt_id = goods_receipt.goodsreceipt_id WHERE warehouse_id = '$warehouse_id' AND goodsreceipt_date < '$report_from_date') ORDER BY goods_date";
                  $result = mysql_query($sql);              
                  $item = 1;
                  while ($row = mysql_fetch_array($result)) {
                    $duplicate = 0;
                    for ($i=1; $i < $item ; $i++) { 
                      if ($_SESSION["materials_id".$i] == $row["materials_id"]) {
                        $duplicate = 1;
                        break;
                      }
                    }
                    if($duplicate == 1){
                      if(strpos($row["goods_id"], "PXK") == TRUE ){
                        $_SESSION["opening_stock".$i] += $row["materialscount"];
                      }  
                      if(strpos($row["goods_id"], "PNK") == TRUE ){
                        $_SESSION["opening_stock".$i] += $row["materialscount"];
                      }
                    }
                    if($duplicate == 0){
                      $_SESSION["opening_stock".$item] = 0;
                      $_SESSION["materials_id".$item] = $row["materials_id"];
                      if(strpos($row["goods_id"], "PXK") == TRUE ){
                        $_SESSION["opening_stock".$item] += $row["materialscount"];
                      }
                      if(strpos($row["goods_id"], "PNK") == TRUE ){
                        $_SESSION["opening_stock".$item] += $row["materialscount"];
                      }
                      $item++;
                    }
                  }

                  $sql = "(SELECT warehouse_id, goods_issue_contain.goodsissue_id as goods_id, materials_id, materialscount, goodsissue_date AS goods_date FROM goods_issue_contain INNER JOIN goods_issue ON goods_issue_contain.goodsissue_id = goods_issue.goodsissue_id WHERE warehouse_id = '$warehouse_id' AND goodsissue_date >= '$report_from_date' AND goodsissue_date <= '$report_to_date') UNION (SELECT warehouse_id, goods_receipt_contain.goodsreceipt_id AS goods_id,materials_id, materialscount, goodsreceipt_date AS goods_date FROM goods_receipt_contain INNER JOIN goods_receipt ON goods_receipt_contain.goodsreceipt_id = goods_receipt.goodsreceipt_id WHERE warehouse_id = '$warehouse_id' AND goodsreceipt_date >= '$report_from_date' AND goodsreceipt_date <= '$report_to_date') ORDER BY goods_date";
                  $result = mysql_query($sql);
                  $sort = 1;
                  $item = 1;
                  $_SESSION["materialscount_out1"] = 0;
                  $_SESSION["materialscount_in1"] = 0;
                  while ($row = mysql_fetch_array($result)) {
                    $duplicate = 0;
                    for ($i=1; $i < $item ; $i++) { 
                      if ($_SESSION["materials_id".$i] == $row["materials_id"]) {
                        $duplicate = 1;
                        break;
                      }
                    }
                    if($duplicate == 1){
                      if(strpos($row["goods_id"], "PXK") == TRUE ){
                        $_SESSION["materialscount_out".$i] += $row["materialscount"];
                      }  
                      if(strpos($row["goods_id"], "PNK") == TRUE ){
                        $_SESSION["materialscount_in".$i] += $row["materialscount"];
                      }
                    }
                    if($duplicate == 0){
                      $_SESSION["materials_id".$item] = $row["materials_id"];
                      if(strpos($row["goods_id"], "PXK") == TRUE ){
                        $_SESSION["materialscount_out".$item] += $row["materialscount"];
                      }
                      if(strpos($row["goods_id"], "PNK") == TRUE ){
                        $_SESSION["materialscount_in".$item] += $row["materialscount"];
                      }
                      $item++;
                      $_SESSION["materialscount_in".$item] = 0;
                      $_SESSION["materialscount_out".$item] = 0;
                    }
                    $sort++;
                  }
                  for ($i=1; $i < $item ; $i++) { 
                    $materials_id = $_SESSION["materials_id".$i];
                    ?>
                    <tr>
                      <td style="width: 6%; border: 1px solid grey"><?php echo $sort ?></td>
                      <td style="width: 6%; border: 1px solid grey">
                        <?php
                        $sql="SELECT * FROM materials WHERE materials_id = '$materials_id' ";
                        $result = mysql_query($sql);
                        while( $row = mysql_fetch_array($result)){
                          echo $row["materials_name"];
                          $materials_cat_id = $row["materials_cat_id"];
                          $materials_unit = $row["materials_unit"];
                        }
                        ?>                     
                      </td>
                      <td style="width: 6%; border: 1px solid grey">
                        <?php
                        $sql="SELECT * FROM materials_category WHERE materials_cat_id = '$materials_cat_id' ";
                        $result = mysql_query($sql);
                        while( $row = mysql_fetch_array($result)){
                          echo $row["materials_cat_name"];
                        }
                        ?>                     
                      </td>
                      <td style="width: 6%; border: 1px solid grey"><?php echo $materials_unit ?></td>
                      <td style="width: 6%; border: 1px solid grey">
                        <?php 
                        if(isset($_SESSION["opening_stock".$i])){
                          echo $_SESSION["opening_stock".$i];
                        }
                        else {
                          echo "0";
                        }
                        ?>
                      </td>
                      <td style="width: 6%; border: 1px solid grey"><?php echo $_SESSION["materialscount_in".$i] ?></td>
                      <td style="width: 6%; border: 1px solid grey"><?php echo $_SESSION["materialscount_out".$i] ?></td>
                      <td style="width: 6%; border: 1px solid grey">
                        <?php
                        $sql="SELECT * FROM warehouse_contain WHERE materials_id = '$materials_id' AND warehouse_id ='$warehouse_id' ";
                        $result = mysql_query($sql);
                        while( $row = mysql_fetch_array($result)){
                          echo $row["warehouse_contain_total"];
                        }
                        ?>                     
                      </td>
                      <td style="width: 6%; border: 1px solid grey"></td>
                      <td style="width: 6%; border: 1px solid grey">.</td>
                    </tr>  
                    <?php
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
