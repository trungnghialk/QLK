<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Quản lý kho TTP CONS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/login.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>
  <?php 
  include("connect.php");
  if (isset($_POST["submit"])) {
    $_SESSION["username"] =$_POST["username"];
    $_SESSION["password"] =$_POST["password"];
    // lấy thông tin người dùng
    include ("modules/auth/ldap_connect.php");
    if (isset($_SESSION["username"])) {
      $username = $_SESSION["username"];
      $sql = "select * from users where username = '$username'";
      $result = mysql_query($sql);
      $row = mysql_fetch_assoc($result);
      if ($_SESSION["username"] == $row["username"]) {
        $_SESSION['clear'] = "O";
        $_SESSION["tam"] = "text";
        header('Location: index.php?id=dathang&view=true');
      }
    }
    else {
      $_SESSION['login_error'] = ("Tên đăng nhập hoặc mật khẩu không đúng !");
    }
  }
  if (isset($_SESSION["username"])){
    header('Location: index.php?id=dathang&view=true');
  }
  ?>
  <div class="wrapper">
    <form class="form-signin" acction ="login.php" method="post">
      <a href="#"><img src="images/logo_login.png" /></a>
      <h2 class="form-signin-heading">ĐĂNG NHẬP</br>QUẢN LÝ KHO</h2><br />
      <div class="error_login"><?php if (isset($_SESSION['login_error'])){echo $_SESSION['login_error'];} ?></div>
      <input type="text" class="form-control" name="username" id="username" placeholder="Tài khoản" required="" autofocus="" /><br />
      <input type="password" class="form-control" name="password" placeholder="Mật khẩu" required=""/><br />
      <button class="btn btn-lg btn-primary btn-block" name="submit">Đăng nhập</button>   
    </form>
  </div>
</body>
</html>
