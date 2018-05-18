<?php $goodstransfer_id = $_GET["goodstransfer_id"]; ?>

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
    if($_GET["goodstransfer_id"] != $_SESSION["clear"] or $_SESSION["tam"] != "send"){
      $goodstransfer_id = $_GET["goodstransfer_id"];
      $edit = 1;
      $sql = "SELECT * FROM goods_transfer_contain as a INNER JOIN materials as b ON a.materials_id = b.materials_id INNER JOIN materials_category as c on b.materials_cat_id = c.materials_cat_id WHERE goodstransfer_id = '$goodstransfer_id'";
      $result = mysql_query($sql);
      while ($row = mysql_fetch_array($result)) {
        $_SESSION["materials_id".$edit] = $row["materials_id"];
        $_SESSION['materials_name'.$edit] = $row['materials_name'];
        $_SESSION['materials_cat_name'.$edit] = $row['materials_cat_name'];
        $_SESSION['materials_unit'.$edit] = $row['materials_unit'];
        $_SESSION['materialscount_out'.$edit] = $row['materialscount_out'];
        $_SESSION['materials_total'.$edit] = $row['materialscount'];
        $edit++;
      }
      $_SESSION["clear"] = $_GET["goodstransfer_id"];
      $_SESSION["tam"] = "send";
      $_SESSION["edit"] = $edit;
      $_SESSION["item"] = $edit;
    }
    $item = $_SESSION["item"];   

    ?>

    <form name="add_name" id="add_name" action="" method="POST">  
      <?php 
      $sql = "SELECT goodstransfer_id, warehouse_id_send, b.warehouse_name as warehouse_name_out, c.warehouse_name as warehouse_name_in, goodstransfer_send_date, goodstransfer_receive_date, goodstransfer_status FROM goods_transfer as a INNER JOIN warehouse as b ON a.warehouse_id_send = b.warehouse_id INNER JOIN warehouse as c ON a.warehouse_id_receive = c.warehouse_id WHERE goodstransfer_id = '$goodstransfer_id'";
      $result  = mysql_query($sql);
      while ($row = mysql_fetch_array($result)){ 
        $_SESSION["warehouse_id_send"] = $row["warehouse_id_send"];
        ?>

        <div class="modal-body">
          <div class="lbcode">Mã phiếu chuyển: <input style="text-align: center; width: 120px;" name="goodstransfer_id" id="order_id" readonly="readonly" value="<?php echo $row['goodstransfer_id']; ?>"></div>
          <div class="lfield" style="padding-left: 8px">
            Kho xuất: <input type="hidden" name="warehouse_id" id="warehouse_id" value="<?php echo $row['warehouse_id_send'] ?>">
            <input style="width: 120px" name="warehouse_name_out" id="warehouse_name_out" readonly="readonly" value="<?php echo $row['warehouse_name_out'] ?>">
          </div>
          <div class="lfield">Kho Nhập: <input style="width: 120px; margin-left: 8px;" id="warehouse_in" name="warehouse_id_in" readonly="readonly" value="<?php echo $row["warehouse_name_in"] ?>"></div>
          <div class="clear"></div>
          <div class="lbcode">Mã phiếu xuất: <input style="text-align: center; width: 120px; margin-left: 20px;" name="goodstransfer_id" id="order_id" readonly="readonly" value="<?php 
          $result_id  = mysql_query('select * from count ORDER BY count_issue DESC');
          while ($row_id = mysql_fetch_array($result_id)){
            $a = getdate(); 
            $goodsissue_id = ($row_id[3].'-PXK'.$a['year']);
            echo $goodsissue_id;
          } ?>"></div>
          <div class="lfield">Ngày xuất: <input required="" class="txtbox" style="width: 120px;" type="date" min="2018-01-01" max="2020-12-31" name="goodstransfer_send_date" value="<?php echo $row["goodstransfer_send_date"] ?>"></div>
          <div class="lfield">Ngày nhập: <input required="" class="txtbox" style="width: 120px;" type="text" name="goodstransfer_receive_date" value="<?php echo $row["goodstransfer_receive_date"] ?>" readonly="readonly"></div>

          <div class="clear"></div>
          <div>Ghi chú: <br>
            <textarea name="goodstransfer_note" style="width: 760px; height: 50px;" readonly="readonly">aaaa</textarea>
          </div>
          <?php 
        }
        for ($i=1; $i < $_SESSION['edit'] ; $i++) { 
          $materials_id = $_SESSION["materials_id".$i];
          $sql = "SELECT * FROM goods_transfer_contain WHERE materials_id = '$materials_id' AND goodstransfer_id = '$goodstransfer_id'";
          $result = mysql_query($sql);
          while ($row = mysql_fetch_array($result)) {
          }
        }      
        ?>
        <div class="clear" style="margin-top: 20px;"></div>
        <table class="table table-striped table-hover">
          <thead>
           <tr>
            <th>Mã vật tư</th>
            <th>Tên vật tư</th>
            <th>Số lượng xuất</th>
            <th>Đơn vị tính</th>
            <th>Nhóm vật tư</th>
            <th>Tổng Số lượng</th>
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
              <td><input style=" width: 50px" class="txtbox" type="number" min="0" name="<?php echo ('materialscount_out'.$i) ?>" value='<?php $rs= $_SESSION["materials_total".$i] - $_SESSION["materialscount_out".$i]; echo $rs; ?>'></td>
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
        <a href="index.php?id=chuyenkho&view=true"><input type="button" class="btn btn-default" data-dismiss="modal" value="Hủy"></a>
      </div>
    </form>
    <?php
    if(isset($_POST["checkout"])){
     $result  = mysql_query('select * from count ORDER BY count_issue DESC');
     while ($row = mysql_fetch_array($result)){
      $a = getdate(); 
      $goodsissue_id = ($row[3].'-PXK'.$a['year']);
      $count_issue = $row[3];
    }
    $goodstransfer_send_date = $_POST["goodstransfer_send_date"];
    $goodsissue_user = $_SESSION["username"];
    $warehouse_id = $_POST["warehouse_id"];
    $goodstransfer_note = $_POST["goodstransfer_note"];

    $sql = "INSERT INTO goods_issue( goodsissue_id, goodsissue_date, goodsissue_user, warehouse_id, goodsissue_note) values ('$goodsissue_id', '$goodstransfer_send_date', '$goodsissue_user', '$warehouse_id', '$goodstransfer_note')";
    $result = mysql_query($sql);

    for ($i=1; $i < $item ; $i++) { 
      $materials_id = $_SESSION["materials_id".$i];
      $warehouse_id_send = $_SESSION["warehouse_id_send"];
      $materialscount_out = $_POST["materialscount_out".$i];
      $SQL = "UPDATE goods_transfer_contain SET materialscount_out = materialscount_out + '$materialscount_out' WHERE goodstransfer_id = '$goodstransfer_id' AND materials_id = '$materials_id'";
      $result = mysql_query($SQL);
      $sql = "UPDATE warehouse_contain SET warehouse_contain_total = warehouse_contain_total - '$materialscount_out' WHERE warehouse_id = '$warehouse_id_send' AND materials_id = '$materials_id' ";
      $result = mysql_query($sql);
      $sql = "INSERT INTO goods_issue_contain( goodsissue_id, materials_id, materialscount) VALUES ('$goodsissue_id', '$materials_id', '$materialscount_out')";
      $result = mysql_query($sql);
        // $SQL = "UPDATE warehouse_contain SET warehouse_contain_total = warehouse_contain_total - materialscount_out WHERE "
      unset($_SESSION["materials_id".$i]);
      unset($_SESSION["materials_name".$i]);
      unset($_SESSION["materialscount_out".$i]);
      unset($_SESSION["materials_unit".$i]);
      unset($_SESSION["materials_cat_id".$i]);
      unset($_SESSION["materials_total".$i]);

    }
    $count_issue++;
    mysql_query("UPDATE count SET count_issue = '$count_issue' WHERE id = 1");
    $_SESSION["clear"] = "O";
    echo "<meta http-equiv='refresh' content='0'>";
  }
  
  ?>
</div>
</div>
<!-- Edit Modal HTML -->
<script src="js/custom.js"></script>}
