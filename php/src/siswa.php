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
          <div class="col-sm-9">
            <h1 class="m-0 text-dark"><b>Data Ketua Kelas</b></h1>
          </div><!-- /.col -->
          <div class="form-inline"> 
            <div align="right"> 
            <div class="form-inline"> 
            <div align="right"> 
                <form method=post> 
                    <input type="text" name="pencarian" placeholder="Search">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                </form> 
            </div> 
        </div>
            </div> 
        </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <div class="col-sm-6">
        <a href="siswa-input.php" class="btn btn-success">Tambah Data</a>
        <!-- <a href="download-pdf-qr-siswa.php" class="btn btn-primary">Download QR Code</a> -->
	</div>
    
    <br>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>No</th>
                    <th>ID Siswa</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>No Handphone</th>
                    <th>Aksi</th>
                </tr>
                </thead>

                <tbody> 
            <?php 
                $batas = 5;
                extract($_GET); 
                if(empty($hal)) { 
                    $posisi = 0; 
                    $hal = 1; 
                    $nomor = 1; 
                }else { 
                    $posisi = ($hal - 1) * $batas; 
                    $nomor = $posisi+1; 
                }

                if($_SERVER['REQUEST_METHOD'] == "POST") { 
                    $pencarian = trim(mysqli_real_escape_string($conn, $_POST['pencarian'])); 
                    if($pencarian != "") { 
                        $sql = "SELECT * FROM siswa WHERE IdSiswa LIKE '%$pencarian%' 
                                OR IdSiswa LIKE '%$pencarian%' 
                                OR SwNama LIKE '%$pencarian%' 
                                OR SwKelas LIKE '%$pencarian%'"; 

                        $query = $sql; 
                        $queryJml = $sql; 

                    } else { 
                        $query = "SELECT * FROM siswa LIMIT $posisi, $batas"; 
                        $queryJml = "SELECT * FROM siswa"; 
                        $no = $posisi * 1; 
                    }
                }
                else { 
                    $query = "SELECT * FROM siswa LIMIT $posisi, $batas"; 
                    $queryJml = "SELECT * FROM siswa"; 
                    $no = $posisi * 1; 
                }

                //$sql="SELECT * FROM tbSiswa ORDER BY idSiswa DESC"; 
                $q_tampil_siswa = mysqli_query($conn, $query); 

                /* Pengecekan apakah terdapat data di database, jika ada, tampilkan*/ 
                if(mysqli_num_rows($q_tampil_siswa) > 0) { 

                    /* looping data Siswa sesuai yang ada di database */
                    while($r_tampil_siswa=mysqli_fetch_array($q_tampil_siswa)) {
            ?>
            <tr>
                <td><?php echo $nomor; ?></td>
                <td><?php echo $r_tampil_siswa['IdSiswa']; ?></td>
                <td><?php echo $r_tampil_siswa['SwNama']; ?></td>
                <td><?php echo $r_tampil_siswa['SwKelas']; ?></td>
                <td><?php echo $r_tampil_siswa['SwNoHp']; ?></td>
                <td>
                    <a href="siswa-detail.php?IdSiswa=<?php echo $r_tampil_siswa['IdSiswa'];?>"><i class="nav-icon fas fa-eye" title="Detail">&#xE254;</i></a>
                    <a href="siswa-edit.php?IdSiswa=<?php echo $r_tampil_siswa['IdSiswa'];?>"><i class="nav-icon fas fa-edit" title="Edit">&#xE254;</i></a>
					<a href="siswa-delete.php?IdSiswa=<?php echo $r_tampil_siswa['IdSiswa'];?>" onclick = "return confirm ('Apakah Anda Yakin Akan Menghapus Data Ini?')" class="tombol" style="color:#ef8157; font-weight:bold"><i class="nav-icon fas fa-trash" title="Delete">&#xE872;</i></a>
                </td>
            </tr>
            <?php 
                        $nomor++;  
                    }   // selesai looping while 
                } 
                else { 
                    echo "<tr><td colspan=6>Data Tidak Ditemukan</td></tr>"; 
                }
            ?> 
        </tbody>
    </table>
    
    <?php 
    if(isset($_POST['pencarian'])) { 
        if($_POST['pencarian']!='') { 
            echo "<div style=\"float:left;\">"; 
            $jml = mysqli_num_rows(mysqli_query($conn, $queryJml)); 
            echo "Data Hasil Pencarian: <b>$jml</b>"; 
            echo "</div>"; 
        }
    } else { 
    ?> 
        <div style="float: left;"> 
        <?php 
            $jml = mysqli_num_rows(mysqli_query($conn, $queryJml)); 
            echo "Jumlah Data : <b>$jml</b>"; 
        ?> 
        </div>
        <div class="pagination" style="float: right;"> 
            <?php 
                $jml_hal = ceil($jml / $batas); 
                for($i = 1; $i <= $jml_hal; $i++) { 
                    if($i != $hal) { 
                        echo "<a href=\"?p=siswa&hal=$i\">$i</a>"; 
                    } else { 
                        echo "<a class=\"active\">$i</a>"; 
                    } 
                }
            ?>
        </div> 
    <?php 
    } 
    ?> 
          </div>
</table>
    <!-- End Content -->
 <!-- fotter -->
<?php include 'template/footer.php';?>
</body>
</html>