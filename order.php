<?php
if(isset($_GET['view_order']) == "true") {
 include ("modules/order/order_view.php") ;
}
if(isset($_GET['new']) == "true") {
 include ("modules/order/order_new.php") ;
}
if (isset($_GET['edit']) == "true") {
  include ("modules/order/order_edit.php");
}
if (isset($_GET['approve']) == "true") {
  include ("modules/order/order_approve.php");
}
if (isset($_GET['goods_receipt']) == "true") {
  include ("modules/goods_receipt/goods_receipt_new.php");
}
if (isset($_GET['view']) == "true") {
  ?>

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
        $sql = "SELECT * FROM orders AS tblorders INNER JOIN supplier as tblsupplier ON tblorders.supplier_id = tblsupplier.supplier_id INNER JOIN warehouse as tblwarehouse on tblorders.warehouse_id = tblwarehouse.warehouse_id";
        $result = mysql_query($sql);
        while ($row = mysql_fetch_array($result)) {
          $_SESSION['order_id'.$show] = $row['order_id']; 
          ?>
          <tr>
            <td><?php echo $row['order_id'] ?></td>
            <td><?php echo $row['warehouse_name'] ?></td>
            <td><?php echo $row['supplier_name'] ?></td>
            <td><?php echo $row['order_date'] ?></td>
            <td><?php echo $row['order_accept_date'] ?></td>
            <td style="width: 150px;">
              <a href="<?php echo ('index.php?id=dathang&edit=true&order_id='.$row['order_id']) ?>" class="btn btn-warning" data-toggle="modal"><span>Sửa</span></a>
              <a href="<?php echo ('modules/order/order_del.php?order_id='.$_SESSION['order_id'.$show]); ?>" class="btn btn-danger" data-toggle="modal"><span>Xóa</span></a>
              <a href="<?php echo ('index.php?id=dathang&approve=true&order_id='.$row['order_id']) ?>" class="btn btn-success" data-toggle="modal"><span>Duyệt</span></a>
              <a href="<?php echo ('index.php?id=dathang&goods_receipt=true&order_id='.$row['order_id']) ?>" class="btn btn-success" data-toggle="modal"><span>Nhập kho</span></a>
              <a href="<?php echo ('index.php?id=dathang&view_order=true&order_id='.$row['order_id']) ?>" class="btn btn-success" data-toggle="modal"><span>Xem</span></a>
              </td>
            </tr> 
            <?php 
            $show++;
          } ?>
        </tbody>
      </table>
      <div class="clearfix">
        <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
        <ul class="pagination">
          <li class="page-item disabled"><a href="#">Previous</a></li>
          <li class="page-item"><a href="#" class="page-link">1</a></li>
          <li class="page-item"><a href="#" class="page-link">2</a></li>
          <li class="page-item active"><a href="#" class="page-link">3</a></li>
          <li class="page-item"><a href="#" class="page-link">4</a></li>
          <li class="page-item"><a href="#" class="page-link">5</a></li>
          <li class="page-item"><a href="#" class="page-link">Next</a></li>
        </ul>
      </div>
    </div>
  </div>
  
  <?php 
}
?>