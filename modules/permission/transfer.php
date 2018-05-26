<?php 
for ($i=1; $i < isset($_SESSION["warehouse_count"]) ; $i++) { 
	if ($create_button == 0 && $_SESSION["permit_id".$i] == 3){
		$create_button = 1;
		echo ('<a href="index.php?id=chuyenkho&new=true" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Tạo phiếu chuyển kho</span></a>');
		break;
	}
	elseif ($_SESSION["permit_warehouse".$i] == $row["warehouse_id_send"] || $_SESSION["permit_warehouse".$i] == $row["warehouse_id_receive"]) {
		$gstransfer_id = $row["goodstransfer_id"];
		$sql1 = "SELECT * FROM goods_transfer_contain WHERE goodstransfer_id = '$gstransfer_id' ";
		$result1 = mysql_query($sql1);
		$send = 0;
		$receive = 0;
		while ($row1 = mysql_fetch_array($result1)) {
			if ($row1["materialscount"] > $row1["materialscount_out"] && $send == 0){
				$send = 1;
			}
			if ($row1["materialscount_out"] > $row1["materialscount_in"] && $receive == 0){
				$receive = 1;
			}
		}
		if($_SESSION["permit_id".$i] == 1 && $row["approve"] == "pass"){
			echo ("<a href='index.php?id=chuyenkho&goods_transfer=true&goodstransfer_id=".$row['goodstransfer_id']."' class='btn btn-success' data-toggle='modal'><span>Xem</span></a>");
		}
		if($_SESSION["permit_id".$i] == 2 && $row["approve"] == "pass"){
			echo ("<a href='index.php?id=chuyenkho&goods_transfer=true&goodstransfer_id=".$row['goodstransfer_id']."' class='btn btn-success' data-toggle='modal'><span>Xem</span></a>");
			if ($send == 1 && $_SESSION["permit_warehouse".$i] == $row["warehouse_id_send"]	) {
				echo ("<a href='index.php?id=chuyenkho&send=true&goodstransfer_id=".$row['goodstransfer_id']."' class='btn btn-success' data-toggle='modal'><span>Xuất kho</span></a>");
				$send = 0;
			}
			if ($receive == 1 && $_SESSION["permit_warehouse".$i] == $row["warehouse_id_receive"]) {
				echo ("<a href='index.php?id=chuyenkho&receive=true&goodstransfer_id=".$row['goodstransfer_id']."' class='btn btn-success' data-toggle='modal'><span>Nhập kho</span></a>");
				$receive = 0;
			}
		}
		if($_SESSION["permit_id".$i] == 3){
			if($row["approve"] == "pass" ){
				echo ("<a href='index.php?id=chuyenkho&goods_transfer=true&goodstransfer_id=".$row['goodstransfer_id']."' class='btn btn-success' data-toggle='modal'><span>Xem</span></a>");
			}
			else {
				echo ("<a href='index.php?id=chuyenkho&edit=true&goodstransfer_id=".$row['goodstransfer_id']."' class='btn btn-warning' data-toggle='modal'><span>Sửa</span></a>");
				echo ("<a href='modules/goods_transfer/goods_transfer_del.php?goodstransfer_id=".$_SESSION['goodstransfer_id'.$show]."' class='btn btn-danger' data-toggle='modal'><span>Xóa</span></a>");
			}
		}
		if($_SESSION["permit_id".$i] == 4){
			if($row["approve"] == "pass" ){
				echo ("<a href='index.php?id=chuyenkho&goods_transfer=true&goodstransfer_id=".$row['goodstransfer_id']."' class='btn btn-success' data-toggle='modal'><span>Xem</span></a>");
			}
			else {
				echo ("<a href='index.php?id=chuyenkho&approve=true&goodstransfer_id=".$row['goodstransfer_id']."' class='btn btn-success' data-toggle='modal'><span>Duyệt</span></a>");	
			}
		}
	}
}


?>