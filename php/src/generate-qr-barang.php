<?php 
    session_start();
    include'config.php';

    //library phpqrcode
    include "phpqrcode/qrlib.php";
    
    //direktory tempat menyimpan hasil generate qrcode jika folder belum dibuat maka secara otomatis akan membuat terlebih dahulu
    $tempdir = "temp/"; 
    if (!file_exists($tempdir))
        mkdir($tempdir);
 

    $IdBarang=$_GET['IdBarang'];
    $q_tampil_barang=mysqli_query($conn,"SELECT * FROM barang WHERE IdBarang='$IdBarang'");
    $r_tampil_barang=mysqli_fetch_array($q_tampil_barang);
?> 
<!DOCTYPE html>
<html>
<head>

<?php include 'template/header.php';?>
<?php include 'template/sidebar.php';?>
 <!-- sidebar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-9">
            <h1 class="m-0 text-dark"><b>Detail QR Code Barang</b></h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <th>No</th>
                    <th>ID Barang</th>
                    <th>Nama Barang</th>
                    <th>Merk</th>
                    <th>Jumlah Barang</th>
                    <th>QRCode</th>
                </thead>
        <tbody>
        <?php
            $no = 1;
            $query = "SELECT * FROM barang";
            $arsip1 = $conn->prepare($query);
            $arsip1->execute();
            $res1 = $arsip1->get_result();
            // while ($row = $res1->fetch_assoc()) {
            //     $IdBarang = $row['IdBarang'];
 
                //Isi dari QRCode Saat discan
                $isi_IdBarang1 = $IdBarang;
                //Nama file yang akan disimpan pada folder temp 
                $namafile1 = $IdBarang.".png";
                //Kualitas dari QRCode 
                $quality1 = 'H'; 
                //Ukuran besar QRCode
                $ukuran1 = 4; 
                $padding1 = 0; 
                QRCode::png($isi_IdBarang1,$tempdir.$namafile1,$quality1,$ukuran1,$padding1);
        ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $r_tampil_barang['IdBarang']; ?></td>
                <td><?php echo $r_tampil_barang['BrgNama']; ?></td>
                <td><?php echo $r_tampil_barang['BrgMerk']; ?></td>
                <td><?php echo $r_tampil_barang['BrgJumlah']; ?></td>
                <td style="padding: 10px;"><img src="temp/<?php echo $namafile1; ?>" width="35px"></td>
            </tr>
        </tbody>
    </table>
        <br>
        <div class="col-12">
          <a href="barang.php" class="btn btn-primary float-right">Kembali</a>
        </div>
 
</body>
</html>
<?php mysqli_close($conn); ?>