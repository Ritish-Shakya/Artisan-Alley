<nav class="navbar navbar-expand-lg sticky-top bg-body-tertiary py-3" data-bs-theme="light" >
  <div class="container-fluid">
    <a class="navbar-brand ml-5" href="/4th_sem">Artisans Alley</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent" style="width:80%;">
      <ul class="navbar-nav ms-auto mb-2 mx-4 mb-lg-0" >
      <li class="nav-item me-5">
      <form class="d-flex" role="search" style="width:45rem;" action="searchResult.php" method="post">
        <input class="form-control me-2 ms-5 " name="search" style="width:90%" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-secondary" type="submit">Search</button>
      </form>
    </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/4th_sem">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="displayCart.php">Carts</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categories
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="singingCategory.php">Singing Bowl</a></li>
            <li><a class="dropdown-item" href="woodCategory.php">Wood Products</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <?php  if(isset($_SESSION['username'])){?>
         <?php echo($_SESSION['username']) ?>
          <?php }else{?>
            Login
         <?php }?>
          </a>
          <ul class="dropdown-menu">
          <?php  if(isset($_SESSION['username'])){?>
            <li><a class="dropdown-item" href="showOrder.php">My Orders</a></li>
            <li><a class="dropdown-item" href="backend/logoutApi.php">Logout</a></li>
            <?php }else{?>
              <li><a class="dropdown-item" href="userLogin.php">Sign In</a></li>
         <?php }?>
          </ul>
        </li>
      </ul>
      

    </div>
  </div>
</nav>

    