<?php
    require "conn.php";

    if(isset($_POST['submit'])){

        $pname=$_POST['pname'];
        $price=$_POST['price'];
        $quantity=$_POST['quantity'];


        $query=mysqli_query($conn,"INSERT INTO products (product_name,price,quantity)VALUES('$pname','$price','$quantity')");

        if($query){
            header("Location:index.php");
        }else{
            echo "Unable to insert record!";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
<title>New Product</title>
</head>
<body>
<form action="" method="post">
  <label for="fname">Product name:</label><br>
  <input type="text" id="pname" name="pname" value=""><br>
  <label for="price">Price:</label><br>
  <input type="text" id="price" name="price" value=""><br>
  <label for="quantity">Quantity:</label><br>
  <input type="text" id="quantity" name="quantity" value=""><br><br>
  <input type="submit" name="submit" value="Submit">
</form> 
</body>
</html>