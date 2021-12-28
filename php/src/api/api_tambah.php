<?php
require_once('../config.php');

$request = file_get_contents("php://input");
$json = json_decode($request, true);
$IdBarang = $json['IdBarang'];
$Nama = $json['Nama'];
$SwKelas = $json['SwKelas'];
$BrgNama = $json['BrgNama'];
$Spesifikasi = $json['Spesifikasi'];
$qty = $json['qty'];
$TglPinjam = $json['TglPinjam'];
$TglKembali = isset($json['TglKembali']) ? $json['TglKembali'] : '';
$status = $json['status'];

$query = mysqli_query($conn, "SELECT max(IdTransaksi) as kodeTerbesar FROM transaksi");
$data = mysqli_fetch_array($query);
$kodeTransaksi = $data['kodeTerbesar'];

$urutan = (int) substr($kodeTransaksi, 10, 3);
$urutan++;

$huruf = "TR.";
$waktu = date('dmy');
$kodeTransaksi = $huruf . $waktu . "." . $urutan;

$sql = mysqli_query($conn, "INSERT INTO transaksi VALUES ('$kodeTransaksi','$IdBarang','$Nama','$SwKelas','$BrgNama','$Spesifikasi','$qty','$TglPinjam','$TglKembali','$status')");
header('Content-type: application/json');
if ($sql) {
	$selSto =mysqli_query($conn, "SELECT * FROM barang WHERE IdBarang='$IdBarang'");
    $sto    =mysqli_fetch_array($selSto);
    $stok    =$sto['BrgJumlah'];
    //menghitung sisa stok
    $sisa    =$stok-$qty;
	$upstok= mysqli_query($conn, "UPDATE barang SET BrgJumlah='$sisa' WHERE IdBarang='$IdBarang'");
	echo json_encode(array('RESPONSE' => 'SUCCESS', 'status' => 200));
	// header("location:../transaksi-peminjaman.php");
} else {
	echo json_encode(array('RESPONSE' => 'FAILED', 'status' => 500));
}
