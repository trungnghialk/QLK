<?php session_unset();; ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <title>Quản lý kho TTP CONS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap CRUD Data Table for Database with Modal Form</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body class="body">
  <?php 
// Bắt đầu kiểm tra login
  include ("connect.php");
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  if(!isset($_SESSION['username'])) {
    header('location: login.php');
  } 
// Kết thúc kiểm tra login

// Lấy quyền truy cập kho
  $username = $_SESSION["username"];
  $sql = "SELECT * FROM permission_asign WHERE username = '$username'";
  $result = mysql_query($sql);
  $warehouse_count = 1;
  $_SESSION["select_warehouse"] = ("tblorders.warehouse_id = 0");
  while ($row = mysql_fetch_array($result)) {
    $_SESSION["permit_warehouse".$warehouse_count] = $row["warehouse_id"];
    $_SESSION["permit_id".$warehouse_count] = $row["Permission_id"];
    $warehouse_count++;
    $_SESSION["warehouse_count"] = $warehouse_count;
    $_SESSION["select_warehouse"] = ($_SESSION["select_warehouse"]." OR tblorders.warehouse_id = ".$row["warehouse_id"]);
  }
// Kết thúc lấy quyền truy cập kho

  include ("menu.php");

// Hiển thị các trang
  if(isset($_GET['id'])) {
    if($_GET['id'] == "dathang"){include("order.php");}
    if($_GET['id'] == "nhapkho"){include("goods_receipt.php");}
    if($_GET['id'] == "xuatkho"){include("goods_issue.php");}
    if($_GET['id'] == "chuyenkho"){include("goods_transfer.php");}
    if($_GET['id'] == "vattu"){include("materials.php");}
    if($_GET['id'] == "khohang"){include("warehouse.php");}
    if($_GET['id'] == "nhacungcap"){include("supplier.php");}
    if($_GET['id'] == "baocao"){include("report.php");}
    if($_GET['id'] == "cauhinh"){include("config.php");}
//Kết thúc Hiển thị các trang
  } 
  ?> 

</body>
</html>
<script src="js/custom.js"></script>}