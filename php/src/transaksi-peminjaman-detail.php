<?php
session_start();// menjalankan sesion PHP 
include'config.php';

    $IdTransaksi=$_GET['IdTransaksi'];
    $q_tampil_transaksi=mysqli_query($conn,"SELECT * FROM transaksi WHERE IdTransaksi='$IdTransaksi'");
    $r_tampil_transaksi=mysqli_fetch_array($q_tampil_transaksi);
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
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Detail Data Peminjaman</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <!-- Main content -->
    <form action="transaksi-input-proses.php" method="POST">
                <div class="card-body">
                  <div class="row">
                  <div class="col-md-6">
                  <!-- Kolom Satu -->
                  <div class="form-group ">
                    <label>ID Transaksi</label>
                    <input type="text" disabled="" value="<?php echo $r_tampil_transaksi['IdTransaksi']; ?>" class="form-control">
                    <input type="hidden" name="IdTransaksi" value="<?php echo $r_tampil_transaksi['IdTransaksi']; ?>" class="form-control">
                  </div>
                  <div class="form-group ">
                    <label>ID Barang</label>
                    <input type="text" disabled="" value="<?php echo $r_tampil_transaksi['IdBarang']; ?>  " class="form-control">
                    <input type="hidden" name="IdBarang" value="<?php echo $r_tampil_transaksi['IdBarang']; ?> " class="form-control">
                  </div>
                  <div class="form-group ">
                    <label>Nama Peminjaman</label>
                    <input type="text" disabled="" value="<?php echo $r_tampil_transaksi['Nama']; ?>  " class="form-control">
                    <input type="hidden" name="Nama" value="<?php echo $r_tampil_transaksi['Nama']; ?> " class="form-control">
                  </div>
                  <div class="form-group ">
                    <label>Kelas</label>
                    <input type="text" disabled="" value="<?php echo $r_tampil_transaksi['SwKelas']; ?>  " class="form-control">
                    <input type="hidden" name="SwKelas" value="<?php echo $r_tampil_transaksi['SwKelas']; ?> " class="form-control">
                  </div>
                  
                  <!-- Kolom Dua -->
                  </div>
                  <div class="col-md-6">
                  <div class="form-group ">
                    <label>Nama Barang</label>
                    <input type="text" disabled="" value="<?php echo $r_tampil_transaksi['BrgNama']; ?>  " class="form-control">
                    <input type="hidden" name="BrgNama" value="<?php echo $r_tampil_transaksi['BrgNama']; ?> " class="form-control">
                  </div>
                  <div class="form-group ">
                    <label>Qty</label>
                    <input type="text" disabled="" value="<?php echo $r_tampil_transaksi['qty']; ?>  " class="form-control">
                    <input type="hidden" name="qty" value="<?php echo $r_tampil_transaksi['qty']; ?> " class="form-control">
                  </div>
                  <div class="form-group ">
                    <label>Tanggal Peminjam</label>
                    <input type="text" disabled="" value="<?php echo $r_tampil_transaksi['TglPinjam']; ?>  " class="form-control">
                    <input type="hidden" name="TglPinjam" value="<?php echo $r_tampil_transaksi['TglPinjam']; ?> " class="form-control">
                  </div>
                  <div class="form-group ">
                    <label>Status</label>
                    <input type="text" disabled="" value="<?php echo $r_tampil_transaksi['status']; ?>  " class="form-control">
                    <input type="hidden" name="status" value="<?php echo $r_tampil_transaksi['status']; ?> " class="form-control">
                  </div>
                  <div class="col-12">
                    <a href="transaksi-peminjaman.php" class="btn btn-success float-right">Kembali</a>
                  </div>
                </div>
                </div>
                </div>
              </form>

    <!-- End Content -->
 <!-- fotter -->
 <?php include 'template/footer.php';?>
</body>
</html>