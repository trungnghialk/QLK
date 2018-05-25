<!DOCTYPE html>
<html>
<head>
	<title>THẺ KHO</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php include ("../../connect.php"); ?>
	<div class="wrapper">
		<div class="banner">
			<table style="width: 100%;">
				<tr>
					<td style="width: 20%;"><img style="width: 80px;" src="logo.png"></td>
					<td style="width: 50%;"><h3>THẺ KHO</h3></td>
					<td style="width: 30%; text-align: left; font-size: 16px; padding: 15px;">Mã số: BĐS/QT-03.MH /M05<br>
					Hiệu lực: 31/05/2017</td>
				</tr>
			</table>
		</div>
		<div class="clear"></div><br>
		<?php 
		$materials_id = $_GET["materials_id"]; 
		$warehouse_id = $_GET["warehouse_id"];
		?>
		<div class="row">Công trình: <b>
			<?php 
			$sql = "SELECT * FROM warehouse WHERE warehouse_id = '$warehouse_id'";
			$row = mysql_fetch_assoc(mysql_query($sql));
			if($row["warehouse_name"] != null){
				echo $row["warehouse_name"];
			}
			?>
		</b></div>
		<div class="row">Số: ....../....../...... </div>
		<div class="row">Loại vật tư, hàng hóa: 
			<?php 
			$sql = "SELECT * FROM materials INNER JOIN materials_category on materials.materials_cat_id = materials_category.materials_cat_id WHERE materials_id = '$materials_id'"; 
			$result = mysql_query($sql);
			while ($row = mysql_fetch_array($result)) {
				echo ("<b>".$row["materials_name"]."</b> &emsp; Mã số: <b>".$row["materials_id"]."</b> &emsp; Phân loại: <b>".$row["materials_cat_name"]."</b> &emsp; Đơn vị tính: <b>".$row["materials_unit"]."</b>");
			}
			?>
		</div>	
		<div class="row"><br>
			<table>
				<tr style="font-weight:bold; text-align: center">
					<td rowspan="3" style=" width: 5%">STT</td>
					<td rowspan="3" style=" width: 10%">Ngày tháng cập nhật</td>
					<td colspan="2" style=" width: 10%">Số hiệu chứng từ</td>
					<td rowspan="3" style=" width: 25%">Diễn giải</td>
					<td colspan="5" style=" width: 40%">Nhập vào/Xuất ra khỏi kho</td>
					<td rowspan="3" style=" width: 10%">Ghi chú</td>
				</tr>
				<tr style="font-weight:bold; text-align: center">
					<td rowspan="2">Nhập</td>
					<td rowspan="2">Xuất</td>
					<td colspan="2">Nhập</td>
					<td colspan="2">xuất</td>
					<td rowspan="2">Tồn thực tế</td>
				</tr>
				<tr style="font-weight:bold; text-align: center">
					<td>Số lượng</td>
					<td>Cộng dồn</td>
					<td>Số lượng</td>
					<td>Cộng dồn</td>
				</tr>
				<?php
				$sql = "(SELECT warehouse_id, goods_issue_contain.goodsissue_id as goods_id, materials_id, materialscount, goodsissue_date AS goods_date FROM goods_issue_contain INNER JOIN goods_issue ON goods_issue_contain.goodsissue_id = goods_issue.goodsissue_id WHERE warehouse_id = '$warehouse_id' AND materials_id ='$materials_id') UNION (SELECT warehouse_id, goods_receipt_contain.goodsreceipt_id AS goods_id,materials_id, materialscount, goodsreceipt_date AS goods_date FROM goods_receipt_contain INNER JOIN goods_receipt ON goods_receipt_contain.goodsreceipt_id = goods_receipt.goodsreceipt_id WHERE warehouse_id = '$warehouse_id' AND materials_id ='$materials_id') ORDER BY goods_date";
				$result = mysql_query($sql);
				$soft = 1;
				$receive_total = 0;
				$send_total = 0;
				while ($row = mysql_fetch_array($result)) {
					?>
					<tr>
						<td><?php echo $soft ?></td>
						<td><?php echo date('d/m/Y',time($row["goods_date"])) ?></td>
						<td><?php if(strpos($row["goods_id"], "PNK") == TRUE ){echo "x";} ?></td>
						<td><?php if(strpos($row["goods_id"], "PXK") == TRUE ){echo "x";} ?></td>
						<td style="text-align: left; padding-left: 10px;"></td>
						<td><?php 
						if(strpos($row["goods_id"], "PNK") == TRUE ){
							echo $row["materialscount"];
							$receive_total += $row["materialscount"];
						} 
						?>
					</td>
					<td><?php if(strpos($row["goods_id"], "PNK") == TRUE ){echo $receive_total; } ?></td>
					<td><?php 
					if(strpos($row["goods_id"], "PXK") == TRUE ){
						echo $row["materialscount"];
						$send_total += $row["materialscount"];
					} 
					?>
					</td>
					<td><?php if(strpos($row["goods_id"], "PXK") == TRUE ){echo $send_total;} ?></td>
					<td></td>
					<td></td>
				</tr>
				<?php 
				$soft++;
			} 
			?>
			<tr><td>2</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
			<tr><td>3</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
			<tr><td>2</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
			<tr><td>2</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
			<tr><td>2</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
			<tr><td>2</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
			<tr><td>2</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
			<tr><td>2</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
			<tr><td>2</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
		</table>
	</div>	
	<div class="row" style="text-align: right;;"><b>Thủ kho lập &emsp; &emsp; &emsp; &emsp;</b></div>
	<div class="clear"></div><br>
</div>	
</div>

</body>
</html>