<?php
    //membuat koneksi
    include 'config.php';

    //memasukkan data ke array
    $IdTransaksi = $_POST['IdTransaksi']; 
    $IdBarang = $_POST['IdBarang']; 
    $Nama = $_POST['Nama']; 
    $SwKelas = $_POST['SwKelas'];
    $BrgNama = $_POST['BrgNama'];
    $Spesifikasi = $_POST['Spesifikasi'];
    $qty = $_POST['qty']; 
    $TglPinjam = $_POST['TglPinjam']; 
    $TglKembali = $_POST['TglPinjam'];
    $status = $_POST['status'];
    // var_dump($_POST); die;
    //melakukan input
    /*$sql = "INSERT INTO transaksi VALUES('$IdTransaksi','$IdBarang','$Nama',
            '$SwKelas','$BrgNama','$qty','$TglPinjam','$TglKembali','$status')"; 
    $query = mysqli_query($conn, $sql); */

    $selSto =mysqli_query($conn, "SELECT * FROM barang WHERE IdBarang='$IdBarang'");
    $sto    =mysqli_fetch_array($selSto);
    $stok    =$sto['BrgJumlah'];
    //menghitung sisa stok
    $sisa    =$stok-$qty;
    $nambah    =$stok+$qty;

    if ($stok < $qty) {
        echo '<script language="javascript">';
        echo 'alert("message successfully sent")';
        echo '</script>';
    }
    //proses    
    else{
        $insert = mysqli_query($conn, "INSERT INTO transaksi VALUES('$IdTransaksi','$IdBarang','$Nama',
            '$SwKelas','$BrgNama','$Spesifikasi','$qty','$TglPinjam','$TglKembali','$status')");
            $pinjam = mysqli_query($conn, "SELECT * FROM transaksi WHERE status='pinjam'");
            $kembali = mysqli_query($conn, "SELECT * FROM transaksi WHERE status='kembali'");
            
            if($insert){
                    if($pinjam){
                            //update stok
                            $upstok= mysqli_query($conn, "UPDATE barang SET BrgJumlah='$sisa' WHERE IdBarang='$IdBarang'");
                    }elseif($kembali&&$nambah)
                            $tbstok= mysqli_query($conn, "UPDATE barang SET BrgJumlah='$nambah' WHERE IdBarang='$IdBarang'");
                
                ?>
                <script language="JavaScript">
                    alert('Good! Input transaksi pengeluaran barang berhasil ...');
                    document.location='./';
                </script>
                <?php
            }
            else {
                echo "<div><b>Oops!</b> 404 Error Server.</div>";
            }
    }


    //kembali ke halaman sebelumnya
    header("location: transaksi-peminjaman.php");
    ?>