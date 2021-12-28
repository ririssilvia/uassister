<?php
  include'config.php';

    $IdSiswa = $_POST['IdSiswa']; 
    $SwNama = $_POST['SwNama']; 
    $SwKelas = $_POST['SwKelas']; 
    $SwNoHp = $_POST['SwNoHp'];

  if(isset($_POST['simpan'])) {
    extract($_POST);
    mysqli_query($conn,
      "UPDATE siswa
      SET IdSiswa='$IdSiswa', SwNama='$SwNama', SwKelas='$SwKelas', SwNoHp='$SwNoHp'
      WHERE IdSiswa = '$IdSiswa'"
    );
    header("location: siswa.php");
  }else {
    header("location: siswa-edit.php");
  }
?>