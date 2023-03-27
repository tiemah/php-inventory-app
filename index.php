<?php
    require "conn.php";
    require "navbar.php";

    if(isset($_GET['logout'])){
        session_destroy();

        header("Location:login.php");
    }

    // checking for the name of the logged in user
    

      //If user is not logged in redirect to login
    if(!isset($_SESSION['user_id'])){
      header("Location:login.php");
    }

  if(isset($_GET['product_id'])){

    $product_id=$_GET['product_id'];

    $query=mysqli_query($conn,"DELETE FROM products WHERE product_id='$product_id'");

    if($query){
      $res=mysqli_query($conn,"SELECT * FROM products");
    }else{
      echo "Unable to delete the record!";
    }

  }else{
    $res=mysqli_query($conn,"SELECT * FROM products");
  }
?>
<!DOCTYPE html>
<html>
<head>
<title>Products</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>
<body>

    
    <a href="create.php" class="btn btn-primary mt-5 mb-4 mx-2">Add product</a>
    <?php if(isset($_SESSION['error_msg'])): ?>
      <div class="alert alert-danger" role="alert">
         <?=$_SESSION['error_msg']?>
         <?php unset($_SESSION['error_msg'])?>
      </div>
      <?php elseif(isset($_SESSION['success_msg'])): ?>
        <div class="alert alert-success" role="alert">
        <?=$_SESSION['success_msg']?>
        <?php unset($_SESSION['success_msg'])?>
      </div>
      <?php endif; ?>
    <div class="container-fluid">
    <table border="1px" class="table table table-striped">
        <tr>
            <td><b>Product ID</b></td>
            <td><b>Product Name</b></td>
            <td><b>Price</b></td>
            <td><b>Quantity</b></td>
            <td><b>Edit</b></td> 
            <td><b>Delete</b></td>
        </tr>
        <?php if(mysqli_num_rows($res)): ?>
          <?php foreach($res as $row): ?>
              <tr>
              <td><?=$row['product_id']?></td>
              <td><?=htmlentities($row['product_name'])?></td>
              <td><?=$row['price']?></td>
              <td><?=$row['quantity']?></td>
              <td><a href="edit.php?product_id=<?=$row['product_id']?>" class="btn btn-success">Edit</a></td>
              <td><a href="index.php?product_id=<?=$row['product_id']?>" class="btn btn-danger">Delete</a></td>
              </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <h3>No Records!</h3>
        <?php endif; ?>
    </table>
        </div>
    <!-- link to js bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    
</body>
</html>