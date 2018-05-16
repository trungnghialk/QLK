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
    <!-- In ra các vật tư đã đặt hàng -->
    <?php 
    if($_GET["order_id"] != $_SESSION["clear_order"]){
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
      }
      $_SESSION["clear_order"] = $_GET["order_id"];
      $_SESSION["edit"] = $edit;
      $_SESSION["item"] = $edit;
    }
    if(!isset($_POST['warehouse_id'])){
      $sql ="SELECT * FROM orders INNER JOIN warehouse on orders.warehouse_id = warehouse.warehouse_id WHERE orders.order_id = '$order_id'";
      $result = mysql_query($sql);
      while ($row = mysql_fetch_array($result)) {
        $_SESSION['warehouse_id'] = $row['warehouse_id'];
      }
    }
    else{
      $_SESSION['warehouse_id'] = $_POST['warehouse_id'];
    }
    if(!isset($_POST['supplier_id'])){
      $sql ="SELECT * FROM orders INNER JOIN supplier on orders.supplier_id = supplier.supplier_id WHERE orders.order_id = '$order_id'";
      $result = mysql_query($sql);
      while ($row = mysql_fetch_array($result)) {
        $_SESSION['supplier_id'] = $row['supplier_id'];
      }
    }
    else{
      $_SESSION['supplier_id'] = $_POST['supplier_id'];
    }
    // Kết thúc in các vật tư đã đặt hàng
    // Xác định vật tư mới thêm vào đã có hay chưa
    $item = $_SESSION["item"];

    if (isset($_POST["materials_id"])) {
      $duplicate =0;
      for ($i=1; $i < $item ; $i++) { 
        if ($_POST["materials_id"] == $_SESSION["materials_id".$i]) {
          $duplicate =1;
          break; 
        }
      }
    }
    // Kết thúc xác định các vật tư mới thêm đã có hay chưa
    // Thêm 1 vật tư vào giỏ hàng
    if (isset($_POST["addtocart"])) {
      if ($duplicate == 0) {
        $_SESSION["materials_name".$item] = $_POST["materials_name"];
        $_SESSION["materials_cat_name".$item] = $_POST["materials_cat_name"];
        $_SESSION["materialscount_in".$item] = $_POST["materialscount_in"];
        $_SESSION["materials_id".$item] = $_POST["materials_id"];
        $_SESSION["materials_unit".$item] = $_POST["materials_unit"];
        $item++ ;
        $_SESSION["item"] = $item;
      }
      if ($duplicate == 1) { 
        for ($i=1; $i < $item ; $i++) { 
          if ($_POST["materials_id"] == $_SESSION["materials_id".$i]) {
            $_SESSION["materialscount_in".$i] += $_POST["materialscount_in"];
          }
        }
      }}
      ?>
      <!-- Kết thúc thêm 1 vật tư vào giỏ hàng -->
      <form name="add_name" id="add_name" action="" method="POST">  

        <div class="modal-body">
          <div class="lbcode">Mã phiếu: <input style="text-align: center;" name="order_id" id="order_id" readonly="readonly" value="<?php echo $_GET['order_id']; ?>"></div>
          <div class="lfield">
            Kho nhận hàng: 
            <select class="txtbox" name="warehouse_id" id="warehouse_id">
              <option value="<?php echo $_SESSION['warehouse_id']; ?>">
                <?php 
                if (isset($_SESSION['warehouse_id'])){
                  $warehouse_id = $_SESSION["warehouse_id"];
                  $sql = "select * from warehouse WHERE warehouse_id = '$warehouse_id'";
                  $result = mysql_query($sql);
                  while ($row = mysql_fetch_array($result)) {
                    echo $row['warehouse_name'] ;
                  }; 
                }
                else {echo "Vui lòng chọn";} 
                ?>
              </option>
              <?php
              $sql = "select * from warehouse";
              $result = mysql_query($sql);
              while ($row = mysql_fetch_array($result)) {
                ?>
                <option value="<?php echo $row['warehouse_id']; ?>"><?php echo $row['warehouse_name']; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="lfield">Ngày nhận dự kiến: <input class="txtbox" style="width: 100px;" type="text" name="order_accept_date" value="<?php $a = getdate(); echo $a['mday'].'/'.$a['mon'].'/'.$a['year'];?>" ></div>
            <div class="clear"></div>
            <div>
              Nhà cung cấp: 
              <select class="txtbox" id="supplier_id" name="supplier_id" style="min-width: 690px;">
                <option value="<?php echo $_SESSION['supplier_id']; ?>">
                  <?php 
                  if (isset($_SESSION['supplier_id'])){
                    $supplier_id = $_SESSION["supplier_id"];
                    $sql = "select * from supplier WHERE supplier_id = '$supplier_id'";
                    $result = mysql_query($sql);
                    while ($row = mysql_fetch_array($result)) {
                      echo $row['supplier_name'] ;
                    }; 
                  }
                  else {echo "Vui lòng chọn";} 
                  ?>
                </option>
                <?php
                $sql = "select * from supplier";
                $result = mysql_query($sql);
                while ($row = mysql_fetch_array($result)) {
                  ?>
                  <option value="<?php echo $row['supplier_id']; ?>"><?php echo $row['supplier_name']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="clear" style="height: 30px"></div>
            </div>
            <table class="table table-striped table-hover">
              <thead>
               <tr>
                <th style="text-align: center">Nhóm vật tư<br>
                  <select style="width: 150px" class="txtbox" id="materials_cat_name" name="materials_cat_name" onchange="select_material()">
                    <option value="">Vui lòng chọn</option>
                    <?php
                    $sql = "select * from materials_category";
                    $result = mysql_query($sql);
                    while ($row = mysql_fetch_array($result)) {
                      ?>
                      <option value="<?php echo $row['materials_cat_name']; ?>"><?php echo $row['materials_cat_name'];?></option>
                      <?php } ?>
                    </select></th>

                    <th>Tên vật tư<br>
                      <select style="width: 200px;" class="txtbox" id="materials_name" name="materials_name" onchange="select_materialID()"><option value="">Vui lòng chọn</option></select></th>
                      <th style="text-align: center;">Số lượng<br>
                        <input style="width: 100px;" class="txtbox" style="width: 100px" type="" name="materialscount_in"></th>
                        <th style="text-align: center">Mã vật tư<br>
                          <div id="get_materials_id" name="get_materials_id"><input style="width: 100px;" class="txtbox" type="text" name="materials_id"></div></th>
                          <th style="text-align: center">Đơn vị tính<br>
                            <div id="get_materials_unit" name="get_materials_unit"><input style="width: 100px;" class="txtbox" type="text" name="materials_unit"></div></th>
                            <th><input type="submit" name="addtocart" id="addtocart" class="btn btn-info" value="Thêm" /></th>
                          </tr>
                        </thead>
                      </table>
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
                            <td><input style=" width: 50px" class="txtbox" type="text" name="<?php echo ('materialscount_in'.$i) ?>" value='<?php echo $_SESSION["materialscount_in".$i] ?>'></td>
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
                    <input type="submit" name="checkout" id="checkout" class="btn btn-info" value="Cập nhật" />  
                    <a href="index.php?id=dathang&view=TRUE"><input type="button" class="btn btn-default" data-dismiss="modal" value="Đóng"></a>
                  </div>
                </form>
                <!-- cập nhật phiếu đặt hàng vào bản order -->
                <?php
                if(isset($_POST["checkout"])){
                  $warehouse_id = $_POST["warehouse_id"];
                  $order_accept_date = date("Y-m-d",time($_POST['order_accept_date']));
                  $supplier_id = $_POST["supplier_id"];
                  $SQL = "UPDATE ORDERS SET order_id = '$order_id', warehouse_id = '$warehouse_id', supplier_id = '$supplier_id', order_accept_date = '$order_accept_date' WHERE order_id = '$order_id'";
                  $result = mysql_query($SQL);
            // Kết thúc cập nhật phiếu đặt hàng vào bản order
            // Cập nhật hàng hóa vào order_contain
                  for ($i=1; $i < $_SESSION["edit"] ; $i++) { 
                    $materials_id = $_SESSION["materials_id".$i];
                    $materialscount_in = $_POST["materialscount_in".$i];
                    $SQL = "DELETE FROM ORDERS_CONTAIN WHERE order_id = '$order_id' AND materials_id = '$materials_id'" ;
                    $result = mysql_query($SQL);
                  }         
                  for ($i=1; $i < $item ; $i++) { 
                    $materials_id = $_SESSION["materials_id".$i];
                    $materialscount_in = $_POST["materialscount_in".$i];
                    if ($materialscount_in > 0) {
                      $SQL = "INSERT INTO ORDERS_CONTAIN(order_id, materials_id, materialscount_in) VALUES ('$order_id', '$materials_id', '$materialscount_in')";
                      $result = mysql_query($SQL);
                      $_SESSION["materialscount_in".$i] = $materialscount_in;
                      echo "<meta http-equiv='refresh' content='0'>";
                    }
                  }
            // Kết thúc đưa hàng hóa vào order_contain
                }

                ?>
              </div>
            </div>
            <!-- Edit Modal HTML -->
            <?php } ?>
            <script src="js/custom.js"></script>}