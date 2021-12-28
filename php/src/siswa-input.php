<?php
session_start();// menjalankan sesion PHP 
include'config.php';
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
            <h1 class="m-0 text-dark">Tambah Data Ketua Kelas</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <!-- Main content -->
    <form action="siswa-input-proses.php" method="POST">
                <div class="card-body">
                  <div class="row">
                  <div class="col-md-6">
                  <!-- Kolom Satu -->
                  <div class="form-group ">
                    <label>ID Siswa</label>
                    <input type="text" name="IdSiswa" required="required" 
                      value="<?php //membuat IdSiswa otomatis
                      $query = mysqli_query($conn, "SELECT max(IdSiswa) as kodeTerbesar FROM siswa");
                      $data = mysqli_fetch_array($query);
                      $kodeSiswa = $data['kodeTerbesar'];

                      $urutan = (int) substr($kodeSiswa, 3, 3);
                      $urutan++;

                      $huruf = "SW";
                      $kodeSiswa = $huruf . sprintf("%03s", $urutan);
                      echo $kodeSiswa;
                      ?>" readonly class="form-control">
                  </div>

                  <div class="form-group">
                    <label>Nama Ketua Kelas</label>
                    <input type="text" name="SwNama" placeholder="Nama Ketua Kelas" class="form-control">
                  </div>
                  
                  <!-- Kolom Dua -->
                  </div>
                  <div class="col-md-6">
                  <div class="form-group">
                    <label>Kelas</label>
                    <input type="text" name="SwKelas" placeholder="Kelas" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>No Handphone</label>
                    <input type="text" name="SwNoHp" placeholder="No Handphone" class="form-control">
                  </div>
                  <div class="col-12">
                    <a href="siswa.php" class="btn btn-danger float-right">Batal</a>
                    <input type="submit" value="Simpan" class="btn btn-primary float-right">
                  </div>
                </div>
                </div>
              </form>

    <!-- End Content -->
 <!-- fotter -->
 <?php include 'template/footer.php';?>
</body>
</html>