<?php $goodstransfer_id = $_GET["goodstransfer_id"] ?>
<div class="container">
  <div class="table-wrapper" style="width: 900px; margin: 80px auto;">
    <div class="table-title">
      <div class="row">
        <div class="modal-header"> 
          <h4 class="modal-title">Tạo phiếu nhập kho</h4>
        </div>
      </div>
    </div>
    <?php 
    if($_GET["goodstransfer_id"] != $_SESSION["clear"] or $_SESSION["tam"] != "receive"){
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
        $_SESSION['materialscount_in'.$edit] = $row['materialscount_in'];
        $_SESSION['materials_total'.$edit] = $row['materialscount'];
        $edit++;
      }
      $_SESSION["clear"] = $_GET["goodstransfer_id"];
      $_SESSION["tam"] = "receive";
      $_SESSION["edit"] = $edit;
      $_SESSION["item"] = $edit;
    }
    $item = $_SESSION["item"];   
    $sql = "SELECT warehouse_id_receive FROM goods_transfer WHERE goodstransfer_id = '$goodstransfer_id'";
    $result = mysql_query($sql);
    while ($row = mysql_fetch_array($result)) {
      $_SESSION["warehouse_id_receive"] = $row["warehouse_id_receive"];
    }
    ?>

    <form name="add_name" id="add_name" action="" method="POST">  
      <?php 
      $sql = "SELECT goodstransfer_id, warehouse_id_receive, b.warehouse_name as warehouse_name_out, c.warehouse_name as warehouse_name_in, goodstransfer_send_date, goodstransfer_receive_date, goodstransfer_status FROM goods_transfer as a INNER JOIN warehouse as b ON a.warehouse_id_send = b.warehouse_id INNER JOIN warehouse as c ON a.warehouse_id_receive = c.warehouse_id WHERE goodstransfer_id = '$goodstransfer_id'";
      $result  = mysql_query($sql);
      while ($row = mysql_fetch_array($result)){ 
        $_SESSION["warehouse_id_out"] = $row["warehouse_id_receive"];
        ?>

        <div class="modal-body">
          <div class="lbcode">Mã phiếu chuyển: <input style="text-align: center; width: 120px" name="goodstransfer_id" id="order_id" readonly="readonly" value="<?php echo $row['goodstransfer_id']; ?>"></div>
          <div class="lfield">
            Kho xuất: <input type="hidden" name="warehouse_id" id="warehouse_id" value="<?php echo $row['warehouse_id_receive'] ?>">
            <input style="width: 120px; margin-left: 8px;" name="warehouse_name_out" id="warehouse_name_out" readonly="readonly" value="<?php echo $row['warehouse_name_out'] ?>">
          </div>
          <div class="lfield">Kho Nhập: <input style="width: 120px; id="warehouse_in" name="warehouse_id_in" readonly="readonly" value="<?php echo $row["warehouse_name_in"] ?>"></div>
          <div class="clear"></div>
          <div class="lbcode" style="padding-left: 15px">Mã phiếu nhập: <input style="text-align: center; width: 120px" name="goodstransfer_id" id="order_id" readonly="readonly" value="<?php 
          $result_id  = mysql_query('select * from count ORDER BY count_receipt DESC');
          while ($row_id = mysql_fetch_array($result_id)){
            $a = getdate(); 
            $goodsreceipt_id = ($row_id[2].'-PNK'.$a['year']);
            echo $goodsreceipt_id;
          } ?>"></div>
          <div class="lfield" style="padding-left: 0px">Ngày xuất: <input required="" class="txtbox" style="width: 120px;" type="text" name="goodstransfer_send_date" value="<?php echo $row["goodstransfer_send_date"] ?>" readonly="readonly"></div>
          <div class="lfield">Ngày nhập:<input required="" class="txtbox" style="width: 120px;" type="date" min="2018-01-01" max="2020-12-31" name="goodstransfer_receive_date" value="<?php echo $row["goodstransfer_receive_date"] ?>" readonly="readonly"></div>
          <div class="clear"></div>
          <div>Ghi chú: <br>
            <textarea name="goodstransfer_note" style="width: 760px; height: 50px;" readonly="readonly"></textarea>
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
            <th>SL nhập</th>
            <th>Đơn vị tính</th>
            <th>Nhóm vật tư</th>
            <th>SL Xuất</th>
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
              <td><input style=" width: 50px" class="txtbox" type="number" min="0" name="<?php echo ('materialscount_in'.$i) ?>" value='<?php $rs= $_SESSION["materialscount_out".$i] - $_SESSION["materialscount_in".$i]; echo $rs; ?>'></td>
              <td><?php echo $_SESSION["materials_unit".$i] ?></td>
              <td><?php echo $_SESSION["materials_cat_name".$i] ?></td>
              <td><?php echo $_SESSION["materialscount_out".$i] ?></td>
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
      $result  = mysql_query('select * from count ORDER BY count_receipt DESC');
      while ($row = mysql_fetch_array($result)){
        $a = getdate(); 
        $goodsreceipt_id = ($row[2].'-PNK'.$a['year']);
        $count_receipt = $row[2];
      }
      $goodstransfer_receive_date = $_POST['goodstransfer_receive_date'];
      $goodsreceipt_user = $_SESSION['username'];
      $warehouse_id_receive = $_SESSION["warehouse_id_receive"];
      $sql = "INSERT INTO goods_receipt( goodsreceipt_id, goodsreceipt_type, goodsreceipt_date, goodsreceipt_user, warehouse_id, order_id) VALUES('$goodsreceipt_id',  'Chuyển kho', '$goodstransfer_receive_date', '$goodsreceipt_user', '$warehouse_id_receive', '$goodstransfer_id')";
      mysql_query($sql);
      for ($i=1; $i < $item ; $i++) { 
        $materials_id = $_SESSION["materials_id".$i];
        $materialscount_in = $_POST["materialscount_in".$i];
        $SQL = "UPDATE goods_transfer_contain SET materialscount_in = materialscount_in + '$materialscount_in' WHERE goodstransfer_id = '$goodstransfer_id' AND materials_id = '$materials_id'";
        mysql_query($SQL);
        $sql = "SELECT * FROM warehouse_contain WHERE warehouse_id = '$warehouse_id_receive' AND materials_id = '$materials_id' ";
        $result = mysql_query($sql);
        if(mysql_fetch_row($result) != null ){
          $sql1 = "UPDATE warehouse_contain SET warehouse_contain_total = warehouse_contain_total + '$materialscount_in' WHERE warehouse_id = '$warehouse_id_receive' AND materials_id = '$materials_id' ";
          mysql_query($sql1);
        }
        else {
          $sql1 = "INSERT INTO warehouse_contain( warehouse_id, materials_id, warehouse_contain_total) VALUES ( '$warehouse_id_receive', '$materials_id', '$materialscount_in')";
          mysql_query($sql1);
        }
        if( $materialscount_in > 0){
         $sql = "INSERT INTO goods_receipt_contain( goodsreceipt_id, materials_id, materialscount) VALUES ('$goodsreceipt_id', '$materials_id', '$materialscount_in')" ;
         mysql_query($sql);
        }

        // $SQL = "UPDATE warehouse_contain SET warehouse_contain_total = warehouse_contain_total - materialscount_out WHERE "
        unset($_SESSION["materials_id".$i]);
        unset($_SESSION["materials_name".$i]);
        unset($_SESSION["materialscount_out".$i]);
        unset($_SESSION["materials_unit".$i]);
        unset($_SESSION["materials_cat_id".$i]);
        unset($_SESSION["materials_total".$i]);

      }
      $_SESSION["clear"] = "O";
      $count_receipt++;
      mysql_query("UPDATE count SET count_receipt= '$count_receipt' WHERE id = 1");
      echo "<meta http-equiv='refresh' content='0'>";
    }

    ?>
  </div>
</div>
<!-- Edit Modal HTML -->
<script src="js/custom.js"></script>}
