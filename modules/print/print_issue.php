<!DOCTYPE html>
<html>
<head>
	<title>PHIẾU XUẤT KHO</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body">
	<div class="wrapper">
		<div class="banner">
			<table style="width: 100%;">
				<tr>
					<td style="width: 20%;"><img style="width: 80px;" src="logo.png"></td>
					<td style="width: 50%;"><h3>PHIẾU XUẤT KHO</h3></td>
					<td style="width: 30%; text-align: left; font-size: 16px; padding: 15px;">Mã số: BĐS/QT-03.MH /M04 <br>Hiệu lực: 31/05/2017</td>
				</tr>
			</table>
		</div>
		<div class="clear"></div><br>
		<?php include ("../../connect.php");
		$goodsissue_id = $_GET["goodsissue_id"];
		$sql = "SELECT * FROM goods_issue inner join warehouse on goods_issue.warehouse_id = warehouse.warehouse_id WHERE goodsissue_id = '$goodsissue_id'";
		$result = mysql_query($sql);
		$row = mysql_fetch_assoc($result);
		if($row != null){
			$day = date('d', time($row["goodsissue_date"]));
			$month = date('m', time($row["goodsissue_date"]));
			$year = date('Y', time($row["goodsissue_date"]));
			?>
			<div class="row">Công trình: <b><?php echo $row["warehouse_name"] ?></b></div>
			<div class="row">Số: <b><?php echo $row["goodsissue_id"]; ?></b> </div>	<br>
			<div class="row">Đối tượng xuất: <input style="margin-left: 50px" type="checkbox" checked="checked"> Vật tư <input style="margin-left: 50px" type="checkbox"> Máy móc thiết bị <input style="margin-left: 50px" type="checkbox"> Công cụ dụng cụ  </div>
			<div class="row">Người nhận hàng: .............................................................................................................................................</div>	
			<div class="row">Theo yêu cầu Số: ..............................................................................................................................................</div>	
			<div class="row">Lý do xuất: <b><?php echo $row["goodsissue_note"] ?></b></div>	
			<div class="row">Xuất tại kho: <b><?php echo $row["warehouse_name"] ?> </b> &emsp; &emsp; Địa điểm: <b><?php echo $row["warehouse_adr"] ?></b>
			</div>	
			<div class="row"><br>
				<?php } ?>
				<table>
					<tr style="font-weight:bold; text-align: center">
						<td rowspan="2" style=" width: 5%">Số TT</td>
						<td rowspan="2" style=" width: 32%">Tên vật tư, hàng hóa xuất ra</td>
						<td rowspan="2" style=" width: 10%">Mã số</td>
						<td rowspan="2" style=" width: 5%">ĐVT</td>
						<td colspan="2" style=" width: 20%">Số lượng xuất</td>
						<td rowspan="2" style=" width: 8%">Đơn giá</td>
						<td rowspan="2" style=" width: 10%">Thành tiền</td>
						<td rowspan="2" style=" width: 10%">Nơi nhận</td>
					</tr>
					<tr style="font-weight:bold; text-align: center">
						<td>Yêu cầu</td>
						<td>Thực tế</td>
					</tr>
					<?php 
					$sql = "SELECT * FROM goods_issue_contain inner join materials on goods_issue_contain.materials_id = materials.materials_id WHERE goodsissue_id = '$goodsissue_id'";
					$result = mysql_query($sql);
					$sort = 1;
					while ( $row = mysql_fetch_array($result)) { ?>
					<tr>
						<td><?php echo $sort ?></td>
						<td style="text-align: left; padding-left: 15px;"><?php echo $row["materials_name"] ?></td>
						<td> <?php echo $row["materials_id"] ?></td>
						<td><?php echo $row["materials_unit"] ?></td>
						<td></td>
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