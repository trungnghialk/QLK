<?php 

?>




<?php 
if($row['approve'] == "pass"){ 
	?>
<a href="<?php echo ('index.php?id=dathang&view_order=true&order_id='.$row['order_id']) ?>" class="btn btn-success" data-toggle="modal"><span>Xem</span></a>

<a href="<?php echo ('index.php?id=dathang&goods_receipt=true&order_id='.$row['order_id']) ?>" class="btn btn-success" data-toggle="modal"><span>Nhập kho</span></a>
<?php }
if ($row['approve'] == "wait") { ?>
<a href="<?php echo ('index.php?id=dathang&edit=true&order_id='.$row['order_id']) ?>" class="btn btn-warning" data-toggle="modal"><span>Sửa</span></a>
<a href="<?php echo ('modules/order/order_del.php?order_id='.$_SESSION['order_id'.$show]); ?>" class="btn btn-danger" data-toggle="modal"><span>Xóa</span></a>
<a href="<?php echo ('index.php?id=dathang&approve=true&order_id='.$row['order_id']) ?>" class="btn btn-success" data-toggle="modal"><span>Duyệt</span></a>
<?php }
?>



