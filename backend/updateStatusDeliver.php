<?php
include "../config/db.php";
$order_id = $_GET['order_id'];

$query = "SELECT * FROM order_details where order_id ='$order_id'";
$q_result = mysqli_query($conn,$query);
 while($row = mysqli_fetch_assoc($q_result)){
    $order_status = $row['order_status'];
    if($order_status!='cancelled'){
        
        $sql = "Update order_details set order_status='in_delivery' where order_id = '$order_id'";
        $result = mysqli_query($conn,$sql);
        if($result){

            header('location:../Admin/orderdisplayAdmin.php');
        }    
}else{
header('location:../Admin/orderdisplayAdmin.php?statuss=true');
}
}

?>