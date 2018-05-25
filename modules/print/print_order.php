<!DOCTYPE html>
<html>
<head>
	<title>PHIẾU ĐẶT HÀNG</title>
</head>
<link rel="stylesheet" type="text/css" href="style.css">
<body>
	<div class="wraper_wide">
		<div class="banner">
			<table style="width: 100%; border: 0px;">
				<tr>
					<td style="width: 50%; text-align: center; font-weight: bold; border: 0px;">CTY TNHH MTV KT-XD TOÀN THỊNH PHÁT<BR>PHÒNG MUA HÀNG</td>
					<td style="width: 50%; text-align: center; font-weight: bold; border: 0px;">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM<br>Độc lập - Tự do - Hạnh phúc</td>
				</tr>
			</table>
			<h3 style="text-align: center;">ĐƠN ĐẶT HÀNG</h3>
		</div>
		<div class="clear"></div><br> 
		<?php 
		include("../../connect.php");
		if(isset($_GET["order_id"])){
			$order_id = $_GET["order_id"];
			$edit = 1;
			$sql = "SELECT * FROM orders_contain as a INNER JOIN materials as b ON a.materials_id = b.materials_id INNER JOIN materials_category as c on b.materials_cat_id = c.materials_cat_id WHERE a.order_id = '$order_id'";
			$result = mysql_query($sql);
			while ($row = mysql_fetch_array($result)) {
				$_SESSION["materials_id".$edit] = $row["materials_id"];
				$_SESSION['materials_name'.$edit] = $row['materials_name'];
				$_SESSION['materials_cat_name'.$edit] = $row['materials_cat_name'];
				$_SESSION['materials_unit'.$edit] = $row['materials_unit'];
				$_SESSION['materials_Price'.$edit] = $row['materials_Price'];
				$_SESSION['materialscount_in'.$edit] = $row['materialscount_in'];
				$_SESSION['materialscount_out'.$edit] = $row['materialscount_out'];
				$edit++;
				$_SESSION["item"] = $edit;
			}
			$sql =" SELECT * FROM orders as a INNER JOIN supplier as b on a.supplier_id = b.supplier_id INNER JOIN warehouse as c on a.warehouse_id = c.warehouse_id WHERE order_id = '$order_id'";
			$result = mysql_query($sql);
			while ($row = mysql_fetch_array($result)) {
				$supplier_name = $row["supplier_name"];
				$supplier_mobile = "0".$row["supplier_mobile"];
				$supplier_addr = $row["supplier_addr"];
				$supplier_taxcode = $row["supplier_taxcode"];
				$warehouse_name = $row["warehouse_name"];
				$warehouse_adr = $row["warehouse_adr"];
				$order_accept_date = $row["order_accept_date"];
			}
		}
		$item = $_SESSION["item"];
		if (isset($_POST["approve"])) {
			$sql = "UPDATE orders SET approve = 'pass' WHERE order_id = '$order_id'";
			mysql_query($sql);
		}
		?>
		<table style="width: 100%; border: 0px; margin: 20px auto">
			<tr>
				<td style="width: 25%; text-align: right; border: 0px;">Số __/__/201_</td><td style="width: 25%; border: 0px;"></td><td style="width: 25%;  border: 0px;"></td><td style="width: 25%; text-align: left;  border: 0px;">Ngày: __/__/____</td>
			</tr>
		</table>
		<div class="row"><b>Kính gửi: <?php echo $supplier_name ?></b> </div>	
		<div class="row">Địa chỉ: <b><?php echo $supplier_addr ?></b></div>	
		<div class="row">Mã số thuế: <b><?php echo $supplier_taxcode ?></b></div>	
		<div class="row">Tel: <b><?php echo $supplier_mobile ?></b>  &emsp;&emsp;Fax: ............................................................................................Email:....................................................................</div>	
		<div class="row"><br>
			<table style="width: 90%;">
				<tr style="font-weight:bold; text-align: center">
					<td style=" width: 10%">STT</td>
					<td style=" width: 30%">TÊN HÀNG</td>
					<td style=" width: 10%">ĐVT</td>
					<td style=" width: 10%">SỐ LƯỢNG</td>
					<td style=" width: 10%">ĐƠN GIÁ</td>
					<td style=" width: 10%">THÀNH TIỀN</td>
					<td style=" width: 10%">GHI CHÚ</td>
				</tr>
				<?php
				$total = 0;
				for ($i=1; $i < $_SESSION["item"] ; $i++) { 
					$sum = $_SESSION['materialscount_in'.$i]*$_SESSION['materials_Price'.$i];
					$total += $sum;
					?>
					<tr>
						<td><?php echo $i ?></td>
						<td style="width: 300px; text-align: left; padding-left: 10px;"><?php echo $_SESSION["materials_name".$i] ?></td>
						<td><?php echo $_SESSION["materials_unit".$i] ?></td>
						<td><?php echo $_SESSION['materialscount_in'.$i] ?></td>
						<td><?php echo number_format($_SESSION['materials_Price'.$i]) ?></td>
						<td><?php echo number_format($sum) ?></td>
						<td></td>
					</tr> 
					<?php 
  // Kết thúc xuaasrt vật tư ra màn hình
				} 
				?>
			</table>
		</div>
		<div style="padding-left: 15%">
			<div class="row"><b>Cộng giá trị:</b> ................................................................ <?php echo "<b>".number_format($total)."</b> VNĐ"; ?></div>	
			<div class="row"><b>Thuế VAT 10%:</b> ..........................................................<?php echo "<b>".number_format($total*10/100)."</b> VNĐ" ?></div>
			<div class="row"><b>Tổng thành tiền:</b> .........................................................<?php echo "<b>".number_format($total+$total*10/100)."</b> VNĐ"; ?></div>
		</div>
		<br>
		<div>Tổng số tiền bằng chữ: <?php echo convert_number_to_words($total+$total*10/100)." đồng" ?></div>
		<div>Liên hệ nhận hàng: </div>
		<div>Nơi nhận hàng: <?php echo $warehouse_name ?></div>
		<div>Địa chỉ: <?php echo $warehouse_adr ?></div>
		<div style="margin-bottom: 10px">Thời gian giao hàng: <?php echo date('d/m/Y',time($order_accept_date)) ?></div>
		<div><u>Thông tin xuất hóa đơn: </u></div><br>
		<div style="padding-left: 100px"><b>CÔNG TY TNHH MTV KT XD Toàn Thịnh Phát<br>Địa chỉ: 62 Trần Huy liệu, Phường 12, Quận Phú Nhuận, TP.HCM, Việt Nam<br> Mã số thuế: 3600882415</b></div>

		<div class="row" style="font-weight:bold">
			<table style="width: 100%; border: 0px;">
				<tr>
					<td colspan="2" style="width: 66%; border: 0px;">BÊN MUA</td>
					<td style="width: 33%; border: 0px;">BÊN BÁN</td>
				</tr>
				<tr>
					<td colspan="2" style="width: 66%; border: 0px;">Công ty TNHH MTV KT XD Toàn Thịnh Phát</td>
					
				</tr>
				<tr>
					<td style="width: 33%; border: 0px;">P. Mua hàng</td>
					<td style="width: 33%; border: 0px;">P. Tổng Giám Đốc</td>
				</tr>
			</table>
			<div class="clear"></div><br>
			<div style="margin-bottom: 100px;"></div>
			<div class="control-group" style="width: 749px">
				<a href="#" onclick = "window.print()">IN PHIẾU</a>
				<a href="javascript:history.go(-1)">QUAY LẠI</a>
			</div>
			<div style="margin-bottom: 50px;"></div>
		</div>	
	</div>
