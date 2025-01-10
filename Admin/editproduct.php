<?php
session_start();
if(isset($_SESSION['admin_username'])){
    ?>
   

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Artisans Alley</title>
    <link rel="stylesheet" href="../Assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href=//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css>

  </head>
  <style>

    .updt{
        margin-top: 2rem;
        margin-left:30rem;
    }

    .main-container{
        width:30%;
        height:450px;
        border:1px solid grey;
        margin-left: 28rem;
        border-radius:7px;

    }
    .inside{
        margin-left:4rem;
        margin-top:2rem;
    }
    .detail{
        width:80%
    }
    #login-btn{
        width: 80%
    }
    </style>

  <body>
    <?php 
    include '../components/AdminNav.php';
    include '../config/db.php';
    $product_id = $_GET['product_id'];

    $sql = "SELECT * FROM product_details where product_id='$product_id'";
    $result= mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        $product_id=$row['product_id'];
        $product_image = $row['product_image'];
        $product_name= $row['product_name'];
        $product_category = $row['category'];
        $quantity = $row['product_qty'];
        $product_price = $row['product_price'];
        $product_desc=$row['product_desc'];

        ?>
       
    

    <h2 class="updt"> Update Product Details</h2>
    <div class="main-container">
        <div class="inside">
        <form action="../backend/updateproductApi.php" method="post">
            <input type="text" placeholder="Product Name" value='<?php echo($product_name) ?>' name="product_name" class="detail"><br><br>
            <select name="category" class="detail">
                    <option value="1">Select Category</option>
                    <option value="cosmetic">Cosmetics</option>
                    <option value="skinCare">Skin Care Products</option>
                </select><br><br>
            <input type="number" name="product_quantity" placeholder="Quantity" class="detail" value='<?php echo($quantity)?>'><br><br>
            <input type="number" name="product_price" placeholder="Price" class="detail" value='<?php echo($product_price)?>'><br><br>
            <textarea name="product-desc"  cols="52" rows="3" class="detail"><?php echo($product_desc)?></textarea><br><br>
            <input type="text" value='<?php echo($product_id)?>' hidden name="product_id">
            <input type="submit" value="Update" class="btn btn-primary" id="login-btn">

</form>
</div>

</div>
<?php
    }
    ?>


    
     
<?php
    include "../components/footer.php";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
<?php
}else{
    header('location:AdminLogin.php');
}
?>

