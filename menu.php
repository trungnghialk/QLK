<nav class="navbar navbar-fixed-top nav-custom">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">QUẢN LÝ KHO</a>
    </div>
    <ul class="nav navbar-nav">
      <li style="<?php if($_GET['id'] == 'dathang'){echo 'background-color: #eee;';} ?>">
      	<a style="<?php if($_GET['id'] == 'dathang'){echo 'color: green;';} ?>" href="?id=dathang&view=true">Đặt hàng</a></li>
      <li style="<?php if($_GET['id'] == 'nhapkho'){echo 'background-color: #eee;';} ?>">
      	<a style="<?php if($_GET['id'] == 'nhapkho'){echo 'color: green;';} ?>" href="?id=nhapkho&view=true">Nhập kho</a></li>
      <li style="<?php if($_GET['id'] == 'xuatkho'){echo 'background-color: #eee;';} ?>">
      	<a style="<?php if($_GET['id'] == 'xuatkho'){echo 'color: green;';} ?>" href="?id=xuatkho&view=true">Xuất kho</a></li>
      <li style="<?php if($_GET['id'] == 'chuyenkho'){echo 'background-color: #eee;';} ?>">
      	<a style="<?php if($_GET['id'] == 'chuyenkho'){echo 'color: green;';} ?>" style="color: blue" href="?id=chuyenkho&view=true">Chuyển kho</a></li>
      <li style="<?php if($_GET['id'] == 'vattu'){echo 'background-color: #eee;';} ?>">
      	<a style="<?php if($_GET['id'] == 'vattu'){echo 'color: green;';} ?>" href="?id=vattu">Vật tư</a></li>
      <li style="<?php if($_GET['id'] == 'khohang'){echo 'background-color: #eee;';} ?>">
      	<a style="<?php if($_GET['id'] == 'khohang'){echo 'color: green;';} ?>" href="?id=khohang">Kho hàng</a></li>
      <li style="<?php if($_GET['id'] == 'nhacungcap'){echo 'background-color: #eee;';} ?>">
      	<a style="<?php if($_GET['id'] == 'nhacungcap'){echo 'color: green;';} ?>" href="?id=nhacungcap">Nhà Cung cấp</a></li>
      <li style="<?php if($_GET['id'] == 'baocao'){echo 'background-color: #eee;';} ?>">
      	<a style="<?php if($_GET['id'] == 'baocao'){echo 'color: green;';} ?>" href="?id=baocao">Báo cáo</a></li>
      <li style="<?php if($_GET['id'] == 'cauhinh'){echo 'background-color: #eee;';} ?>">
      	<a style="<?php if($_GET['id'] == 'cauhinh'){echo 'color: green;';} ?>" href="?id=cauhinh">Cấu hình</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Xin chào, <?php echo $_SESSION['username'] ?></a></li>
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Thoát</a></li>
    </ul>
  </div>
</nav>