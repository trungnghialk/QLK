<?php
if (isset($_GET['approve']) == "true") {
  include ("/modules/goods_transfer/goods_transfer_approve.php");
}
if (isset($_GET['edit']) == "true") {
  include ("/modules/goods_transfer/goods_transfer_edit.php");
}
if (isset($_GET['send']) == "true") {
  include ("/modules/goods_transfer/goods_transfer_send.php");
}
if (isset($_GET['receive']) == "true") {
  include ("/modules/goods_transfer/goods_transfer_receive.php");
}
if (isset($_GET['goods_transfer']) == "true") {
 include ("/modules/goods_transfer/goods_transfer_view.php") ;
  }
if(isset($_GET['view_item']) == "true") {
 include ("modules/order/order_view.php") ;
}
if(isset($_GET['new']) == "true") {
 include ("modules/goods_transfer/goods_transfer_new.php") ;
}
if (isset($_GET['view']) == "true") {
  ?>

  <div class="container">
    <div class="table-wrapper">
      <div class="table-title">
        <div class="row">
          <div class="col-sm-6">
            <h2><b>DANH SÁCH PHIẾU CHUYỂN</b></h2>
          </div>
          <div class="col-sm-6">
            <a href="index.php?id=chuyenkho&new=true" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Tạo phiếu chuyển kho</span></a>            
          </div>
        </div>
      </div>
      <table class="table table-striped table-hover">
        <thead>
         <tr>
          <th style="width: 120px;">Mã phiếu chuyển</th>
          <th>Kho xuất</th>
          <th>Kho nhận</th>
          <th>Ngày xuất dự kiến</th>
          <th>Ngày nhận dự kiến</th>
          <th>Trạng thái</th>
          <th>Tính năng</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $show = 1;
        $sql = "SELECT goodstransfer_id, b.warehouse_name as warehouse_name_out, c.warehouse_name as warehouse_name_in, goodstransfer_send_date, goodstransfer_receive_date, goodstransfer_status FROM goods_transfer as a INNER JOIN warehouse as b ON a.warehouse_id_send = b.warehouse_id INNER JOIN warehouse as c ON a.warehouse_id_receive = c.warehouse_id";
        $result = mysql_query($sql);
        while ($row = mysql_fetch_array($result)) {
          $_SESSION['goodstransfer_id'.$show] = $row['goodstransfer_id']; 
          ?>
          <tr>
            <td><?php echo $row['goodstransfer_id'] ?></td>
            <td><?php echo $row['warehouse_name_out'] ?></td>
            <td><?php echo $row['warehouse_name_in'] ?></td>
            <td><?php echo $row['goodstransfer_send_date'] ?></td>
            <td><?php echo $row['goodstransfer_receive_date'] ?></td>
            <td><?php echo $row['goodstransfer_status'] ?></td>
            <td style="width: 150px;">
              <a href="<?php echo ('index.php?id=chuyenkho&goods_transfer=true&goodstransfer_id='.$row['goodstransfer_id']) ?>" class="btn btn-success" data-toggle="modal"><span>Xem</span></a>
              <a href="<?php echo ('index.php?id=chuyenkho&approve=true&goodstransfer_id='.$row['goodstransfer_id']) ?>" class="btn btn-success" data-toggle="modal"><span>Duyệt</span></a>
              <a href="<?php echo ('modules/goods_transfer/goods_transfer_del.php?goodstransfer_id='.$_SESSION['goodstransfer_id'.$show]); ?>" class="btn btn-danger" data-toggle="modal"><span>Xóa</span></a>
              <a href="<?php echo ('index.php?id=chuyenkho&edit=true&goodstransfer_id='.$row['goodstransfer_id']) ?>" class="btn btn-success" data-toggle="modal"><span>Sửa</span></a>
              <a href="<?php echo ('index.php?id=chuyenkho&send=true&goodstransfer_id='.$row['goodstransfer_id']) ?>" class="btn btn-success" data-toggle="modal"><span>Xuất kho</span></a>
              <a href="<?php echo ('index.php?id=chuyenkho&receive=true&goodstransfer_id='.$row['goodstransfer_id']) ?>" class="btn btn-success" data-toggle="modal"><span>Nhập kho</span></a>

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