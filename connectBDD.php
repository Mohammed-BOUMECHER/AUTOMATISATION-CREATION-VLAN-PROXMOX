<?php
	$server = 'localhost';
	$user = 'admin';
	$password = '1994';
	$db = 'AUTO_VLAN';
	
	$conn = mysqli_connect($server,$user,$password,$db);
	
	if(!$conn){
	die("connection Failed!:".mysqli_connect_error());
	}
	?>
