<?php 
for ($i=1; $i < isset($_SESSION["warehouse_count"]) ; $i++) { 
	if ($create_button == 0 && $_SESSION["permit_id".$i] == 3){
		$create_button = 1;
		echo ("<a href='index.php?id=dathang&new=true' class='btn btn-success' data-toggle='modal'><i class='material-icons'>&#xE147;</i> <span>Tạo phiếu đặt hàng</span></a>");
		break;
	}

	elseif ($_SESSION["permit_warehouse".$i] == $row["warehouse_id"]) { 
		if($_SESSION["permit_id".$i] == 1 && $row["approve"] == "pass"){
			echo ("<a href='index.php?id=dathang&view_order=true&order_id=".$row['order_id']."' class='btn btn-success' data-toggle='modal'><span>Xem</span></a>");
		}
		if($_SESSION["permit_id".$i] == 2 && $row["approve"] == "pass"){
			echo ("<a href='index.php?id=dathang&view_order=true&order_id=".$row['order_id']."' class='btn btn-success' data-toggle='modal'><span>Xem</span></a>");
			if ($status != "<div class='label label-success'>ĐÃ NHẬP ĐỦ</div>") {
			echo ("<a href='index.php?id=dathang&goods_receipt=true&order_id=".$row['order_id']."' class='btn btn-success' data-toggle='modal'><span>Nhập kho</span></a>");
		}
		}
		if($_SESSION["permit_id".$i] == 3){
			if($row["approve"] == "pass" ){
				echo ("<a href='index.php?id=dathang&view_order=true&order_id=".$row['order_id']."' class='btn btn-success' data-toggle='modal'><span>Xem</span></a>");
			}

			else {
				echo ("<a href='index.php?id=dathang&edit=true&order_id=".$row['order_id']."' class='btn btn-warning' data-toggle='modal'><span>Sửa</span></a>");
				echo ("<a href='modules/order/order_del.php?order_id=".$_SESSION['order_id'.$show]."' class='btn btn-danger' data-toggle='modal'><span>Xóa</span></a>");
			}
		}
		if($_SESSION["permit_id".$i] == 4){
			if($row["approve"] == "pass" ){
				echo ("<a href='index.php?id=dathang&view_order=true&order_id=".$row['order_id']."' class='btn btn-success' data-toggle='modal'><span>Xem</span></a>");
			}
			else {
				echo ("<a href='index.php?id=dathang&approve=true&order_id=".$row['order_id']."' class='btn btn-warning' data-toggle='modal'><span>Duyệt</span></a>");	
			}
		}
	}
}

?>