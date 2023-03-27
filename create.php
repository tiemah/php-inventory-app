<?php
    require "conn.php";
    require "navbar.php";

    if(isset($_POST['submit'])){

        $pname=mysqli_real_escape_string($conn,$_POST['pname']);
        $price=mysqli_real_escape_string($conn,$_POST['price']);
        $quantity=mysqli_real_escape_string($conn,$_POST['quantity']);

        if(empty($pname)){
            $_SESSION['error_msg']="Please enter product name to proceed!";
        }elseif(empty($price)){
            $_SESSION['error_msg']="Please enter price to proceed!";
        }elseif(empty($quantity)){
            $_SESSION['error_msg']="Please enter quantity to proceed!";
        }elseif(!is_numeric($quantity)){
            $_SESSION['error_msg']="Only numbers are allowed in the quantity field!";
        }else{
            $query=mysqli_query($conn,"INSERT INTO products (product_name,price,quantity)VALUES('$pname','$price','$quantity')");

            if($query){
                if(!headers_sent()){
                    $_SESSION['success_msg']="Product added successfully!";
                }
                header("Location:index.php");
            }else{
                $_SESSION['error_msg']="Unable to insert record!";
            }
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
<title>New Product</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>
<body>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">

            </div>
            <div class="col-lg-4">
                <h2 class="mt-3">Add Product</h2><br>
                <?php if(isset($_SESSION['error_msg'])): ?>
                <div class="alert alert-danger" role="alert">
                    <?=$_SESSION['error_msg']?>
                    <?php unset($_SESSION['error_msg'])?>
                </div>
                <?php endif; ?>
                <form action="" method="post">
                <label for="fname">Product name</label><br>
                <input type="text" id="pname" name="pname" value="<?php if(isset($pname)){ echo $pname; } ?>" class="form-control"><br>
                <label for="price">Price</label><br>
                <input type="text" id="price" name="price" value="<?php if(isset($price)){ echo $price; } ?>" class="form-control"><br>
                <label for="quantity">Quantity</label><br>
                <input type="text" id="quantity" name="quantity" value="<?php if(isset($quantity)){ echo $quantity; } ?>" class="form-control"><br><br>
                <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                </form> 
            </div>
            
        
        </div>
        
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>

</body>
</html>