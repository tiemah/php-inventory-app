<?php
    require "conn.php";

    $product_id=$_GET['product_id'];

    $res=mysqli_query($conn,"SELECT * FROM products WHERE product_id='$product_id'");

    $row=mysqli_fetch_array($res);

    if(isset($_POST['submit'])){

        $pname=$_POST['product_name'];
        $price=$_POST['price'];
        $quantity=$_POST['quantity'];

        $query=mysqli_query($conn,"UPDATE products SET product_name='$pname',price='$price',quantity='$quantity' WHERE product_id='$product_id'");

        if($query){
            header("Location:index.php");
        }else{
            echo "Unable to update record!";
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
<title>Add Product</title>
</head>
<body>
<form action="" method="post">
  <label for="product_name">Product name:</label><br>
  <input type="text" id="pname" name="pname" value="<?php echo $row['product_name'];?>"><br>
  <label for="price">Price:</label><br>
  <input type="text" id="price" name="price" value="<?php echo $row['price'];?>"><br>
  <label for="price">Quantity:</label><br>
  <input type="text" id="quantity" name="quantity" value="<?php echo $row['quantity'];?>"><br><br>
  <input type="submit" name="submit" value="Update">
</form> 
</body>
</html>