<?php
session_start();
if(isset($_SESSION['admin_username'])){
   // $user_id = $_SESSION['user_id'];
    include "../config/db.php";
    $query = "select * from order_details join product_details on 
    order_details.product_id = product_details.product_id join customer_details on customer_details.customer_id = order_details.customer_id order by order_id desc ";
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
  <body>
     

    <?php
    include '../components/AdminNav.php';
    if(isset($_GET['status'])){?>

    <div class="alert alert-danger"> Already cancelled</div>
    
    
    <?php 
}
?>
<?php
if(isset($_GET['statuss'])){?>

<div class="alert alert-danger"> Already on delivery process</div>


<?php 
}
?>
   
    <div class="main-container">
    <?php 
        $count =0; 
        ?>
        <div class="container mt-5 overflow-y-scroll" style='height:28rem' >
            <center><h3> Ordererd Lists</h3></center><br>
            <table class="table table-striped" id="cart_tbl" >
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        
                        <th scope="col">Customer Name</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Ordered_Date</th>
                        <th scope="col">Payment Status</th>
                        <th scope="col">Order Status</th>
                        <th scope="col">Action</th>
                      
                    </tr>
                </thead>
                <tbody>
                   
                    <?php  while ($row = mysqli_fetch_assoc($query_result)) {
                        $count=$count+1;
                        $order_id = $row['order_id'];
                        $customer_name= $row['customer_name'];
                        $product_name = $row['product_name'];
                        $quantity = $row['qty'];
                        $orderdate=$row['ordered_date'];
                        $payment_status = $row['payment_status'];
                        $order_status = $row['order_status'];
                    ?>
                    
                        <tr>
                            <th scope="row"><?php echo($count); ?></th>
                            
                            <td><?php echo($customer_name); ?></td>
                            <td>
                                <?php echo($product_name) ?>
                            </td>
                            <td> <?php echo($quantity)  ?></td>
                            <td> <?php echo($orderdate)  ?></td>
                            <td><?php echo($payment_status) ?></td>
                            <td><?php echo($order_status) ?></td>
                            <td><a href="../backend/updateStatusDeliver.php?order_id=<?php echo($order_id) ?>"><img src="../assets/images/truck.png"width="20" height="20"></a>
                            <a href="../backend/updateStatusComplete.php?order_id=<?php echo($order_id) ?>"><img src="../assets/images/completed.png" width="20" height="20"></a></td>
                           
                        </tr>
                    <?php
                    } ?>
    
                </tbody>
            </table>
          
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    </div>
    <?php
   include "../components/footer.php";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
    
</html>
<?php
}else{
    header('location:Adminlogin.php');
}
?>
