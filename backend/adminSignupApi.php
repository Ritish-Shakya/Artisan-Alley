<?php
include "../config/db.php";

    $query = "select username from customer_details";
    $query_result = mysqli_query($conn,$query);


$user_name = $_POST['user_name'];
$pass = $_POST['password'];
$hashed_password = password_hash($pass,PASSWORD_BCRYPT);
$email = $_POST['email'];


$available_status = 0;
    while($row=mysqli_fetch_assoc($query_result)){
        if($username==$row['username']){
            $available_status=1;
            break;
        }
    }
 
   
    if($available_status==0){

$sql = "INSERT INTO user_details(username,password,email_id)values('$user_name','$hashed_password','$email')";

$result = mysqli_query($conn,$sql);

if($result){
header('location:../admin/AdminLogin.php');
}
}
   else{
        header('location:../adminSignUp.php?condition="failed');
    }

?>