<?php
    require "conn.php";

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
</head>
<body>
    <a href="create.php">Add product</a>
    <table border="1">
        <tr>
            <td><b>Product ID</b></td>
            <td><b>Product Name:</b></td>
            <td><b>Price:</b></td>
            <td><b>Quantity:</b></td>
            <td></td>
            <td></td>
        </tr>
        <?php if(mysqli_num_rows($res)): ?>
          <?php foreach($res as $row): ?>
              <tr>
              <td><?=$row['product_id']?></td>
              <td><?=$row['product_name']?></td>
              <td><?=$row['price']?></td>
              <td><?=$row['quantity']?></td>
              <td><a href="edit.php?product_id=<?=$row['product_id']?>">Edit</a></td>
              <td><a href="index.php?product_id=<?=$row['product_id']?>">Delete</a></td>
              </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <h3>No Records!</h3>
        <?php endif; ?>
    </table>
    
</body>
</html>