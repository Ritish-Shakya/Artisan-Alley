<?php
include "../config/db.php";
$order_id = $_GET['order_id'];

$sql = "select * from order_details where order_id = '$order_id' ";
$result = mysqli_query($conn,$sql);




while($row=mysqli_fetch_assoc($result)){
    $status = $row['order_status'];
    if($status=='Pending'){
        $query = "update order_details set order_status = 'cancelled' where order_id = '$order_id'";
        $q_result = mysqli_query($conn,$query);
    
        if($q_result){
            header('location:../showOrder.php?success=true');
        }
    }else if($status=='cancelled'){
        header('location:../showOrder.php?status=true');

    }
    else{
        header('location:../showOrder.php?cancel=false');
    }
    
}



?>