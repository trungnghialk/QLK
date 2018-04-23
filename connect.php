<?php
$server="localhost";
$user="quanlykho";
$pass="QLK123a";
$db="quanlykho";
mysql_connect($server, $user, $pass) or die("khong the ket noi");
mysql_select_db($db);
mysql_query("SET NAMES 'utf8'");
?>