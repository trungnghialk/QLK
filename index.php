<?php session_unset();; ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <title>Quản lý kho TTP CONS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
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
  while ($row = mysql_fetch_array($result)) {
    $_SESSION["permit_warehouse".$warehouse_count] = $row["warehouse_id"];
    $_SESSION["permit_id".$warehouse_count] = $row["Permission_id"];
    $warehouse_count++;
    $_SESSION["warehouse_count"] = $warehouse_count;
  }
// Kết thúc lấy quyền truy cập kho
?>
<nav class="navbar navbar-fixed-top nav-custom">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">QUẢN LÝ KHO</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="?id=dathang&view=true">Đặt hàng</a></li>
      <li><a href="?id=nhapkho&view=true">Nhập kho</a></li>
      <li><a href="?id=xuatkho&view=true">Xuất kho</a></li>
      <li><a href="?id=chuyenkho&view=true">Chuyển kho</a></li>
      <li><a href="?id=vattu">Vật tư</a></li>
      <li><a href="?id=khohang">Kho hàng</a></li>
      <li><a href="?id=nhacungcap">Nhà Cung cấp</a></li>
      <li><a href="?id=baocao">Báo cáo</a></li>
      <li><a href="?id=cauhinh">Cấu hình</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Xin chào, <?php echo $_SESSION['username'] ?></a></li>
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Thoát</a></li>
    </ul>
  </div>
</nav>
<?php 
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
  } 
?> 

</body>
</html>
<script src="js/custom.js"></script>}