<?php
    require "conn.php";
    require "includes/functions.php";
   
    if(isset($_POST['submit'])){

        $full_name=$_POST['name'];
        $email=$_POST['email'];
        $password=$_POST['password'];

        $password_hash=password_hash($password, PASSWORD_DEFAULT);

        $query=mysqli_query($conn,"INSERT INTO users(full_name,email,password_hash)VALUES('$full_name', '$email','$password_hash')") or die(mysqli_error($conn));

        if($query){

          $subject="Registration Successful!";
          $message="Thank you for signing up in our service";

          if(SendMail($subject,$message)){

            if(!headers_sent()){
              $_SESSION['success_msg']="Registration successful. Check your email for more details!";
              header("Location:login.php");
            }
          }else{
            if(!headers_sent()){

              $_SESSION['error_msg']="Registration successful.But welcome email was not sent. Please contact support!";
              header("Location:login.php");
            }
          }
        }else{
            echo "Registration failed,please try again!";
        }

    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  </head>
  <body>
    <div class="container-fluid">
      <h1 class="mt-5"> Register</h1>
      <form method="post" action="">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text"></div>
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text"></div>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
      </div>
      
      <button type="submit" name="submit" class="btn btn-primary">Register</button>
    </form>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    </body>
  </div>
</html>