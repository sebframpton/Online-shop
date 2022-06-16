<?php			
	$user="root";
	$password="usbw";
	$database="partycakeparlour"; /*This DB must exist on the server */
	$host = "localhost:3307";	
	$conn = mysqli_connect($host,$user,$password, $database) or die("Cannot connect");
	
?>