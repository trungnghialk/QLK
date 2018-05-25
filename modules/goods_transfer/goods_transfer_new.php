<div class="container">
  <div class="table-wrapper" style="width: 900px; margin: 80px auto;">
    <div class="table-title">
      <div class="row">
        <div class="modal-header"> 
          <h4 class="modal-title">Tạo phiếu chuyển kho</h4>
        </div>
      </div>
    </div>
    <?php 
    if (!isset($_SESSION["item_new"])) {
      $_SESSION["item_new"] = 1;
    }
    if ($_SESSION["clear"] != "O" || $_SESSION["tam"] != "transfer_new")  {
     $_SESSION["tam"] = $_SESSION["item_new"];
     include("clear.php");
     $_SESSION["clear"] = "O";
     $_SESSION["tam"] = "transfer_new";
     $_SESSION["item_new"] = 1;
   }
   $item = $_SESSION["item_new"]; 
   if(isset($_POST['warehouse_id_out']) && isset($_SESSION['warehouse_id_out'])){
    if($_POST['warehouse_id_out'] != $_SESSION['warehouse_id_out']){
      for ($i=1; $i < $item ; $i++) { 
        unset($_SESSION["materials_name".$i]);
        unset($_SESSION["materials_cat_name".$i]);
        unset($_SESSION["materialscount".$i]);
        unset($_SESSION["materials_id".$i]);
        unset($_SESSION["materials_unit".$i]);
        unset($_SESSION["materials_total".$i]);
      }
      $item = 1;
    }
  }
  if(isset($_POST['warehouse_id_out'])){
    $_SESSION['warehouse_id_out'] = $_POST['warehouse_id_out'];
  }
  if(isset($_POST['warehouse_id_in'])){
    $_SESSION['warehouse_id_in'] = $_POST['warehouse_id_in'];
  }
  if(isset($_POST['goodstransfer_send_date'])){
    $_SESSION['goodstransfer_send_date'] = $_POST['goodstransfer_send_date'];
  }
  else {
   $_SESSION['goodstransfer_send_date'] = date('Y-m-d',time());
 }
 if(isset($_POST['goodstransfer_receive_date'])){
   $_SESSION['goodstransfer_receive_date'] = $_POST['goodstransfer_receive_date'];
 }
 else {
  $_SESSION['goodstransfer_receive_date'] = date('Y-m-d',time());
}

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
      $_SESSION["item_new"] = $item;
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
      <?php $result  = mysql_query('select * from count ORDER BY count_order DESC');
      while ($row = mysql_fetch_array($result)){
        $a = getdate(); 
        $_SESSION['goodstransfer_id'] = ($row[4].'-PCK'.$a['year']);
        $_SESSION['count_transfer'] = $row[4];
      } ?>
      <div class="modal-body">
        <table class="tablec">
          <tr class="tr">
            <td class="tdlabel">Mã P.Chuyển:</td>
            <td class="tdbox"><input class="textbox id" name="goodstransfer_id" id="order_id" readonly="readonly" value="<?php echo $_SESSION['goodstransfer_id']; ?>"></td>
            <td class="tdlabel">Kho xuất:</td>
            <td class="tdbox">
              <select class="textbox" name="warehouse_id_out" id="warehouse_id" required="" onchange="select_warehouse_in()">
                <option value="<?php if (isset($_SESSION['warehouse_id_out'])){echo $_SESSION['warehouse_id_out'];} ?>">
                  <?php 
                  if (isset($_SESSION['warehouse_id_out'])){
                    $warehouse_id_out = $_SESSION["warehouse_id_out"];
                    $sql = "select * from warehouse WHERE warehouse_id = '$warehouse_id_out'";
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
              </td>
              <td class="tdlabel">Ngày xuất:</td>
              <td class="tdbox"><input required="" class="textbox" type="date" min="2018-01-01" max="2020-12-30" name="goodstransfer_send_date" value="<?php echo $_SESSION['goodstransfer_send_date'];?>" ></td>
            </tr>
            <tr class="tr">
              <td class="tdlabel"></td>
              <td class="tdbox"></td>
              <td class="tdlabel">Kho nhận:</td>
              <td class="tdbox">
                <select class="textbox" id="warehouse_in" name="warehouse_id_in">
                  <option value="<?php if (isset($_SESSION['warehouse_id_in'])){echo $_SESSION['warehouse_id_in'];} ?>">
                    <?php 
                    if (isset($_SESSION['warehouse_id_in'])){
                      $warehouse_id_in = $_SESSION["warehouse_id_in"];
                      $sql = "select * from warehouse WHERE warehouse_id = '$warehouse_id_in'";
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
                </td>
                <td class="tdlabel">Ngày nhận:</td>
                <td class="tdbox"><input required="" class="textbox" type="date" min="2018-01-01" max="2020-12-30" name="goodstransfer_receive_date" value="<?php echo $_SESSION['goodstransfer_receive_date'];?>" ></td>
              </tr>
              <tr class="tr">
                <td class="tdlabel">Diễn giải:</td>
                <td colspan="5" class="tdbox"><textarea rows="3" cols="108" class="textarea" style="margin: 1%"></textarea></td>
              </tr>
            </table> 
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
                      <td><input style=" width: 50px" class="txtbox" type="number" min="0" max="<?php echo $_SESSION['materials_total'.$i] ?>" name="<?php echo ('materialscount'.$i) ?>" value='<?php echo $_SESSION["materialscount".$i] ?>'></td>
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
            if(isset($_POST["checkout"]) && $_SESSION["item_new"] > 1){
              $result  = mysql_query('select * from count ORDER BY count_order DESC');
              while ($row = mysql_fetch_array($result)){
                $a = getdate(); 
                $goodstransfer_id = ($row[4].'-PCK'.$a['year']);
                $count_transfer = $row[4];
              } 

                  // $goodstransfer_id = $_POST["goodstransfer_id"];
              $warehouse_id_out = $_POST["warehouse_id_out"];
              $warehouse_id_in = $_POST["warehouse_id_in"];
              $goodstransfer_send_date =date("Y-m-d",time($_POST['goodstransfer_send_date']));
              $goodstransfer_receive_date =date("Y-m-d",time($_POST['goodstransfer_receive_date']));
              $goodstransfer_user = $_SESSION["username"];
              $SQL = "INSERT INTO goods_transfer(goodstransfer_id, warehouse_id_send, warehouse_id_receive, goodstransfer_send_date, goodstransfer_receive_date, goodstransfer_user,goodstransfer_status) VALUES ('$goodstransfer_id','$warehouse_id_out','$warehouse_id_in','$goodstransfer_send_date', '$goodstransfer_receive_date', '$goodstransfer_user', 'ok')";
              $result = mysql_query($SQL);
              for ($i=1; $i < $item ; $i++) { 
                $materials_id = $_SESSION["materials_id".$i];
                $materialscount = $_POST["materialscount".$i];
                    // $materials_total = $_SESSION["materials_total".$i] - $_POST["materialscount".$i];
                if($materialscount > 0){
                  $SQL = "INSERT INTO goods_transfer_contain(goodstransfer_id, materials_id, materialscount) VALUES ('$goodstransfer_id', '$materials_id', '$materialscount')";
                  $result = mysql_query($SQL);
                      // $SQL = "UPDATE warehouse_contain SET warehouse_contain_total = '$materials_total' WHERE warehouse_id = '$warehouse_id' AND materials_id = '$materials_id'";
                      // $result = mysql_query($SQL);
                }
                unset($_SESSION["item_new"]);
                unset($_SESSION["materials_id".$i]);
                unset($_SESSION["materials_name".$i]);
                unset($_SESSION["materialscount".$i]);
                unset($_SESSION["materials_unit".$i]);
                unset($_SESSION["materials_cat_name".$i]);
                unset($_SESSION["materials_total".$i]);
              }
              unset($_SESSION["warehouse_name"]);
              unset($_SESSION["warehouse_id"]);
                  // $count_transfer = $_SESSION['count_transfer'];
              $count_transfer++;
              mysql_query("UPDATE count SET count_transfer= '$count_transfer' WHERE id = 1");
              echo "<meta http-equiv='refresh' content='0'>";
            }
            ?>
          </div>
        </div>
        <!-- Edit Modal HTML -->
        <script src="js/custom.js"></script>}
