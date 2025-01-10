<?php
include "../config/db.php";
session_start();
$product_id = $_GET['product_id'];

$sql = "delete from product_details where product_id = '$product_id' ";
echo($sql);
$result = mysqli_query($conn,$sql);
if($result){
    header('location:../Admin/productdisplay.php');
   
}


?>