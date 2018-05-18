<div class="container">
  <div class="table-wrapper" style="width: 900px; margin: 80px auto;">
    <div class="table-title">
      <div class="row">
        <div class="modal-header"> 
          <h4 class="modal-title">Tạo phiếu xuất kho</h4>
        </div>
      </div>
    </div>
    <?php 
    if (!isset($_SESSION["item_new"])) {
      $_SESSION["item_new"] = 1;
    }
    $item = $_SESSION["item_new"]; 
    if(isset($_POST['warehouse_id']) && isset($_SESSION['warehouse_id'])){
      if($_POST['warehouse_id'] != $_SESSION['warehouse_id']){
        for ($i=1; $i < $item ; $i++) { 
          unset($_SESSION["materials_name".$i]);
          unset($_SESSION["materials_cat_name".$i]);
          unset($_SESSION["materialscount_in".$i]);
          unset($_SESSION["materials_id".$i]);
          unset($_SESSION["materials_unit".$i]);
          unset($_SESSION["materials_total".$i]);
        }
        $item = 1;
      }}
      if(isset($_POST['warehouse_id'])){$_SESSION['warehouse_id'] = $_POST['warehouse_id'];}
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
          $_SESSION["materialscount_in".$item] = $_POST["materialscount_in"];
          if($_POST["materialscount_in"] > $_POST["materials_total"]){
            $_SESSION["materialscount_in".$item] = $_POST["materials_total"];}
            $_SESSION["materials_id".$item] = $_POST["materials_id"];
            $_SESSION["materials_unit".$item] = $_POST["materials_unit"];
            $_SESSION["materials_total".$item] = $_POST["materials_total"];
            $item++ ;
            $_SESSION["item_new"] = $item;
          }
          if ($duplicate == 1) { 
            for ($i=1; $i < $item ; $i++) { 
              if ($_POST["materials_id"] == $_SESSION["materials_id".$i]) {
                $_SESSION["materialscount_in".$i] += $_POST["materialscount_in"];
                if($_SESSION["materialscount_in".$i] > $_POST["materials_total"]){
                  $_SESSION["materialscount_in".$i] = $_POST["materials_total"];}
                }
              }
            }
          }
          ?>
          <form name="add_name" id="add_name" action="" method="POST">  
            <?php $result  = mysql_query('select * from count ORDER BY count_order DESC');
            while ($row = mysql_fetch_array($result)){
              $a = getdate(); 
              $_SESSION['goodsissue_id'] = ($row[3].'-PXK'.$a['year']);
              $_SESSION['count_issue'] = $row[3];
            } ?>
            <div class="modal-body">
              <div class="lbcode">Mã phiếu: <input style="text-align: center;" name="goodsissue_id" id="order_id" readonly="readonly" value="<?php echo $_SESSION['goodsissue_id']; ?>"></div>
              <div class="lfield">
                Kho xuất hàng: 
                <select class="txtbox" name="warehouse_id" id="warehouse_id" required="" onchange="select_material_cat()">
                  <option value="<?php if (isset($_SESSION['warehouse_id'])){echo $_SESSION['warehouse_id'];} ?>">
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
                <div class="lfield">Ngày xuất: <input required="" class="txtbox" style="width: 100px;" type="text" name="goodsissue_date" value="<?php $a = getdate(); echo $a['mday'].'/'.$a['mon'].'/'.$a['year'];?>" ></div>

                <div class="clear"></div>
                <div>Ghi chú: <br>
                  <textarea name="goodsissue_note" style="width: 760px; height: 50px;"></textarea>
                </div>
                <table class="table table-striped table-hover">
                  <thead>
                   <tr>
                    <th style="text-align: center">Nhóm vật tư<br>
                      <select style="width: 150px;" class="txtbox" id="materials_cat_name" name="materials_cat_name" onchange="select_issue_material()">
                        <?php
                        if (isset($_SESSION["warehouse_id"])) {
                          $warehouse_id = $_SESSION["warehouse_id"];
                          $_SESSION["warehouse_id"] = $warehouse_id;
                          $sql = "select DISTINCT materials_cat_name from materials_category as a INNER JOIN materials AS b on a.materials_cat_id = b.materials_cat_id INNER JOIN warehouse_contain as c on b.materials_id = c.materials_id where warehouse_id = '$warehouse_id' ";
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
                          <th style="text-align: center;">Số lượng<br><input min="0" max="" class="txtbox" style="width: 70px" type="number" name="materialscount_in"></th>
                          <th style="text-align: center">Tồn kho<br><div id="warehouse_contain_total" name=""><input style="width: 70px" class="txtbox" type="text" name="materials_total" readonly="readonly"></div></th>
                          <th style="text-align: center">Mã vật tư<br><div readonly="readonly" id="get_materials_id" name="get_materials_id"><input readonly="readonly" style="width: 100px" class="txtbox" type="text" name="materials_id"></div></th>
                          <th style="text-align: center">ĐVT<br><div id="get_materials_unit" name="get_materials_unit"><input readonly="readonly" type="text" style="width: 70px;" class="txtbox" name="materials_unit"></div></th>
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
                          <td><input style=" width: 50px" class="txtbox" type="number" min="0" max="<?php echo $_SESSION['materials_total'.$i] ?>" name="<?php echo ('materialscount_in'.$i) ?>" value='<?php echo $_SESSION["materialscount_in".$i] ?>'></td>
                          <td><?php echo $_SESSION["materials_unit".$i] ?></td>
                          <td><?php echo $_SESSION["materials_cat_name".$i] ?></td>
                          <td><?php echo $_SESSION["materials_total".$i] ?></td>
                        </tr> 
                        <?php 

                      } } ?>
                    </tbody>
                  </table>         
                  <div class="modal-footer">
                    <input type="submit" name="checkout" id="checkout" class="btn btn-success" value="Xuất kho" />  
                    <a href="index.php?id=xuatkho&view=true"><input type="button" class="btn btn-default" data-dismiss="modal" value="Hủy"></a>
                  </div>
                </form>
                <?php
                if(isset($_POST["checkout"]) && $_SESSION["item_new"] > 1){
                  $result  = mysql_query('select * from count ORDER BY count_order DESC');
                  while ($row = mysql_fetch_array($result)){
                    $a = getdate(); 
                    $goodsissue_id = ($row[3].'-PXK'.$a['year']);
                    $count_issue = $row[3];
                  }
                  // $goodsissue_id = $_POST["goodsissue_id"];
                  $warehouse_id = $_POST["warehouse_id"];
                  $goodsissue_date =date("Y-m-d",time($_POST['goodsissue_date']));
                  $goodsissue_user = $_SESSION["username"];
                  $goodsissue_note = $_POST["goodsissue_note"];
                  $SQL = "INSERT INTO goods_issue(goodsissue_id, warehouse_id, goodsissue_date,goodsissue_user,goodsissue_note) VALUES ('$goodsissue_id','$warehouse_id','$goodsissue_date','$goodsissue_user','$goodsissue_note')";
                  $result = mysql_query($SQL);

                  for ($i=1; $i < $item ; $i++) { 
                    $materials_id = $_SESSION["materials_id".$i];
                    $materialscount_in = $_POST["materialscount_in".$i];
                    $materials_total = $_SESSION["materials_total".$i] - $_POST["materialscount_in".$i];
                    if($materialscount_in > 0){
                      $SQL = "INSERT INTO goods_issue_contain(goodsissue_id, materials_id, materialscount) VALUES ('$goodsissue_id', '$materials_id', '$materialscount_in')";
                      $result = mysql_query($SQL);
                      $SQL = "UPDATE warehouse_contain SET warehouse_contain_total = '$materials_total' WHERE warehouse_id = '$warehouse_id' AND materials_id = '$materials_id'";
                      $result = mysql_query($SQL);
                    }
                    unset($_SESSION["item_new"]);
                    unset($_SESSION["materials_id".$i]);
                    unset($_SESSION["materials_name".$i]);
                    unset($_SESSION["materialscount_in".$i]);
                    unset($_SESSION["materials_unit".$i]);
                    unset($_SESSION["materials_cat_name".$i]);
                    unset($_SESSION["materials_total".$i]);
                  }
                  unset($_SESSION["warehouse_name"]);
                  unset($_SESSION["warehouse_id"]);
                  // $count_issue = $_SESSION['count_issue'];
                  $count_issue++;
                  mysql_query("UPDATE count SET count_issue= '$count_issue' WHERE id = 1");
                  echo "<meta http-equiv='refresh' content='0'>";
                }
                ?>
              </div>
            </div>
            <!-- Edit Modal HTML -->
            <script src="js/custom.js"></script>}
