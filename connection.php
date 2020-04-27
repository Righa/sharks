<?php 

$conn = mysqli_connect("localhost", "root", "", "fooditem");
	if ($conn -> connect_error) {
		die("No connection: ". $conn-> connect_error);
	}

 ?>