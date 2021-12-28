<?php
	include'config.php' ;
	
	$IdBarang = $_GET['IdBarang'];

	mysqli_query($conn,
		"DELETE FROM barang WHERE IdBarang='$IdBarang'"
	);

	header("location: barang.php");
?>