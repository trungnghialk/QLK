<div class="container">
  <div class="table-wrapper" style="width: 900px; margin: 80px auto;">
    <div class="table-title">
      <div class="row">
        <div class="modal-header"> 
          <h4 class="modal-title">Tạo phiếu xuất kho</h4>
        </div>
      </div>
    </div>
      <form name="add_name" id="add_name" action="" method="POST">  
        <div class="modal-body">
          <table class="tablec">
            <tr class="tr">
              <td class="tdlabel">Mã phiếu:</td>
              <td class="tdbox"><input class="textbox id" style="text-align: center;" name="goodsissue_id" id="order_id" readonly="readonly" value="<?php echo $_SESSION['goodsissue_id']; ?>"></td>
              <td class="tdlabel">Kho xuất: </td>
              <td class="tdbox"><select class="textbox" name="warehouse_id" id="warehouse_id" required="" onchange="select_material_cat()">
                <option value="<?php if (isset($_SESSION['warehouse_id'])){echo $_SESSION['warehouse_id'];} ?>">
                  <?php 
                  if (isset($_SESSION['warehouse_id'])){
                    $warehouse_id = $_SESSION["warehouse_id"];
                    $sql = "select * from warehouse WHERE warehouse_id = '$warehouse_id'";
                    $result = mysql_query($sql);
                    while ($row = mysql_fetch_array($result)) {
                      echo $row['warehouse_name'] ;
                    }; 
                  }
                  else {echo "Vui lòng chọn";} 
                  ?>
                </option>
                <?php
                $sql = "select * from warehouse";
                $result = mysql_query($sql);
                while ($row = mysql_fetch_array($result)) {
                  ?>
                  <option value="<?php echo $row['warehouse_id']; ?>"><?php echo $row['warehouse_name']; ?></option>
                  <?php } ?>
                </select></td>
                <td class="tdlabel">Ngày xuất:</td>
                <td class="tdbox"><input required="" class="textbox" type="date" name="goodsissue_date" value="<?php echo $_SESSION['goodsissue_date']; ?>" ></td>
              </tr>
               <tr>
                <td style="text-align: center">Nhóm vật tư<br>
                  <select style="width: 150px;" class="txtbox" id="materials_cat_name" name="materials_cat_name" onchange="select_issue_material()">
                    <?php
                    if (isset($_SESSION["warehouse_id"])) {
                      $warehouse_id = $_SESSION["warehouse_id"];
                      $_SESSION["warehouse_id"] = $warehouse_id;
                      $sql = "select DISTINCT materials_cat_name from materials_category as a INNER JOIN materials AS b on a.materials_cat_id = b.materials_cat_id INNER JOIN warehouse_contain as c on b.materials_id = c.materials_id where warehouse_id = '$warehouse_id' ";
                      $result = mysql_query($sql); ?>
                      <option value="">Vui lòng chọn</option>
                      <?php 
                      while ($row = mysql_fetch_array($result)) {
                        ?>
                        <option value="<?php echo $row['materials_cat_name']; ?>"><?php echo $row['materials_cat_name'];?></option>
                        <?php 
                      }
                    } 
                    else {
                      ?>
                      <option value="">Vui lòng chọn</option>
                      <?php } ?>
                    </select>
                    <td style="text-align: center">Tên vật tư<br>
                      <select class="txtbox" style="width: 200px;" id="materials_name" name="materials_name" onchange="select_issue_materialID()"><option value="">Vui lòng chọn</option></select></td>
                      
                      
                      <td style="text-align: center">Mã vật tư<br><div readonly="readonly" id="get_materials_id" name="get_materials_id"><input readonly="readonly" style="width: 100px" class="txtbox" type="text" name="materials_id"></div></td>
                      <td style="text-align: center">ĐVT<br><div id="get_materials_unit" name="get_materials_unit"><input readonly="readonly" type="text" style="width: 70px;" class="txtbox" name="materials_unit"></div></td>
                    </tr>
                </table>
                <table class="table table-striped table-hover">
                  <tdead>
                   <tr>
                    <td>Mã vật tư</td>
                    <td>Tên vật tư</td>
                    <td>Số lượng</td>
                    <td>Đơn vị tính</td>
                    <td>Nhóm vật tư</td>
                    <td>Tồn kho</td>
                  </tr>
                </thead>
                <tbody>
         
                </tbody>
              </table>         
              <div class="modal-footer">
                <input type="submit" name="checkout" id="checkout" class="btn btn-success" value="Xuất kho" />  
                <a href="index.php?id=xuatkho&view=true"><input type="button" class="btn btn-default" data-dismiss="modal" value="Hủy"></a>
              </div>
            </form>
          </div>
        </div>
        <!-- Edit Modal HTML -->
        <script src="js/custom.js"></script>}
