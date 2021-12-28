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
            <h1 class="m-0 text-dark"><b>Laporan Data Transakasi Tahunan</b></h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                  <div class="table-responsive">
                                  <?php $thn_ini=date("Y");?>
                                      <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                          <thead>
                                          <form method="POST" action="">
                                          <td>-Pilih Tahun-</td><td><input type="year" name="thn_ini" value="<?php echo $thn_ini; ?>"></td>
                                          <td><button type="submit" name="cari" class="btn btn-danger">Cari</td>
                                          <div align="right">
                                          <a href="cetak-pertahun.php?module=cetakpertahun&thn_ini=<?php echo $_POST['thn_ini'];?>"><img src="img/print.png" height="50px" height="50px"></a>&nbsp;&nbsp;
                                          <a target="_blank" href="cetak-pertahun-pdf.php?module=cetakpertahun&thn_ini=<?php echo $_POST['thn_ini'];?>"><img src="img/pdf.png" height="50px" height="50px"></a>&nbsp;&nbsp;
                                          <a target="_blank" href="cetak-pertahun-excel.php?module=cetakpertahun&thn_ini=<?php echo $_POST['thn_ini'];?>"><img src="img/excel.png" height="50px" height="50px"></a>&nbsp;&nbsp;
                                          </div>
                                          </tr>
                                          </form>
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
                                          </thead>
                                          <?php
                                            if (isset($_POST['cari'])){
                                              $thn=$_POST['thn_ini'];
                                              $query= mysqli_query($conn, "select * from transaksi where transaksi.TglPinjam LIKE '%$_POST[thn_ini]%'");
                                              }else{
                                            $query = mysqli_query($conn,"select * from transaksi");
                                            }
                                            $nomor=1;
                                            $total=0;
                                            while($r_tampil_transaksi=mysqli_fetch_array($query)){
                                            ?>
                                          <tbody>
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
                                          </tbody>
                                          <?php 
                                            $nomor++;
                                            }
                                          ?>
                                      </table>
                                  </div>
                                </div>
</div> 
