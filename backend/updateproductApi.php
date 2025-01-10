<?php
include '../config/db.php';
$product_id=$_POST['product_id'];
$product_name = $_POST['product_name'];
$category = $_POST['category'];
$quantity = $_POST['product_quantity'];
$price = $_POST['product_price'];
$desc= $_POST['product-desc'];
$sql = "UPDATE product_details set product_name='$product_name', category='$category',product_qty='$quantity', product_price='$price',product_desc='$desc' where product_id='$product_id'";
$result=mysqli_query($conn,$sql);

if($result){
    header('location:../Admin/productdisplay.php');
}