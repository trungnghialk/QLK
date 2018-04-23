<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body class="body" onclose="clear()">
<?php 
$timezone = DateTimeZone::listIdentifiers() ;
foreach ($timezone as $item){
    echo $item . '<br/>';
}
?>
</body>
</html>
