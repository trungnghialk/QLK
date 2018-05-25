<?php 
for ($i=1; $i < $_SESSION["warehouse_count"] ; $i++) { 
	if ($_SESSION["permit_id".$i] == 2){
		echo ("<a href='index.php?id=xuatkho&new=true' class='btn btn-success' data-toggle='modal'><i class='material-icons'>&#xE147;</i> <span>Tạo phiếu xuất kho</span></a>");
		break;
	}
}
?>