<?php session_start(); ?>
<?php 
	$_SESSION = array();
	if(isset($_COOKIES[session_name()])){
		setcookie(session_name(), time()-36000, '/',0,0);
	}
	session_destroy();
	header('location: login.php');
?>