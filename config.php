<?php 
	session_start();
	$conn = mysqli_connect("localhost","root","","enrollment_system");
	if(!$conn) {
		exit();
	}
?>