</div>

<?php 

function convert_number_to_words( $number )
{
	$hyphen = ' ';
	$conjunction = '  ';
	$separator = ' ';
	$negative = 'âm ';
	$decimal = ' phẩy ';
	$dictionary = array(
		0 => 'Không',
		1 => 'Một',
		2 => 'Hai',
		3 => 'Ba',
		4 => 'Bốn',
		5 => 'Năm',
		6 => 'Sáu',
		7 => 'Bảy',
		8 => 'Tám',
		9 => 'Chín',
		10 => 'Mười',
		11 => 'Mười một',
		12 => 'Mười hai',
		13 => 'Mười ba',
		14 => 'Mười bốn',
		15 => 'Mười năm',
		16 => 'Mười sáu',
		17 => 'Mười bảy',
		18 => 'Mười tám',
		19 => 'Mười chín',
		20 => 'Hai mươi',
		30 => 'Ba mươi',
		40 => 'Bốn mươi',
		50 => 'Năm mươi',
		60 => 'Sáu mươi',
		70 => 'Bảy mươi',
		80 => 'Tám mươi',
		90 => 'Chín mươi',
		100 => 'trăm',
		1000 => 'ngàn',
		1000000 => 'triệu',
		1000000000 => 'tỷ',
		1000000000000 => 'nghìn tỷ',
		1000000000000000 => 'ngàn triệu triệu',
		1000000000000000000 => 'tỷ tỷ'
	);

	if( !is_numeric( $number ) )
	{
		return false;
	}

	if( ($number >= 0 && (int)$number < 0) || (int)$number < 0 - PHP_INT_MAX )
	{
		// overflow
		trigger_error( 'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING );
		return false;
	}

	if( $number < 0 )
	{
		return $negative . convert_number_to_words( abs( $number ) );
	}

	$string = $fraction = null;

	if( strpos( $number, '.' ) !== false )
	{
		list( $number, $fraction ) = explode( '.', $number );
	}

	switch (true)
	{
		case $number < 21:
		$string = $dictionary[$number];
		break;
		case $number < 100:
		$tens = ((int)($number / 10)) * 10;
		$units = $number % 10;
		$string = $dictionary[$tens];
		if( $units )
		{
			$string .= $hyphen . $dictionary[$units];
		}
		break;
		case $number < 1000:
		$hundreds = $number / 100;
		$remainder = $number % 100;
		$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
		if( $remainder )
		{
			$string .= $conjunction . convert_number_to_words( $remainder );
		}
		break;
		default:
		$baseUnit = pow( 1000, floor( log( $number, 1000 ) ) );
		$numBaseUnits = (int)($number / $baseUnit);
		$remainder = $number % $baseUnit;
		$string = convert_number_to_words( $numBaseUnits ) . ' ' . $dictionary[$baseUnit];
		if( $remainder )
		{
			$string .= $remainder < 100 ? $conjunction : $separator;
			$string .= convert_number_to_words( $remainder );
		}
		break;
	}

	if( null !== $fraction && is_numeric( $fraction ) )
	{
		$string .= $decimal;
		$words = array( );
		foreach( str_split((string) $fraction) as $number )
		{
			$words[] = $dictionary[$number];
		}
		$string .= implode( ' ', $words );
	}

	return $string;
}
?>
</body>
</html>