<?php
session_start();
if(isset($_SESSION['admin_username'])){
   // $user_id = $_SESSION['user_id'];
    include "../config/db.php";
    $query = "select * from customer_details";
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
    <div class="main-container">
    <?php 
    include '../components/AdminNav.php';
    ?>
    <?php 
        $count =0; 
        ?>
        <div class="container mt-5">
            <center><h3> Registered Users List</h3></center><br><br>
            <table class="table table-striped" id="cart_tbl">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Customer Address</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Username</th>
                       
                      
                    </tr>
                </thead>
                <tbody>
                   
                    <?php  while ($row = mysqli_fetch_assoc($query_result)) {
                        $count=$count+1;
                        $customer_name= $row['customer_name'];
                        $customer_address = $row['address'];
                        $contact = $row['contact_no'];
                        $username= $row['username'];
                       
                    ?>
                        <tr>
                            <th scope="row"><?php echo($count); ?></th>
                           
                            <td><?php echo($customer_name); ?></td>
                            <td>
                                <?php echo($customer_address) ?>
                            </td>
                            <td> <?php echo($contact)  ?></td>
                            <td><?php echo($username) ?></td>
                            
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
