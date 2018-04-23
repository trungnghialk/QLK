<div class="container">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                <h2><b>DANH SÁCH NHÀ CUNG CẤP</b></h2>
            </div>
          <div class="col-sm-6">
            <a href="#addmaterials" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Thêm Nhà Cung cấp</span></a>
        </div>
    </div>
    <table class="table table-striped table-hover">
        <thead>
           <tr>
            <th></th>
            <th>Tên Nhà Cung cấp</th>
            <th>Địa chỉ</th>
            <th>Điện thoại</th>
            <th>Mã số thuế</th>
            </tr>
        </thead>
        <tbody>
          <?php 
            $sql = "select * from supplier";
            $result = mysql_query($sql);
            while ($row = mysql_fetch_array($result)) {
          ?>
            <tr>
                <td></td>
                <td><?php echo $row['supplier_name'] ?></td>
                <td><?php echo $row['supplier_addr'] ?></td>
                <td><?php echo $row['supplier_mobile'] ?></td>
                <td><?php echo $row['supplier_taxcode'] ?></td>
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
<!--End phan trang -->
<!--Begin Them vat tu -->
<div id="addmaterials" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" method="POST">
        <?php
        include ("connect.php");
          if(isset($_POST['supplier_name'])){
            $supplier_name = $_POST['supplier_name'];
            $supplier_mobile = $_POST['supplier_mobile'];
            $supplier_taxcode = $_POST['supplier_taxcode'];
            $supplier_addr = $_POST['supplier_addr'];
            $sql = "INSERT INTO supplier (supplier_name, supplier_mobile, supplier_taxcode, supplier_addr) values ('$supplier_name', '$supplier_mobile', '$supplier_taxcode','$supplier_addr')";
            mysql_query($sql);
            echo "<meta http-equiv='refresh' content='0'>";
        }
        ?>
         <div class="modal-header">            
           <h4 class="modal-title">Thêm Nhà cung cấp</h4>
         </div>
            <div class="modal-body">
              <div class="lfield">Tên Nhà Cung cấp: &nbsp  &nbsp <input type="text" name="supplier_name" style="width: 710px;" required=""></div>
              <div class="lfield">Số điện thoại: &nbsp  &nbsp <input type="text" name="supplier_mobile" style="width: 300px;" required=""></div>
              <div class="lfield">Mã số thuế: &nbsp  &nbsp <input type="text" name="supplier_taxcode" style="width: 290px;" required=""></div>
              <div class="lfield">Địa chỉ:  &nbsp &nbsp &nbsp <textarea name="supplier_addr" style="width: 780px;"></textarea></div>
              <div class="clear"></div>
              <br><br>
            </div>
           <div class="modal-footer">
             <input type="submit" class="btn btn-default" value="Đồng ý">
              <input type="button" class="btn btn-default" data-dismiss="modal" value="Hủy" data-dismiss="modal" aria-hidden="true">
            </div>
      </form>
    </div>
  </div>
</div>
<!-- End them vat tu -->
<script src="js/custom.js"></script>