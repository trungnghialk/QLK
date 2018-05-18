<div class="container">
  <div class="table-wrapper">
    <div class="table-title">
      <div class="row">
        <div class="col-sm-6">
          <h2><b>DANH SÁCH PHIẾU NHẬP KHO</b></h2>
        </div>
      </div>
    </div>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th style="width: 120px;">Mã phiếu nhập</th>
          <th style="text-align: center;">Đơn hàng &<br>Phiếu chuyển</th>
          <th>Kho hàng</th>
          <th>Ngày nhập kho</th>
          <th>Người lập phiếu</th>
          <th>Loại phiếu</th>
          <th>Tính năng</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * from goods_receipt inner join warehouse on goods_receipt.warehouse_id = warehouse.warehouse_id";
        $result = mysql_query($sql);
        while ($row = mysql_fetch_array($result)) {
         ?>
         <tr>
          <td><?php echo $row["goodsreceipt_id"]; ?></td>
          <td><?php echo $row["order_id"]; ?></td>
          <td><?php echo $row["warehouse_name"] ?></td>
          <td><?php echo $row["goodsreceipt_date"] ?></td>
          <td><?php echo $row["goodsreceipt_user"] ?></td>
          <td><?php echo $row["goodsreceipt_type"] ?></td>
          <td>
            <a href="<?php echo ('index.php?id=nhapkho&goods_receipt=true&goodsreceipt_id='.$row['goodsreceipt_id']) ?>" class="btn btn-success" data-toggle="modal"><span>Xem</span></a>
          </td>
        </tr>
        <?php } ?>
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
</div>
</div>