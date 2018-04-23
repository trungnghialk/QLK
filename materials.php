<div class="container">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
		            <h2><b>DANH SÁCH VẬT TƯ</b></h2>
      			</div>
      		<div class="col-sm-6">
        		<a href="#addmaterials" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Thêm Vật tư</span></a>
            	<a href="#addmaterials_cat" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Thêm nhóm vật tư</span></a>
        </div>
    </div>
    <table class="table table-striped table-hover">
        <thead>
           <tr>
        		<th>Mã Vật tư</th>
        		<th>Tên Vật tư</th>
				<th>Đơn vị tính</th>
        		<th>Nhóm hàng</th>
        		<th>Số lượng tồn</th>
        		<th>Tính năng</th>
            </tr>
        </thead>
        <tbody>
          <?php 
            $sql = "select * from materials inner join materials_category on materials.materials_cat_id = materials_category.materials_cat_id";
            $result = mysql_query($sql);
            while ($row = mysql_fetch_array($result)) {
          ?>
            <tr>
                <td><?php echo $row['materials_id'] ?></td>
                <td><?php echo $row['materials_name'] ?></td>
                <td><?php echo $row['materials_unit'] ?></td>
                <td><?php echo $row['materials_cat_name'] ?></td>
                <td><?php echo $row['materials_amount'] ?></td>
                <td>
                  <a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                  <a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
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
           <h4 class="modal-title">Tạo Vật tư mới</h4>
         </div>
            <div class="modal-body">
              <div class="lfield">Nhóm vật tư:
                <select id="materials_get_id" name="materials_get_id" onchange="combobox_load_materialsID()">
                  <option>Vui lòng chọn</option>
                  <?php
                    $sql = "select * from materials_category";
                    $result = mysql_query($sql);
                    while ($row = mysql_fetch_array($result)) {
                      $getmaterials_id = $row['materials_cat_count'] + 1001;
                  ?>
                  <option value="<?php echo $row['materials_cat_id'].$getmaterials_id ; ?>"><?php echo $row['materials_cat_name']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="rfield">Mã vật tư: <label name="materials_id" id="materials_id"></label></div>
              <div class="lfield">Tên vật tư:&nbsp &nbsp <input type="text" name="materials_name" style="width: 780px;" required=""></div>
              <div class="lfield">Đơn vị tính: &nbsp <input type="text" name="materials_unit" required=""></div>
              <div class="lfield">Giá: <input type="text" name="materials_price"></div>
              <div class="lfield">Tỉ lệ chiết khấu: <input type="text" name="materials_discount_rate"></div>
              <div class="lfield">Ghi chú:  &nbsp &nbsp &nbsp <textarea name="materials_note" style="width: 780px;"></textarea></div>
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
<!--Begin Them nhom vat tu -->
<div id="addmaterials_cat" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" method="POST">
        <?php
          if(isset($_POST['materials_cat_id']) && isset($_POST['materials_cat_name'])){
            $materials_cat_id = $_POST['materials_cat_id'];
            $materials_cat_name = $_POST['materials_cat_name'];
            $sql = "INSERT INTO materials_category (materials_cat_id, materials_cat_name) VALUES ('$materials_cat_id', '$materials_cat_name')";
            mysql_query($sql);
            unset($materials_cat_id);
            unset($materials_cat_name);
        }
        ?>
         <div class="modal-header">            
            <h4 class="modal-title">Tạo nhóm vật tư mới</h4>
          </div>
          <div class="modal-body">            
            <div class="lfield">Mã Nhóm vật tư: <input style="width: 100px;" type="text" name="materials_cat_id" value="" required=""></div>
            <div class="lfield">Tên Nhóm vật tư: <input style="width: 300px;" type="text" name="materials_cat_name" value="" required=""></div>
            <input type="submit" class="btn btn-default" value="Tạo mới">
            <div class="clear"></div>
            <br>
          </div>
          <div>
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>Mã nhóm</th>
                  <th>Tên nhóm</th>
                <tr>
              </thead>
              <?php 
                $sql = "select * from materials_category order by materials_cat_id DESC";
                $result = mysql_query($sql);
                while ($row = mysql_fetch_array($result)) {
              ?>
              <tr>
                <td><?php echo $row['materials_cat_id'];?></td>
                <td><?php echo $row['materials_cat_name'];?></td>
              </tr>
              <?php } ?>
            </table>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" value="Đóng" data-dismiss="modal" aria-hidden="true">
          </div>
      </form>
    </div>
  </div>
</div>
<!-- End them nhom vat tu -->
<script src="js/custom.js"></script>