<?php
include '../config/db.php';



// $customer_id = $_SESSION['customer_id'];
$sql = "SELECT count(customer_id) as total_customer FROM customer_details";
$result = mysqli_query($conn,$sql);

$cosmetic_query = "SELECT count(product_id) as total_cosmetics FROM product_details where category='singing'";
$skin_query = "SELECT count(product_id) as total_skin FROM product_details where category='wood'";
$order_query = "SELECT count(order_id) as total_orders FROM order_details";

$result2= mysqli_query($conn,$cosmetic_query);
$result3= mysqli_query($conn,$skin_query);
$result4= mysqli_query($conn,$order_query);


    while($row=mysqli_fetch_assoc($result)){
    $total_customer = $row['total_customer'];
    }
    while($row=mysqli_fetch_assoc($result2)){
        $total_cosmetics = $row['total_cosmetics'];
    }
    while($row=mysqli_fetch_assoc($result3)){
        $total_skin= $row['total_skin'];
    }
    while($row=mysqli_fetch_assoc($result4)){
        $total_orders= $row['total_orders'];
    }
      







?>