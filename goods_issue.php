<?php
if (isset($_GET['goods_issue']) == "true") {
 include ("/modules/goods_issue/goods_issue_view.php") ;
  }
if(isset($_GET['view_item']) == "true") {
 include ("modules/goods_issue/goods_issue_view.php") ;
}
if(isset($_GET['new']) == "true") {
 include ("modules/goods_issue/goods_issue_new.php") ;
}
if (isset($_GET['view']) == "true") {
  ?>

  <div class="container">
    <div class="table-wrapper">
      <div class="table-title">
        <div class="row">
          <div class="col-sm-6">
            <h2><b>DANH SÁCH PHIẾU XUẤT KHO</b></h2>
          </div>
          <div class="col-sm-6">
            <a href="index.php?id=xuatkho&new=true" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Tạo phiếu xuất kho</span></a>            
          </div>
        </div>
      </div>
      <table class="table table-striped table-hover">
        <thead>
         <tr>
          <th style="width: 120px;">Mã phiếu xuất</th>
          <th>Ngày xuất</th>
          <th>Nhân viên</th>
          <th>Kho hàng</th>
          <th>Ghi chú</th>
          <th>Tính năng</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $show = 1;
        $sql = "SELECT * FROM goods_issue INNER JOIN warehouse ON goods_issue.warehouse_id = warehouse.warehouse_id";
        $result = mysql_query($sql);
        while ($row = mysql_fetch_array($result)) {
          $_SESSION['goodsissue_id'.$show] = $row['goodsissue_id']; 
          ?>
          <tr>
            <td><?php echo $row['goodsissue_id'] ?></td>
            <td><?php echo $row['goodsissue_date'] ?></td>
            <td><?php echo $row['goodsissue_user'] ?></td>
            <td><?php echo $row['warehouse_name'] ?></td>
            <td><?php echo $row['goodsissue_note'] ?></td>
            <td style="width: 150px;">
              <a href="<?php echo ('index.php?id=xuatkho&view_item=true&goodsissue_id='.$row['goodsissue_id']) ?>" class="btn btn-success" data-toggle="modal"><span>Xem</span></a>
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