<?php 
 
session_start();
session_destroy();
 
// header("Location: index.php");
echo "<script> alert('Anda Berhasil Logout '); window.location.href='index.php'; </script>";
 
?>