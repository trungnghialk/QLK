<div class="container">
  <div class="table-wrapper">
    <div class="table-title">
      <div class="row">
        <div class="col-sm-6">
          <h2><b>DANH SÁCH PHIẾU CHUYỂN</b></h2>
        </div>
        <div class="col-sm-6">
          <?php 
          $create_button = 0;
          include ("modules/permission/transfer.php");
          ?>
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
      $sql = "SELECT approve, goodstransfer_id, b.warehouse_name as warehouse_name_out, warehouse_id_send, warehouse_id_receive, c.warehouse_name as warehouse_name_in, goodstransfer_send_date, goodstransfer_receive_date, goodstransfer_status FROM goods_transfer as a INNER JOIN warehouse as b ON a.warehouse_id_send = b.warehouse_id INNER JOIN warehouse as c ON a.warehouse_id_receive = c.warehouse_id";
      $result = mysql_query($sql);
      while ($row = mysql_fetch_array($result)) {
        $_SESSION['goodstransfer_id'.$show] = $row['goodstransfer_id']; 
        ?>
        <tr>
          <td><?php echo $row['goodstransfer_id'] ?></td>
          <td><?php echo $row['warehouse_name_out'] ?></td>
          <td><?php echo $row['warehouse_name_in'] ?></td>
          <td><?php echo date('d/m/Y',time($row['goodstransfer_send_date'])) ?></td>
          <td><?php echo $row['goodstransfer_receive_date'] ?></td>
          <td><?php echo $row['goodstransfer_status'] ?></td>   
          <td style="width: 150px;">
            <?php include("modules/permission/transfer.php"); ?>
            <br>
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