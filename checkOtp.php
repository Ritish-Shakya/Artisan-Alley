<?php
include "backend/sendEmail.php";

$customer_name = $_POST['customer_name'];
$address = $_POST['address'];
$username = $_POST['username'];
$password = $_POST['password'];
$contact = $_POST['contact'];
$email = $_POST['email'];

function generateOTP()
{
    return rand(100000, 999999);
}

$generated_otp = generateOTP();
$email_status = sendEmail($email, $customer_name, "OTP CODE", "Your OTP code is: " . $generated_otp);


?>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="Assets/style.css">
<form action="backend/userSignupApi.php" method="post">
    <div class="mb-3 col-4 border p-3 mx-auto mt-5 shadow-sm">
        <h3 class="text-center p-2">OTP Verification</h3>
        <label for="exampleInputPassword1" class="form-label">Enter OTP:</label>
        <input type="text" class="form-control" id="exampleInputPassword1" name="user_otp"><br>

        <!-- Hidden Fields -->
        <input type="text" name="customer_name" id="username" value="<?php echo($customer_name) ?>" hidden required>
        <input type="text" name="address" id="password" value="<?php echo($address) ?>" hidden required>
        <input type="text" name="contact" id="password"  value="<?php echo($contact) ?>" pattern="^[0-9]{10}$" hidden required>
        <input type="email" name="email" id="password" value="<?php echo($email) ?>" hidden required>
        <input type="text" name="username" id="password" value="<?php echo($username) ?>" hidden required>
        <input type="password" name="password" id="password" value="<?php echo($password) ?>" hidden required>
        <input type="text" name="otp" id="password" value="<?php echo($generated_otp) ?>" hidden required>

        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>