<?php
	include'config.php' ;
	
	$IdSiswa = $_GET['IdSiswa'];

	mysqli_query($conn,
		"DELETE FROM siswa WHERE IdSiswa='$IdSiswa'"
	);

	header("location: siswa.php");
?>