<?php $goodstransfer_id = $_GET["goodstransfer_id"] ?>
<div class="container">
  <div class="table-wrapper" style="width: 900px; margin: 80px auto;">
    <div class="table-title">
      <div class="row">
        <div class="modal-header"> 
          <h4 class="modal-title">Chỉnh sửa phiếu chuyển kho</h4>
        </div>
      </div>
    </div>
    <?php 
    if (!isset($_SESSION["item"])) {
      $_SESSION["item"] = 1;
    }
    if ($_SESSION["clear"] != $_GET["goodstransfer_id"] || $_SESSION["tam"] != "transfer_edit")  {
     $_SESSION["tam"] = $_SESSION["item"];
     include("clear.php");
     $_SESSION["clear"] = $_GET["goodstransfer_id"];
     $_SESSION["tam"] = "transfer_edit";
     $_SESSION["item"] = 1;
     $_SESSION["edit"] = 1;
   }
   $goodstransfer_id = $_GET["goodstransfer_id"];      
   $edit = 1;
   $sql = "SELECT * FROM goods_transfer_contain as a INNER JOIN materials as b ON a.materials_id = b.materials_id INNER JOIN materials_category as c on b.materials_cat_id = c.materials_cat_id WHERE goodstransfer_id = '$goodstransfer_id'";
   $result = mysql_query($sql);
   while ($row = mysql_fetch_array($result)) {
    $_SESSION["materials_id".$edit] = $row["materials_id"];
    $_SESSION['materials_name'.$edit] = $row['materials_name'];
    $_SESSION['materials_cat_name'.$edit] = $row['materials_cat_name'];
    $_SESSION['materials_unit'.$edit] = $row['materials_unit'];
    $_SESSION['materialscount'.$edit] = $row['materialscount'];
    $edit++;  
  }
  $_SESSION["item"] = $edit;
  $_SESSION["edit"] = $edit;
  $item = $_SESSION["item"]; 
  $duplicate =0;
  if (isset($_POST["materials_id"])) {
    for ($i=1; $i < $item ; $i++) { 
      if ($_POST["materials_id"] == $_SESSION["materials_id".$i]) {
        $duplicate =1;
        break; 
      }
    }
  } 
  if(isset($_POST['addtocart'])){   
    if ($duplicate == 0) {
      $_SESSION["materials_name".$item] = $_POST["materials_name"];
      $_SESSION["materials_cat_name".$item] = $_POST["materials_cat_name"];
      $_SESSION["materialscount".$item] = $_POST["materialscount"];
      if($_POST["materialscount"] > $_POST["materials_total"]){
        $_SESSION["materialscount".$item] = $_POST["materials_total"];}
        $_SESSION["materials_id".$item] = $_POST["materials_id"];
        $_SESSION["materials_unit".$item] = $_POST["materials_unit"];
        $_SESSION["materials_total".$item] = $_POST["materials_total"];
        $item++ ;
        $_SESSION["item"] = $item;
      }
      if ($duplicate == 1) { 
        for ($i=1; $i < $item ; $i++) { 
          if ($_POST["materials_id"] == $_SESSION["materials_id".$i]) {
            $_SESSION["materialscount".$i] += $_POST["materialscount"];
            if($_SESSION["materialscount".$i] > $_POST["materials_total"]){
              $_SESSION["materialscount".$i] = $_POST["materials_total"];}
            }
          }
        }
      }

      ?>

      <form name="add_name" id="add_name" action="" method="POST">  
        <?php 
        $sql = "SELECT goodstransfer_id, warehouse_id_send, b.warehouse_name as warehouse_name_out, c.warehouse_name as warehouse_name_in, goodstransfer_send_date, goodstransfer_receive_date, goodstransfer_status FROM goods_transfer as a INNER JOIN warehouse as b ON a.warehouse_id_send = b.warehouse_id INNER JOIN warehouse as c ON a.warehouse_id_receive = c.warehouse_id WHERE goodstransfer_id = '$goodstransfer_id'";
        $result  = mysql_query($sql);
        while ($row = mysql_fetch_array($result)){ 
          $_SESSION["warehouse_id_out"] = $row["warehouse_id_send"];
          ?>

          <div class="modal-body">
            <table class="tablec">
              <tr class="tr">
                <td class="tdlabel">Mã phiếu:</td>
                <td class="tdbox"><input class="textbox id" name="goodstransfer_id" id="order_id" readonly="readonly" value="<?php echo $row['goodstransfer_id']; ?>"></td>
                <td class="tdlabel">Kho xuất:</td>
                <td class="tdbox"><input type="hidden" name="warehouse_id" id="warehouse_id" value="<?php echo $row['warehouse_id_send'] ?>">
                  <input class="textbox" name="warehouse_name_out" id="warehouse_name_out" readonly="readonly" value="<?php echo $row['warehouse_name_out'] ?>"></td>
                  <td class="tdlabel">Ngày xuất:</td>
                  <td class="tdbox"><input required="" class="textbox" type="date" name="goodstransfer_send_date" value="<?php echo $row["goodstransfer_send_date"] ?>" readonly="readonly"></td>
                </tr>
                <tr class="tr">
                  <td class="tdlabel"></td>
                  <td class="tdbox"></td>
                  <td class="tdlabel">Kho nhận:</td>
                  <td class="tdbox"><input class="textbox" id="warehouse_in" name="warehouse_id_in" readonly="readonly" value="<?php echo $row["warehouse_name_in"] ?>"></td>
                  <td class="tdlabel">Ngày nhận:</td>
                  <td class="tdbox"><input class="textbox" required="" type="date" name="goodstransfer_receive_date" value="<?php echo $row["goodstransfer_receive_date"] ?>" readonly="readonly"></td>
                </tr>
                <tr class="tr">
                  <td class="tdlabel">Diễn giải:</td>
                  <td colspan="5" class="tdbox"><textarea rows="3" cols="108" class="textarea" style="margin: 1%"></textarea></td>
                </tr>
              </table>
              <?php 
            }
            for ($i=1; $i < $_SESSION['edit'] ; $i++) { 
              $materials_id = $_SESSION["materials_id".$i];
              $warehouse_id_out = $_SESSION["warehouse_id_out"];
              $sql1 = "SELECT * FROM warehouse_contain WHERE materials_id = '$materials_id' AND warehouse_id = '$warehouse_id_out'";
              $result = mysql_query($sql1);
              while ($row = mysql_fetch_array($result)) {
                $_SESSION['materials_total'.$i] = $row['warehouse_contain_total'];
              }
            }

            ?>
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th style="text-align: center">Nhóm vật tư<br>
                    <select style="width: 150px;" class="txtbox" id="materials_cat_name" name="materials_cat_name" onchange="select_issue_material()">
                      <?php
                      if (isset($_SESSION["warehouse_id_out"])) {
                        $warehouse_id_out = $_SESSION["warehouse_id_out"];
                        $_SESSION["warehouse_id_out"] = $warehouse_id_out;
                        $sql = "select DISTINCT materials_cat_name from materials_category as a INNER JOIN materials AS b on a.materials_cat_id = b.materials_cat_id INNER JOIN warehouse_contain as c on b.materials_id = c.materials_id where warehouse_id = '$warehouse_id_out' ";
                        $result = mysql_query($sql); ?>
                        <option value="">Vui lòng chọn</option>
                        <?php 
                        while ($row = mysql_fetch_array($result)) {
                          ?>
                          <option value="<?php echo $row['materials_cat_name']; ?>"><?php echo $row['materials_cat_name'];?></option>
                          <?php 
                        }
                      } 
                      else {
                        ?>
                        <option value="">Vui lòng chọn</option>
                        <?php } ?>
                      </select>
                      <th style="text-align: center">Tên vật tư<br>
                        <select class="txtbox" style="width: 200px;" id="materials_name" name="materials_name" onchange="select_issue_materialID()"><option value="">Vui lòng chọn</option></select></th>
                        <th style="text-align: center;">Số lượng<br><input min="0" max="" class="txtbox" style="width: 70px" type="number" name="materialscount"></th>
                        <th style="text-align: center">Tồn kho<br><div id="warehouse_contain_total" name=""><input style="width: 70px" class="txtbox" type="text" name="materials_total"></div></th>
                        <th style="text-align: center">Mã vật tư<br><div id="get_materials_id" name="get_materials_id"><input style="width: 100px" class="txtbox" type="text" name="materials_id"></div></th>
                        <th style="text-align: center">ĐVT<br><div id="get_materials_unit" name="get_materials_unit"><input type="text" style="width: 70px;" class="txtbox" name="materials_unit"></div></th>
                        <th><input type="submit" name="addtocart" id="addtocart" class="btn btn-success" value="Thêm" /></th>
                      </tr>
                    </thead>
                  </table>
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>Mã vật tư</th>
                        <th>Tên vật tư</th>
                        <th>Số lượng</th>
                        <th>Đơn vị tính</th>
                        <th>Nhóm vật tư</th>
                        <th>Tồn kho</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if($item>1){
                        for ($i=1; $i < $item; $i++) { 
                         ?>
                         <tr>
                           <td><?php echo $_SESSION["materials_id".$i] ?></td>
                           <td><?php echo $_SESSION["materials_name".$i] ?></td>
                           <td><?php echo $_SESSION["materialscount".$i] ?></td>
                           <td><input style=" width: 50px" class="txtbox" type="number" min="0" name="<?php echo ('materialscount'.$i); ?>" value='<?php echo $_SESSION["materialscount".$i] ?>'></td>
                           <td><?php echo $_SESSION["materials_unit".$i] ?></td>
                           <td><?php echo $_SESSION["materials_cat_name".$i] ?></td>
                           <td><?php echo $_SESSION["materials_total".$i] ?></td>
                         </tr> 
                         <?php 

                       } } ?>
                     </tbody>
                   </table>         
                   <div class="modal-footer">
                     <input type="submit" name="checkout" id="checkout" class="btn btn-success" value="Đặt hàng" />  
                     <a href="index.php?id=chuyenkho&view=true"><input type="button" class="btn btn-default" data-dismiss="modal" value="Hủy"></a>
                   </div>
                 </form>
                 <?php
                 if(isset($_POST["checkout"])){
                  for ($i=1; $i < $_SESSION["edit"] ; $i++) { 
                    $materials_id = $_SESSION["materials_id".$i];
                    $materialscount = $_POST['materialscount'.$i];
                    $SQL = "DELETE FROM goods_transfer_contain WHERE goodstransfer_id = '$goodstransfer_id' AND materials_id = '$materials_id'" ;
                    $result = mysql_query($SQL);
                  }         
                  for ($i=1; $i < $item ; $i++) { 
                    $materials_id = $_SESSION["materials_id".$i];
                    $materialscount = $_POST["materialscount".$i];
                    if ($materialscount > 0) {
                      $SQL = "INSERT INTO goods_transfer_contain(goodstransfer_id, materials_id, materialscount) VALUES ('$goodstransfer_id', '$materials_id', '$materialscount')";
                      $result = mysql_query($SQL);
                      $_SESSION["materialscount".$i] = $materialscount;
                    }
                  }
                  echo "<meta http-equiv='refresh' content='0'>";
                }

                ?>
              </div>
            </div>
            <!-- Edit Modal HTML -->
            <script src="js/custom.js"></script>}
