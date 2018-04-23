<div class="container">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                <h2><b>DANH SÁCH KHO CÔNG TRÌNH</b></h2>
            </div>
          <div class="col-sm-6">
            <a href="#addmaterials" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Thêm Kho</span></a>
        </div>
    </div>
    <table class="table table-striped table-hover">
        <thead>
           <tr>
            <th></th>
            <th>Tên kho</th>
            <th>Thủ kho</th>
            <th>Địa chỉ</th>
            <th>Liên hệ</th>
            </tr>
        </thead>
        <tbody>
          <?php 
            $sql = "select * from warehouse inner join users on warehouse.username = users.username";
            $result = mysql_query($sql);
            while ($row = mysql_fetch_array($result)) {
          ?>
            <tr>
                <td></td>
                <td><?php echo $row['warehouse_name'] ?></td>
                <td><?php echo $row['hovaten'] ?></td>
                <td><?php echo $row['warehouse_adr'] ?></td>
                <td><?php echo $row['sdt'] ?></td>
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
          if(isset($_POST['materials_get_id'])){
            $materials_id = $_POST['materials_get_id'];
            $materials_name = $_POST['materials_name'];
            $materials_unit = $_POST['materials_unit'];
            $materials_price = $_POST['materials_price'];
            $materials_discount_rate = $_POST['materials_discount_rate'];
            $materials_discounted =0;
            $materials_note = $_POST['materials_note'];
            $materials_amount = 0;
            $materials_cat_id = substr($_POST['materials_get_id'],0,5);
            $sql = "INSERT INTO materials (materials_id, materials_name, materials_unit, materials_price, materials_discount_rate, materials_discounted,materials_note, materials_amount, materials_cat_id) VALUES ('$materials_id', '$materials_name', '$materials_unit', '$materials_price', '$materials_discount_rate', '$materials_discounted', '$materials_note', '$materials_amount', '$materials_cat_id')";
            mysql_query($sql);
            $sql = "select materials_cat_count from materials_category where materials_cat_id = '$materials_cat_id'";
            $result = mysql_query($sql);
            while ($row = mysql_fetch_array($result)) {
              $count = $row['materials_cat_count']+1;
            }
            $sql = "UPDATE materials_category SET materials_cat_count = '$count' WHERE materials_cat_id = '$materials_cat_id'";  
            mysql_query($sql);
            echo "<meta http-equiv='refresh' content='0'>";
            
        }
        ?>
         <div class="modal-header">            
           <h4 class="modal-title">Tạo kho mới</h4>
         </div>
            <div class="modal-body">
              <div class="lfield">Chọn thủ kho:
                <select id="materials_get_id" name="materials_get_id" onchange="combobox_load_materialsID()">
                  <option>Vui lòng chọn</option>
                  <?php
                    $sql = "select * from users";
                    $result = mysql_query($sql);
                    while ($row = mysql_fetch_array($result)) {
                  ?>
                  <option value="<?php echo $row['username'] ; ?>"><?php echo $row['hovaten']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="lfield">Tên kho: &nbsp  &nbsp <input type="text" name="materials_name" style="width: 780px;" required=""></div>
              <div class="lfield">Địa chỉ:  &nbsp &nbsp &nbsp <textarea name="materials_note" style="width: 780px;"></textarea></div>
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