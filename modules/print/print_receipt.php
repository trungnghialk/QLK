<!DOCTYPE html>
<html>
<head>
	<title>PHIẾU PHẬP KHO</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="wrapper">
		<div class="banner">
			<table style="width: 100%;">
				<tr>
					<td style="width: 20%;"><img style="width: 80px;" src="logo.png"></td>
					<td style="width: 50%;"><h3>PHIẾU NHẬP KHO</h3></td>
					<td style="width: 30%; text-align: left; font-size: 16px; padding: 15px;">Mã số: BĐS/QT-03.MH /M01<br>Hiệu lực: 31/05/2017</td>
				</tr>
			</table>
		</div>
		<div class="clear"></div><br>
		<?php include ("../../connect.php");
		$goodsreceipt_id = $_GET["goodsreceipt_id"];
		$sql = "SELECT * FROM goods_receipt inner join warehouse on goods_receipt.warehouse_id = warehouse.warehouse_id INNER JOIN orders on goods_receipt.order_id =orders.order_id WHERE goodsreceipt_id = '$goodsreceipt_id'";
		$result = mysql_query($sql);
		$row = mysql_fetch_assoc($result);
		if($row != null){
			$day = date('d', time($row["goodsreceipt_date"]));
			$month = date('m', time($row["goodsreceipt_date"]));
			$year = date('Y', time($row["goodsreceipt_date"]));
			$order_id = $row["order_id"];
			?>
			<div class="row">Công trình: <b><?php echo $row["warehouse_name"] ?></b></div>
			<div class="row">Số: <b><?php echo $row["goodsreceipt_id"] ?></b> </div><br>
			<div class="row">Đối tượng xuất: <input style="margin-left: 50px" type="checkbox" checked="checked"> Vật tư <input style="margin-left: 50px" type="checkbox"> Máy móc thiết bị <input style="margin-left: 50px" type="checkbox"> Công cụ dụng cụ  </div>
			<div class="row">Nhập của:  &emsp;&emsp;Theo: <b>Phiếu Đặt hàng</b> &emsp;&emsp;Số: <b><?php echo $row["order_id"] ?></b>&emsp;&emsp;Ngày: <b><?php echo date('d/m/Y',time($row["order_date"])) ?></b></div>	
			<div class="row">Cho công việc: .....................................................................................................................................................</div>	
			<div class="row">Nhập vào kho: <b><?php echo $row["warehouse_name"] ?></b>&emsp;&emsp; Địa điểm: <b><?php echo $row["warehouse_adr"] ?></b></div>	
			<div class="row"><br>
				<?php } ?>
				<table>
					<tr style="font-weight:bold; text-align: center">
						<td rowspan="2" style=" width: 5%">Số TT</td>
						<td rowspan="2" style=" width: 30%">Tên vật tư, hàng hóa nhập kho</td>
						<td rowspan="2" style=" width: 10%">Mã số</td>
						<td rowspan="2" style=" width: 5%">ĐVT</td>
						<td colspan="2" style=" width: 22%">Số lượng</td>
						<td rowspan="2" style=" width: 8%">Đơn giá</td>
						<td rowspan="2" style=" width: 10%">Thành tiền</td>
						<td rowspan="2" style=" width: 10%">Nơi nhận</td>
					</tr>
					<tr style="font-weight:bold; text-align: center">
						<td>Theo C.từ</td>
						<td>Thực nhập</td>
					</tr>
					<?php 
					$sql = "SELECT * FROM goods_receipt_contain inner join materials on goods_receipt_contain.materials_id = materials.materials_id WHERE goodsreceipt_id = '$goodsreceipt_id'";
					$result = mysql_query($sql);
					$sort = 1;
					while ( $row = mysql_fetch_array($result)) { ?>
					<tr>
						<td><?php echo $sort ?></td>
						<td style=" text-align: left; padding-left: 10px;"><?php echo $row["materials_name"] ?></td>
						<td><?php echo $row["materials_id"] ?></td>
						<td><?php echo $row["materials_unit"] ?></td>
						<td>
							<?php
							$sql1 = "SELECT * FROM orders_contain WHERE order_id = '$order_id'";
							$result1 = mysql_query($sql1);
							while ($row1 = mysql_fetch_array($result1)) {
								if ($row1["materials_id"] == $row["materials_id"]) {
									echo $row1["materialscount_in"];
								}
							}
							?>
						</td>
						<td><?php echo $row["materialscount"] ?></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<?php
					$sort++ ;
				} 
				if ($sort < 10){
					for ($i=$sort; $i <= 10 ; $i++) { 
						echo"<tr><td>".$i."</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
					}
				}
				?>
				<tr style="font-weight:bold; text-align: center">
					<td></td><td>TỔNG CỘNG</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
				</table>
			</div>	
			<div class="row">Tổng số tiền bằng chữ: .....................................................................................................................................</div>	
			<div class="row">Số chứn từ gốc kèm theo: .................................................................................................................................</div><br>
			<div class="row" style="text-align: right">TP.HCM, Ngày <?php echo $day; ?> tháng <?php echo $month; ?> năm <?php echo $year; ?></div>
			<div class="row" style="font-weight:bold">
				<div style="width: 50%; text-align: center; float: left;">CHỈ HUY TRƯỞNG/TRƯỞNG ĐƠN VỊ</div>
				<div style="width: 25%; text-align: center; float: left;">THỦ KHO</div>
				<div style="width: 25%; text-align: center; float: left;">NGƯỜI NHẬN</div>
				<div class="clear"></div><br>
			</div>	
			<div style="margin-bottom: 100px;"></div>
			<div class="control-group" style="width: 749px">
				<a href="#" onclick = "window.print()">IN PHIẾU</a>
				<a href="javascript:history.go(-1)">QUAY LẠI</a>
			</div>
			<div style="margin-bottom: 50px;"></div>
		</div>
	</body>
	</html>