<?php 
    session_start();
    include'config.php';

    $IdSiswa=$_GET['IdSiswa'];
    $q_tampil_siswa=mysqli_query($conn,"SELECT * FROM siswa WHERE IdSiswa='$IdSiswa'");
    $r_tampil_siswa=mysqli_fetch_array($q_tampil_siswa);
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
            <h1 class="m-0 text-dark">Detail Data Ketua Kelas</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <!-- Main content -->
    <form action="siswa-edit-proses.php" method="POST">
                <div class="card-body">
                  <div class="row">
                  <div class="col-md-6">
                  <!-- Kolom Satu -->
                  <div class="form-group ">
                    <label>ID Siswa</label>
                    <input type="text" disabled="" value="<?php echo $r_tampil_siswa['IdSiswa']; ?>" class="form-control">
                    <input type="hidden" name="IdSiswa" value="<?php echo $r_tampil_siswa['IdSiswa']; ?>" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Nama Siswa</label>
                    <input type="text" name="SwNama" value="<?php echo $r_tampil_siswa['SwNama']; ?>" class="form-control">
                  </div>
                  
                  <!-- Kolom Dua -->
                  </div>
                  <div class="col-md-6">
                  <div class="form-group">
                    <label>Kelas</label>
                    <input type="text" name="SwKelas" value="<?php echo $r_tampil_siswa['SwKelas']; ?>" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>No Handphone</label>
                    <input type="text" name="SwNoHp" value="<?php echo $r_tampil_siswa['SwNoHp']; ?>" class="form-control">
                  </div>
                  <div class="col-12">
                    <a href="siswa.php" class="btn btn-danger float-right">Batal</a>
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