<?php 
    session_start();
    include'config.php';

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
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Data Barang</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <!-- Main content -->
    <form action="barang-edit-proses.php" method="POST">
        <div class="card-body">
                  <div class="row">
                  <div class="col-md-6">
                  <!-- Kolom Satu -->
                  <div class="form-group ">
                    <label>ID Barang</label>
                    <input type="text" disabled="" value="<?php echo $r_tampil_barang['IdBarang']; ?>" class="form-control">
                    <input type="hidden" name="IdBarang" value="<?php echo $r_tampil_barang['IdBarang']; ?>" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" name="BrgNama" value="<?php echo $r_tampil_barang['BrgNama']; ?>" class="form-control">
                  </div>
                                    
                  <!-- Kolom Dua -->
                  </div>
                  <div class="col-md-6">
                  <div class="form-group">
                    <label>Merk Barang</label>
                    <input type="text" name="BrgMerk" value="<?php echo $r_tampil_barang['BrgMerk']; ?>" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Jumlah Barang</label>
                    <input type="text" name="BrgJumlah" value="<?php echo $r_tampil_barang['BrgJumlah']; ?>" class="form-control">
                  </div>
                  <div class="col-12">
                    <a href="barang.php" class="btn btn-danger float-right">Batal</a>
                    <input type="submit" name="simpan" value="Simpan" id="tombol-simpan" class="btn btn-primary float-right"> 
                </div>
                </div>
                </div>            
    </form>

    <!-- End Content -->
 <!-- fotter -->
 <?php include 'template/footer.php';?>
</body>
</html>