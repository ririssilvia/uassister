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
            <h1 class="m-0 text-dark"><b>Data Pengembalian</b></h1>
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
                    <th>ID Transakasi</th>
                    <th>ID Barang</th>
                    <th>Nama Peminjam</th>
                    <th>Kelas</th>
                    <th>Nama Barang</th>
                    <th>Spesifikasi Barang</th>
                    <th>Qty</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status </th>
                    <!-- <th>Aksi</th> -->
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
                        $sql = "SELECT * FROM transaksi 
                        WHERE status = 'Kembali'
                        AND (IdTransaksi LIKE '%$pencarian%' 
                        OR  TglPinjam LIKE '%$pencarian%'
                        OR  TglKembali LIKE '%$pencarian%'
                        OR  Nama LIKE '%$pencarian%'
                        OR  status LIKE '%$pencarian%')";
                        $query = $sql; 
                        $queryJml = $sql; 

                    } else { 
                        $query =  "SELECT * FROM transaksi WHERE status = 'Kembali' ORDER BY transaksi.IdTransaksi DESC LIMIT $posisi, $batas";
                        $queryJml = "SELECT * FROM transaksi WHERE transaksi.status = 'Kembali'"; 
                        $no = $posisi * 1; 
                    }
                }
                else { 
                            $query =  "SELECT * FROM transaksi WHERE status = 'Kembali' ORDER BY transaksi.IdTransaksi DESC LIMIT $posisi, $batas";
                        $queryJml = "SELECT * FROM transaksi WHERE transaksi.status = 'Kembali'"; 
                        $no = $posisi * 1; 
                }

               //$sql="SELECT * FROM tbtransaksi ORDER BY idtransaksi DESC"; 
               $q_tampil_transaksi = mysqli_query($conn, $query); 

               /* Pengecekan apakah terdapat data di database, jika ada, tampilkan*/ 
               if(mysqli_num_rows($q_tampil_transaksi) > 0) { 

                   /* looping data transaksi sesuai yang ada di database */
                   while($r_tampil_transaksi=mysqli_fetch_array($q_tampil_transaksi)) {
           ?>
            <tr>
                <td><?php echo $nomor; ?></td>
                <td><?php echo $r_tampil_transaksi['IdTransaksi']; ?></td> 
                <td><?php echo $r_tampil_transaksi['IdBarang']; ?></td>
				<td><?php echo $r_tampil_transaksi['Nama']; ?></td>
				<td><?php echo $r_tampil_transaksi['SwKelas']; ?></td>
                <td><?php echo $r_tampil_transaksi['BrgNama']; ?></td>
                <td><?php echo $r_tampil_transaksi['Spesifikasi']; ?></td>
                <td><?php echo $r_tampil_transaksi['qty']; ?></td>
                <td><?php echo $r_tampil_transaksi['TglPinjam']; ?></td>
                <td><?php echo $r_tampil_transaksi['TglKembali']; ?></td> 
                <td><?php echo $r_tampil_transaksi['status']; ?></td>
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
                        echo "<a href=\"?p=transaksi-peminjaman&hal=$i\">$i</a>"; 
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
         </div>
         </div>
    </div>
    </section>
 <!-- fotter -->
 
    <!-- End Content -->
 
</body>

</html>