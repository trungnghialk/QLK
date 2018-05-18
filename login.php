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
  if (isset($_SESSION["username"])){
    header('Location: index.php?id=dathang&view=true');
  }
  if (isset($_POST["submit"])) {
    // lấy thông tin người dùng
    $username = $_POST["username"];
    $password = $_POST["password"];
      //làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
      //mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
    $username = strip_tags($username);
    $username = addslashes($username);
    $password = strip_tags($password);
    $password = addslashes($password);
    $sql = "select * from users where username = '$username' and pass = '$password' ";
    $query = mysql_query($sql);
    if (!$query || mysql_num_rows($query) == 0){
      $_SESSION['login_error'] = "Tên đăng nhập hoặc mật khẩu không đúng !";
    }
    else{
        //tiến hành lưu tên đăng nhập vào session để tiện xử lý sau này
      $_SESSION['username'] = $username;
      $_SESSION['clear'] = "O";
      $_SESSION["tam"] = "text";
                // Thực thi hành động sau khi lưu thông tin vào session
                // ở đây mình tiến hành chuyển hướng trang web tới một trang gọi là index.php
      header('Location: index.php?id=dathang&view=true');
    }

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
