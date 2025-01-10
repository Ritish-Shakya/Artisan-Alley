<nav class="navbar navbar-expand-lg sticky bg-body-tertiary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="../Admin/AdminTest.php">Artisans Alley</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav  me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../Admin/index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../Admin/customerdisplay.php">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../Admin/productdisplay.php">
            Product Details
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../Admin/orderdisplayAdmin.php">Order Details</a>
        </li>
    

        
        <?php
       // session_start();
          if(!isset($_SESSION['admin_username'])){?>
         
         <li class="nav-item ">
          <a class="nav-link" href="../Admin/AdminLogin.php">Login</a>
        </li>
          <?php }else{?>
            <li class="nav-item dropdown ">
        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <?php echo($_SESSION['admin_username']) ?>
         <?php }?>
          </a>
          <ul class="dropdown-menu">
            
            <li><a class="dropdown-item" href="../Admin/adminlogout.php">Logout</a></li>
          </ul>
        </li>
      
      </ul>
   

    </div>
  </div>
</nav>

    