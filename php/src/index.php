
<?php 
 
 include 'config.php';
  
 error_reporting(0);
  
 session_start();
  
 if (isset($_SESSION['username'])) {
     header("Location: dashboard.php");
 }
  
 if (isset($_POST['submit'])) {
     $email = $_POST['email'];
     $password = md5($_POST['password']);
  
     $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
     $result = mysqli_query($conn, $sql);
     if ($result->num_rows > 0) {
         $row = mysqli_fetch_assoc($result);
         $_SESSION['username'] = $row['username'];
        // header("Location: dashboard.php");
         // arahkan ke halaman index pasca login
			echo "<script> alert('selamat datang ".$_SESSION['username']."'); window.location.href='dashboard.php'; </script>";
     } else {
         echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!')</script>";
     }
 }
  
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css" />
  <title>Login</title>
</head>

<body>
<div class="alert alert-warning" role="alert">
        <?php echo $_SESSION['error']?>
    </div>

  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
      <form action="" method="POST" class="sign-in-form">
          <h1 class="title">Welcome Back!</h1>
          <h2 class="title">Login</h2>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
          </div>
         
          <button name="submit" class="btn">Login</button>
          
          <p class="login-register-text">Don't have an account ? <a href="register.php">Register </a></p>
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h1>Sistem Informasi Peminjaman Barang</h1>
          <p>
            SMK Negeri 1 Turen
          </p>
        </div>
        <img src="img/login.svg" class="image" alt="" />
      </div>
    </div>
  </div>

  <script src="app.js"></script>
</body>

</html>