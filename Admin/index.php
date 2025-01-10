<?php
session_start();
if(isset($_SESSION['admin_username'])){
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Artisans Alley</title>
    <link rel="stylesheet" href="../Assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href=//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css>

  </head>

  <style>
    .card{
    height: 12rem;
    width: 13rem;
    background: #FFFFFF;
    border: 3px solid black;
    border-radius: 8px;
    
}
.main-container{
  width: 75%;
  height: 80vh;
  display: flex;
  justify-content: space-around;
  flex-wrap: wrap;
  margin-top: 8rem;
  margin-left:10rem;
    
}
.cus{
  margin-top:2rem;
  color:grey;
  font-size:20px;
}
.cos{
  margin-top:2rem;
  color:grey;
  font-size:20px;

}
.skn{
  margin-top:2rem;
  color:grey;
  font-size:20px;
}
.orders{
  margin-top:2rem;
  color:grey;
  font-size:20px;
}
.coss{
  width:15%;
  height:30px;
}
.skinn{
  width:15%;
  height:30px;
}
.cuss{
  width:15%;
  height:30px;
}
.ord{
  width:15%;
  height:30px;
}

  </style>
  <body>
    <?php 
    include '../components/AdminNav.php';
   include '../backend/showdata.php';

    
    ?>
    
    <div class="main-container">

    <div class="card">
                <center>
                    <h3 class="cus">Customer</h3><br>
                    <img src="../assets/images/cusicon.png" class="cuss">
                    <p><?php echo($total_customer)  ?></p>
                </center>
            </div>
            
            <div class="card">
                <center>
                    <h3 class="cos">Singing Bowl</h3><br>
                   <img src="../assets/images/cosicon.png" class="coss">
                    <p><?php echo($total_cosmetics)?></p>
            </div>
            </center>
            <div class="card">
                <center>
                    <h3 class="skn">Wood Products</h3>
                    <br>
                    <img src="../assets/images/skinlogo.png" class="skinn">
                    <p><?php echo($total_skin)?></p>
                </center>
            </div>
            <div class="card">
                <center>
                    <h3 class="orders">Orders</h3>
                    <br>
                    <img src="../assets/images/ordericon.png" class="ord">
                    <p><?php echo($total_orders)?></p>
                </center>
            </div>



      
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
