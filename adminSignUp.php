<?php
if(isset($_GET['condition'])){  
?>
<script>alert("user already exists")</script>
<?php
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="Assets/style.css">
    <title>Admin | Signup</title>
</head>
<body>
    <div class="container">
        
            <div class="card" id="login-card">
                <form action="backend/adminSignupApi.php" method="post" style="margin-left:1rem">
                <h3 class="login-head">Admin Signup</h3>
                    <label for="customer_name">Username:</label><br>
                    <input type="text" name="user_name" id="username" required><br><br>
                    <label for="password">Password:</label><br>
                    <input type="password" name="password" id="password" required>
                    <br><br>
                    <label for="email">Email:</label><br>
                    <input type="email" name="email" id="password" required>
                    <br><br>
                    
                    
                    <input type="submit" value="Sign Up" class="btn btn-primary" id="login-btn">
                </form>
            </div>
        </div>
        

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>
</html>