<?php
    //membuat koneksi
    include 'config.php';

    //memasukkan data ke array
    $IdSiswa = $_POST['IdSiswa']; 
    $SwNama = $_POST['SwNama']; 
    $SwKelas = $_POST['SwKelas']; 
    $SwNoHp = $_POST['SwNoHp'];

    //melakukan input
    $sql = "INSERT INTO siswa VALUES('$IdSiswa','$SwNama','$SwKelas','$SwNoHp')"; 
    $query = mysqli_query($conn, $sql); 

    //kembali ke halaman sebelumnya
    header("location: siswa.php");