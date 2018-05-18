
<?php 
include ("../../connect.php");
if(isset($_GET["materials_name"])){
	$materials_name = $_GET["materials_name"];
	$sql = "select * from materials where '$materials_name' = materials_name";
	$result = mysql_query($sql); 
	while ($row = mysql_fetch_array($result)) {
		$_POST['materials_unit'] = $row['materials_unit'];
		echo ('<input style="width: 70px;" class="txtbox" id="materials_unit" name="materials_unit" readonly="readonly" value = "'.$row["materials_unit"].'">');
	}
}
?>
