<?php
    include 'config.php'; // menyisipkan/memanggil file koneksi.php untuk koneksi data dengan basis data 

    $IdTransaksi = $_GET['IdTransaksi'];
    $IdBarang = $_GET['IdBarang'];
    $Nama = $_GET['Nama'];
    $SwKelas = $_GET['SwKelas'];
    $BrgNama = $_GET['BrgNama'];
    $qty = $_GET['qty']; 
    $TglPinjam = $_GET['TglPinjam'];
    $tgl = date('Y-m-d'); 

    //mysqli_query($conn,"UPDATE transaksi SET status='Kembali', TglKembali='$tgl' WHERE IdTransaksi ='$IdTransaksi'");
 
    $selSto =mysqli_query($conn, "SELECT * FROM barang WHERE IdBarang='$IdBarang'");
    
    $sto    =mysqli_fetch_array($selSto);
    $stok    =$sto['BrgJumlah'];

    //menghitung sisa stok
    $nambah    =$stok+$qty;


    if ($stok < $qty) {
        ?>
        <script language="JavaScript">
            alert('Oops! Jumlah pengeluaran lebih besar dari stok ...');
            //document.location='./';
        </script>
        <?php
    }
    //proses    
    else{
        $update =mysqli_query($conn, "UPDATE transaksi SET status='Kembali', qty='$qty', TglKembali='$tgl' WHERE IdTransaksi ='$IdTransaksi'");
            if($update){
                //update stok
                $apstok= mysqli_query($conn, "UPDATE barang SET BrgJumlah='$nambah' WHERE IdBarang='$IdBarang'");
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
    header("location: transaksi-pengembalian.php");
?> 
<!-- <script type="text/javascript">
	alert("Proses Pengembalian Buku Berhasil");
    window.location.href = "transaksi-peminjaman.php";
</script> -->