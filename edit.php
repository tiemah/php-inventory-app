<?php
    require "conn.php";
    require "navbar.php";

    $product_id=$_GET['product_id'];

    $res=mysqli_query($conn,"SELECT * FROM products WHERE product_id='$product_id'");

    $row=mysqli_fetch_array($res);

    if(isset($_POST['submit'])){

        $product_name=mysqli_real_escape_string($conn,$_POST['product_name']);
        $price=mysqli_real_escape_string($conn,$_POST['price']);
        $quantity=mysqli_real_escape_string($conn,$_POST['quantity']);
        if(empty($product_name)){
            $_SESSION['error_msg']="Please enter product name to proceed!";
        }elseif(empty($price)){
            $_SESSION['error_msg']="Please enter price to proceed!";
        }elseif(empty($quantity)){
            $_SESSION['error_msg']="Please enter quantity to proceed!";
        }elseif(!is_numeric($quantity)){
            $_SESSION['error_msg']="Only numbers are allowed in the quantity field!";
        }else{
        $query=mysqli_query($conn,"UPDATE products SET product_name='$product_name',price='$price',quantity='$quantity' WHERE product_id='$product_id'")or die(mysqli_error($conn));

        if($query){

            if(!headers_sent()){
                $_SESSION['success_msg']="Product updated successfully!";
            }

            header("Location:index.php");
        }else{
            $_SESSION['error_msg']="Unable to update record!";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit product</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>
<body>
    <div class="row">
        <div class="col-lg-4">
    </div>          
    <div class="col-lg-4">
        <h2 class="mt-4">Edit product</h2>
        <?php if(isset($_SESSION['error_msg'])): ?>
        <div class="alert alert-danger" role="alert">
            <?=$_SESSION['error_msg']?>
            <?php unset($_SESSION['error_msg'])?>
        </div>
        <?php endif; ?>
        <form action="" method="post">
        <label for="product_name">Product name</label><br>
        <input type="text" id="pname" name="product_name"  class="form-control" value="<?php echo $row['product_name'];?>"><br>
        <label for="price">Price</label><br>
        <input type="text" id="price" name="price" class="form-control" value="<?php echo $row['price'];?>"><br>
        <label for="price">Quantity</label><br>
        <input type="text" id="quantity" name="quantity"  class="form-control" value="<?php echo $row['quantity'];?>"><br><br>
        <input type="submit" name="submit" class="btn btn-primary" value="Update">
        </form>
</div>
</div> 

</body>
</html>