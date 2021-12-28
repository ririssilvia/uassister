<?php
	include'config.php' ;
	
	$IdTransaksi = $_GET['IdTransaksi'];

	mysqli_query($conn,
		"DELETE FROM transaksi WHERE IdTransaksi='$IdTransaksi'"
	);

	header("location: transaksi-peminjaman.php");
?>