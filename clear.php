<?php 
// Clear phiếu đặt hàng
unset($_SESSION["item_new"]);
unset($_SESSION["materials_id".$i]);
unset($_SESSION["materials_name".$i]);
unset($_SESSION["supplier_id"]);
unset($_SESSION["supplier_name"]);
unset($_SESSION["materials_cat_name".$i]);
unset($_SESSION["materialscount_in".$i]);
unset($_SESSION["materials_unit".$i]);
unset($_SESSION['order_id']);
unset($_SESSION['count_order']);
unset($_SESSION['warehouse_id']);
unset($_SESSION['warehouse_name']);
unset($_SESSION["order_accept_date"]);
// unset($_SESSION['materialscount'.$i])



?>