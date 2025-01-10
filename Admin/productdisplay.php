<?php
session_start();
if(isset($_SESSION['admin_username'])){
   
    include "../config/db.php";
    $query = "select * from product_details order by product_id desc";
    $query_result = mysqli_query($conn, $query);
    

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Artisans Alley</title>
    <link rel="stylesheet" href="../Assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <style>
    .btnaddprod{
    width: 15%;
    height: 30px;
    background-color: grey;
    color: black;
    border-style: none;
    border-radius:5px;
    margin-left:55rem;
    margin-bottom:5rem;
    
}
.addpd{
    text-decoration: none;
    color:white;
}
    </style>
  <body>
    <?php 
    include '../components/AdminNav.php';

    if(isset($_GET['status'])){?>

        <div class="alert alert-success">Product Added Successfully!!</div>
        
        
        <?php 
    }
    ?>
    <div class="main-container">
        
        
<?php


        
        // $add_status = $_GET['add_status']
        ?>
    <?php 
        $count =0; 
        ?>
        <div class="container mt-5">
            <center><h3> Products List</h3></center>
            <button class="btnaddprod"><a href="productAdd.php" class="addpd">Add New Product</a></button>
            <table class="table table-striped" id="cart_tbl">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product Image</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Product Category</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th> 
                        <th scope="col">Action</th>
                      
                    </tr>
                </thead>
                <tbody>
                   
                    <?php  while ($row = mysqli_fetch_assoc($query_result)) {
                        $count=$count+1;
                        $product_id=$row['product_id'];
                        $product_image = $row['product_image'];
                        $product_name= $row['product_name'];
                        $product_category = $row['category'];
                        $quantity = $row['product_qty'];
                        $product_price = $row['product_price'];
                        
                    ?>
                        <tr>
                            <th scope="row"><?php echo($count); ?></th>
                           
                            <td><img src="../uploads/<?php echo($product_image) ?>" alt="" width="100" height="100"></td>
                            <td>
                                <?php echo($product_name) ?>
                            </td>
                            <td> <?php echo($product_category)  ?></td>
                            <td><?php echo($quantity) ?></td>
                            <td><?php echo($product_price) ?></td>
                            <td><a href="editproduct.php?product_id=<?php echo($product_id) ?>"><img src="../assets/images/edit.png" width="20" height="20"></a>
                         <a href="../backend/deleteproduct.php?product_id=<?php echo($product_id)?>"><img src="../assets/images/delete.png" width="20" height="20"></a></td> 
                        </tr>
                    <?php
                    } ?>
    
                </tbody>
            </table>
          
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    </div>
    <?php
   //include "../components/footer.php";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
    
</html>
<?php
}else{
    header('location:Adminlogin.php');
}
?>
