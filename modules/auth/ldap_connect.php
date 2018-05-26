<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body><br>
	<?php 
	$username = trim(str_replace('@toanthinhphat.com.vn', '', "nghiatt@toanthinhphat.com.vn"));
	$ldapHost = "ldap://hcm.ttp.vn";
	$ldapUser =$username."@ttp.vn";
	$ldapPswd =$_POST["password"];
	$ldapLink =ldap_connect($ldapHost) or die("Không thể kết nối đến server chứng thực");
	if (@ldap_bind($ldapLink,$ldapUser,$ldapPswd)){
		$_SESSION['username'] = $username;
	} 
	
	?>
</body>
</html>