<?php
  require "conn.php";
 

  //If user is already logged in redirect to index
  if(isset($_SESSION['user_id'])){
     header("Location:index.php");
  }

  if(isset($_POST['submit'])){
      $email=$_POST['email'];
      $password=$_POST['password'];

      $res=mysqli_query($conn,"SELECT * FROM users WHERE email='$email' LIMIT 1") or die(mysqli_error($conn));

      if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_array($res);

        if(password_verify($password,$row['password_hash'])){

          $_SESSION['user_id']=$row['user_id'];
          $_SESSION['full_name']=$row['full_name'];

          header("Location:index.php");
        }else{
          $_SESSION['error_msg']='Invalid login credentials';
        }
      }else{
        $_SESSION['error_msg']='Invalid login credentials';
      } 
  }
  
 ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4">

        </div>
        <div class="col-lg-4">
      <h1 class="mt-5"> Login </h1>

      <?php if(isset($_SESSION['error_msg'])): ?>
      <div class="alert alert-danger" role="alert">
         <?=$_SESSION['error_msg']?>
         <?php unset($_SESSION['error_msg'])?>
      </div>
      <?php endif; ?>
      <form method="post" action="">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text"></div>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
      </div>
      
      <button type="submit" name="submit" class="btn btn-primary">Login</button>
    </form>
</div>
</div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
      
    </body>
 
</html>