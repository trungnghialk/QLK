<!-- Bắt đầu Phân trang -->
<?php 
$url = "index.php?id=dathang&view=true&page=";
$tbl = "orders";
$record_per_page = 30;
$total = mysql_fetch_assoc(mysql_query("SELECT COUNT(*) as total FROM $tbl "));
$total_record = $total['total'];
$total_page = CEIL($total_record / $record_per_page);

if(!isset($_GET['page']) or $_GET['page'] <= 0){
  $start = 0;
}
else {
  $page = $_GET['page'];
  $start = (($page-1)*$record_per_page);
}
?>
<!-- Kết thúc phân trang -->

<div class="container">
  <div class="table-wrapper">
    <div class="table-title">
      <div class="row">
        <div class="col-sm-6">
          <h2><b>ĐƠN ĐẶT HÀNG</b></h2>
        </div>
        <div class="col-sm-6">
          <a href="index.php?id=dathang&new=true" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Tạo phiếu đặt hàng</span></a>            
        </div>
      </div>
    </div>
    <table class="table table-striped table-hover">
      <thead>
       <tr>
        <th>Trạng thái</th>
        <th style="width: 120px;">Mã phiếu</th>
        <th>Kho nhận hàng</th>
        <th>Nhà cung cấp</th>
        <th>Ngày đặt</th>
        <th>Ngày nhận dự kiến</th>
        <th>Tính năng</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      $show = 1;
      $sql = "SELECT * FROM orders AS tblorders INNER JOIN supplier as tblsupplier ON tblorders.supplier_id = tblsupplier.supplier_id INNER JOIN warehouse as tblwarehouse on tblorders.warehouse_id = tblwarehouse.warehouse_id LIMIT $start ,$record_per_page";
      $result = mysql_query($sql);
      while ($row = mysql_fetch_array($result)) {
        $_SESSION['order_id'.$show] = $row['order_id']; 
        $order_id = $row['order_id'];
        ?>
        <tr>
          <td>
            <?php 
            
            $sql1 = "SELECT * FROM orders_contain where order_id = '$order_id'";
            $result1 = mysql_query($sql1);
            $tam = 0;
            while($row1 = mysql_fetch_array($result1)){
              if ($row1["materialscount_out"] > 0){$tam = 1;}
              if ($row1["materialscount_in"] > $row1["materialscount_out"]) { $status = "<div class='label label-warning'>NHẬP THIẾU</div>";}
              if ($row1["materialscount_in"] <= $row1["materialscount_out"]) { $status = "<div class='label label-success'>ĐÃ NHẬP ĐỦ</div>";}
              if ($status == "<div class='label label-warning'>NHẬP THIẾU</div>"){break;}
            }
            if ($tam == 0) { $status = "<div class='label label-default'>CHƯA NHẬP</div>";}
            echo $status;
            ?>
          </td>
          <td><?php echo $row['order_id'] ?></td>
          <td><?php echo $row['warehouse_name'] ?></td>
          <td><?php echo $row['supplier_name'] ?></td>
          <td><?php echo $row['order_date'] ?></td>
          <td><?php echo $row['order_accept_date'] ?></td>
          <td style="width: 170px;">
            <?php include("modules/permission/order_list.php"); ?>
          </td>
        </tr> 
        <?php 
        $show++;
      } ?>
    </tbody>
  </table>
  <?php include("modules/more/page.php"); 
  ?>
</div>
</div>