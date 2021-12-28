<?php 
include "config.php" ;
?>

<body onLoad="javascript:print()"> 
	<style type="text/css">
	.style5 {font-size: 24px}
	</style>

	<div class="panel-heading">
		<table width="100%">
		<tr>
	<td><div align="center">
	<div align="center">
        <table width="100%">
            <tr>
                <td width="25" align="center"><img src="img/logo.png" height="75px" width="75px"></td>
                <td align="center"><h3>Laporan Transaksi Tahunan Peminjaman Barang SMK Negeri 1 Turen</h3>
                Jl. Panglima Sudirman No.41, Turen, Kec. Turen, Malang, Jawa Timur 65175</td>
            </tr>
        </table>
        <hr>Bulan : <?php echo $_GET['bln_ini']; ?>
    </div>
	</td>
	</tr>
	</table>
	</div>
	<table width="100%" border="1" class="table table-bordered table-striped">

	<tr> 
	    <th>No</th>
        <th>ID Transakasi</th>
        <th>ID Barang</th>
        <th>Nama Peminjam</th>
        <th>Kelas</th>
        <th>Nama Barang</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Status </th>  
	</tr>

	<?php  
	include "config.php";
	$bln_ini = date("Y-m");
	$query = mysqli_query($conn,
                            "select transaksi.*, barang.IdBarang, siswa.SwKelas, barang.BrgNama from transaksi 
                            INNER JOIN barang ON barang.IdBarang = transaksi.IdBarang 
                            INNER JOIN siswa ON siswa.SwKelas = transaksi.SwKelas 
                            and transaksi.TglPinjam LIKE '%$_GET[bln_ini]%'");
	$nomor=1;
	$total=0;
	while($r_tampil_transaksi=mysqli_fetch_array($query)){
	?>

	<tr>
        <td><?php echo $nomor; ?></td>
        <td><?php echo $r_tampil_transaksi['IdTransaksi']; ?></td>
        <td><?php echo $r_tampil_transaksi['IdBarang']; ?></td>
        <td><?php echo $r_tampil_transaksi['Nama']; ?></td>
        <td><?php echo $r_tampil_transaksi['SwKelas']; ?></td>
        <td><?php echo $r_tampil_transaksi['BrgNama']; ?></td>
        <td><?php echo $r_tampil_transaksi['TglPinjam']; ?></td>
        <td><?php echo $r_tampil_transaksi['TglKembali']; ?></td>
        <td><?php echo $r_tampil_transaksi['status']; ?></td>
	</tr>

	<?php 
	$nomor++;
	}
	?>
	</table> 
	<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="FFFFFF">
	<tr 
	<td width="63%" bgcolor="#FFFFFF">
	<p align ="right"></p><br/>
	</td>
	
	<td width="37%" bgcolor="#FFFFFF">
	<div align="right"> <?php $tanggal= date('d M Y');
	echo " $tanggal";?><br/>
	</td>
	</tr>
	</div>
	</table>
</body>
