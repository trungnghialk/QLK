<div class="container">
  <div class="table-wrapper" style="width: 900px; margin: 80px auto;">
    <div class="table-title">
      <div class="row">
        <div class="modal-header"> 
          <h4 class="modal-title">Tạo phiếu đặt hàng</h4>
        </div>
      </div>
    </div>
    <?php 
    if (!isset($_SESSION["item_new"])) {
      $_SESSION["item_new"] = 1;
    }
    if ($_SESSION["clear"] != "O" || $_SESSION["tam"] != "order_new")  {
     $_SESSION["tam"] = $_SESSION["item_new"];
     include("clear.php");
     $_SESSION["clear"] = "O";
     $_SESSION["tam"] = "order_new";
     $_SESSION["item_new"] = 1;
   }
   $item = $_SESSION["item_new"]; 

   $duplicate =0;   
   if(isset($_POST["supplier_id"])){$_SESSION["supplier_id"] = $_POST["supplier_id"];}
   if(isset($_POST['warehouse_id'])){$_SESSION['warehouse_id'] = $_POST['warehouse_id'];}
   if(isset($_POST['order_accept_date'])){
    $_SESSION['order_accept_date'] = $_POST['order_accept_date'];
  } 
  else {
    $_SESSION['order_accept_date'] = date('Y-m-d',time());
  }
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
      $_SESSION["materialscount_in".$item] = $_POST["materialscount_in"];
      $_SESSION["materials_id".$item] = $_POST["materials_id"];
      $_SESSION["materials_unit".$item] = $_POST["materials_unit"];
      $item++ ;
      $_SESSION["item_new"] = $item;
    }
    if ($duplicate == 1) { 
      for ($i=1; $i < $item ; $i++) { 
        if ($_POST["materials_id"] == $_SESSION["materials_id".$i]) {
          $_SESSION["materialscount_in".$i] += $_POST["materialscount_in"];
        }
      }
    }
  }
  ?>
  <form name="add_name" id="add_name" action="" method="POST">  
    <?php $result  = mysql_query('select * from count ORDER BY count_order DESC');
    while ($row = mysql_fetch_array($result)){
      $a = getdate(); 
      $_SESSION['order_id'] = ($row[0].'-PMH'.$a['year']);
      $_SESSION['count_order'] = $row[0];
    } ?>
    <div class="modal-body">
      <table class="tablec">
        <tr class="tr">
          <td class="tdlabel">Mã phiếu:</td>
          <td class="tdbox"><input class="textbox id" name="order_id" id="order_id" readonly="readonly" value="<?php echo $_SESSION['order_id']; ?>"></td>
          <td class="tdlabel">Kho nhận:</td>
          <td class="tdbox">
            <select class="textbox" name="warehouse_id" id="warehouse_id" required="">
              <option value="<?php if (isset($_SESSION['warehouse_id'])){echo $_SESSION['warehouse_id'];} ?>">
                <?php 
                if (isset($_SESSION['warehouse_id'])){
                  $warehouse_id = $_SESSION["warehouse_id"];
                  $sql = "select * from warehouse WHERE warehouse_id = '$warehouse_id'";
                  $result = mysql_query($sql);
                  while ($row = mysql_fetch_array($result)) {
                    echo $row['warehouse_name'] ;
                    unset($_SESSION["warehouse_id"]);
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
            </td>
            <td class="tdlabel">Ngày nhận:</td>
            <td class="tdbox">
              <input required="" class="textbox" type="date" min="2018-01-01" max="2020-12-30" name="order_accept_date" value="<?php echo $_SESSION['order_accept_date']; ?>" >
            </td>
          </tr>
          <tr class="tr">
            <td class="tdlabel">Nhà cung cấp:</td>
            <td colspan="5" class="tdbox">
              <select class="textbox_wide" id="supplier_id" name="supplier_id" required="">
                <option value="<?php if (isset($_SESSION['supplier_id'])){echo $_SESSION['supplier_id'];}?>">
                  <?php 
                  if (isset($_SESSION['supplier_id'])){
                    $supplier_id = $_SESSION["supplier_id"];
                    $sql = "select * from supplier WHERE supplier_id = '$supplier_id'";
                    $result = mysql_query($sql);
                    while ($row = mysql_fetch_array($result)) {
                      echo $row['supplier_name'] ;
                      unset($_SESSION["supplier_id"]);
                    };
                  }
                  else {echo "Vui lòng chọn";} ?>
                </option>
                <?php
                $sql = "select * from supplier";
                $result = mysql_query($sql);
                while ($row = mysql_fetch_array($result)) {
                  ?>
                  <option value="<?php echo $row['supplier_id']; ?>"><?php echo $row['supplier_name']; ?></option>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr class="tr">
              <td class="tdlabel">Diễn giải:</td>
              <td colspan="5" class="tdbox"><textarea rows="3" cols="108" class="textarea" style="margin: 1%"></textarea></td>
            </tr>
          </table>
        </div>
        <div>
          <table class="table table-striped table-hover">
            <thead>
             <tr>
              <th style="text-align: center">Nhóm vật tư<br>
                <select style="width: 150px;" class="txtbox" id="materials_cat_name" name="materials_cat_name" onchange="select_material()">
                  <option value="">Vui lòng chọn</option>
                  <?php
                  $sql = "select * from materials_category";
                  $result = mysql_query($sql);
                  while ($row = mysql_fetch_array($result)) {
                    ?>
                    <option value="<?php echo $row['materials_cat_name']; ?>"><?php echo $row['materials_cat_name'];?></option>
                    <?php } ?>
                  </select>

                  <th style="text-align: center">Tên vật tư<br>
                    <select class="txtbox" style="width: 200px;" id="materials_name" name="materials_name" onchange="select_materialID()"><option value="">Vui lòng chọn</option></select></th>
                    <th style="text-align: center;">Số lượng<br><input class="txtbox" style="width: 100px" type="number" min="0" name="materialscount_in"></th>
                    <th style="text-align: center">Mã vật tư<br><div id="get_materials_id" name="get_materials_id"><input readonly="readonly" style="width: 100px" class="txtbox" type="text" name="materials_id"></div></th>
                    <th style="text-align: center">Đơn vị tính<br><div id="get_materials_unit" name="get_materials_unit"><input readonly="readonly" type="text" style="width: 100px;" class="txtbox" name="materials_unit"></div></th>
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
                    <td><input style=" width: 50px" class="txtbox" type="text" name="<?php echo ('materialscount_in'.$i) ?>" value='<?php echo $_SESSION["materialscount_in".$i] ?>'></td>
                    <td><?php echo $_SESSION["materials_unit".$i] ?></td>
                    <td><?php echo $_SESSION["materials_cat_name".$i] ?></td>
                  </tr> 
                  <?php 

                } 
              } ?>
            </tbody>
          </table>         
          <div class="modal-footer">
            <input type="submit" name="checkout" id="checkout" class="btn btn-success" value="Đặt hàng" />  
            <a href="index.php?id=dathang&view=TRUE"><input type="button" class="btn btn-default" data-dismiss="modal" value="Hủy"></a>
          </div>
        </form>
        <?php
        if(isset($_POST["checkout"]) && $_SESSION["item_new"] > 1){
          $result  = mysql_query('select * from count ORDER BY count_order DESC');
          while ($row = mysql_fetch_array($result)){
            $a = getdate(); 
            $order_id = ($row[0].'-PMH'.$a['year']);
            $count_order = $row[0];
          }

            // $order_id = $_POST["order_id"];
          $warehouse_id = $_POST["warehouse_id"];
          $order_accept_date = date("Y-m-d",strtotime(str_replace('/', '-', $_POST["order_accept_date"])));
          $supplier_id = $_POST["supplier_id"];
          $SQL = "INSERT INTO ORDERS(order_id, warehouse_id, supplier_id, order_accept_date,username) VALUES ('$order_id', '$warehouse_id', '$supplier_id', '$order_accept_date','')";
          $result = mysql_query($SQL);

          for ($i=1; $i < $item ; $i++) { 
            $materials_id = $_SESSION["materials_id".$i];
            $materialscount_in = $_POST["materialscount_in".$i];
            if($materialscount_in > 0){
              $SQL = "INSERT INTO ORDERS_CONTAIN(order_id, materials_id, materialscount_in) VALUES ('$order_id', '$materials_id', '$materialscount_in')";
              $result = mysql_query($SQL);
            }
            unset($_SESSION["item_new"]);
            unset($_SESSION["materials_id".$i]);
            unset($_SESSION["materials_name".$i]);
            unset($_SESSION["materialscount_in".$i]);
            unset($_SESSION["materials_unit".$i]);
            unset($_SESSION["materials_cat_name".$i]);
            unset($_SESSION["warehouse_name"]);
            unset($_SESSION["warehouse_id"]);
            unset($_SESSION["supplier_id"]);
            unset($_SESSION["supplier_name"]);
            unset($_SESSION["order_accept_date"]);
          }
            // $count_order = $_SESSION['count_order'];
          $count_order++;
          mysql_query("UPDATE count SET count_order= '$count_order' WHERE id = 1");
          echo "<meta http-equiv='refresh' content='0'>";

        }

        ?>
      </div>
    </div>
    <!-- Edit Modal HTML -->
    <script src="js/custom.js"></script>}
