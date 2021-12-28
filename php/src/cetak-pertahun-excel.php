<?php
require("./vendor/autoload.php");     //load file autoload.php dari composser
require("./config.php");      //load konfigurasi untuk koneksi ke DB

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

//membuat heading dari tabel dengan nama masing" kolom
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Laporan Tahunan Transaksi Peminjaman Barang SMK Negeri 1 Turen');
$sheet->setCellValue('A3', 'NO');
$sheet->setCellValue('B3', 'ID Transaksi');
$sheet->setCellValue('C3', 'ID Barang');
$sheet->setCellValue('D3', 'Nama');
$sheet->setCellValue('E3', 'Kelas');
$sheet->setCellValue('F3', 'Barang');
$sheet->setCellValue('G3', 'Tanggal Peminjam');
$sheet->setCellValue('H3', 'Tanggal Kembali');
$sheet->setCellValue('I3', 'Status');

 
$query = mysqli_query($conn,
                    "select transaksi.*, barang.IdBarang, siswa.SwKelas, barang.BrgNama from transaksi 
                    INNER JOIN barang ON barang.IdBarang = transaksi.IdBarang 
                    INNER JOIN siswa ON siswa.SwKelas = transaksi.SwKelas 
                    and transaksi.TglPinjam LIKE '%$_GET[thn_ini]%'");	
$i = 2;	//index yg akan digunakan untuk mengisi pertama kali
$no = 1;	//memberi nomor urut data

//extract hasil query dan setiap data yg dihasilkan dari perulangan akan
//disimpan di var $row
while($row = mysqli_fetch_array($query))
{
	//digunakan untuk menuliskan data dari hasil query sesuai kolom yg ditentukan
	$sheet->setCellValue('A'.$i, $no++);
	$sheet->setCellValue('B'.$i, $row['IdTransaksi']);
	$sheet->setCellValue('C'.$i, $row['IdBarang']);
	$sheet->setCellValue('D'.$i, $row['Nama']);	
    $sheet->setCellValue('E'.$i, $row['SwKelas']);
    $sheet->setCellValue('F'.$i, $row['BrgNama']);
    $sheet->setCellValue('G'.$i, $row['TglPinjam']);
    $sheet->setCellValue('H'.$i, $row['TglKembali']);
    $sheet->setCellValue('I'.$i, $row['status']);
    		
	$i++;
}

//membuat array $styleArray dimana didalamnya terdapat settingan border untuk cell
$styleArray = [
			'borders' => [
				'allBorders' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
			],
		];
$i = $i - 1;
//hasil array di Line 26 yaitu $styleArray yang berisi settingan border,
//agar digunakan dari Cell A1 hingga kolom F
$sheet->getStyle('A1:I'.$i)->applyFromArray($styleArray);
 
$filename = 'Data-Laporan-Tahunan-Transaksi-Peminjaman-Barang.xlsx';
ob_end_clean();     //untuk mengatasi excel cannot open the file format or file extension

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: cache, must-revalidate');
header('Pragme: public');

$writer = IOFActory::createWriter($spreadsheet, 'Xlsx');
$writer -> save('php://output');
exit();
?>