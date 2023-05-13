
<?php
    if(!isset($_SESSION["authenticated"]))
    {
        $_SESSION["message"] = "You are not allowed to access this page. Login!";
        header("location:../forms/login.php");
    }

    $user_id = $_SESSION['auth_user']['user_id'];

    $sqlcount = "SELECT * FROM `product` where user_id='$user_id'";
$resultcount = mysqli_query($conn , $sqlcount);
$count = mysqli_num_rows($resultcount);

?>
      
      <!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
      <header class="navbar d-block navbar-sticky navbar-expand-lg navbar-light bg-light">
        <div class="container"><a class="navbar-brand d-none d-sm-block me-4 order-lg-1" href="../index.php"><img src="../img/unnmarketplace.png" width="142" alt="online marketplace for unn community"></a><a class="navbar-brand d-sm-none me-2 order-lg-1" href="./index.php"><img src="../img/unnmarketplace.png" width="74" alt="emcee"></a>
          <div class="navbar-toolbar d-flex align-items-center order-lg-3">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"><span class="navbar-toggler-icon"></span></button><a class="navbar-tool d-none d-lg-flex" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#searchBox" role="button" aria-expanded="false" aria-controls="searchBox"><span class="navbar-tool-tooltip">Search</span>
              <div class="navbar-tool-icon-box"><i class="navbar-tool-icon ci-search"></i></div></a>
           <a class="btn btn-sm btn-accent rounded-1 ms-lg-4 ms-3" href="./additem.php">ADD</a>
          </div>
          <div class="collapse navbar-collapse me-auto order-lg-2" id="navbarCollapse">
            <!-- Search (mobile)-->
            <div class="d-lg-none py-3">
              <div class="input-group"><i class="ci-search position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                <input class="form-control rounded-start" type="text" placeholder="What do you want?">
              </div>
            </div>
            <!-- Primary menu-->
            <ul class="navbar-nav">
              <li class="nav-item dropdown"><a class="nav-link" href="../index.php">Home</a></li>
              <li class="nav-item"><a class="nav-link" href="../shop.php">Shop</a></li>
              <!--<li class="nav-item"><a class="nav-link" href="../vendors.php">Vendors</a></li>-->
            </ul>
          </div>
        </div>
        <!-- Search collapse-->
        <div class="search-box collapse" id="searchBox">
          <div class="container py-2">
            <div class="input-group"><i class="ci-search position-absolute top-50 start-0 translate-middle-y ms-3"></i>
              <input class="form-control rounded-start" type="text" placeholder="What do you need?">
            </div>
          </div>
        </div>
      </header>
      <div class="page-title-overlap bg-accent pt-4">
        <div class="container d-flex flex-wrap flex-sm-nowrap justify-content-center justify-content-sm-between align-items-center mb-2 pt-2" >
          <div class="d-flex align-items-center">
            <div class="img-thumbnail rounded-circle position-relative flex-shrink-0" style="width: 6.375rem;"><img class="rounded-circle" src="../profile_image/<?php if($userimage != null){ echo $userimage; }else{ echo "logo.png"; } ?>" alt="<?php echo $username;?> logo "></div>
            <div class="ps-3">
              <h3 class="h5 mb-2 text-light">@<?php echo $username;?></h3><span class="d-block text-light fs-sm opacity-60">Member since <?php echo date('M j',strtotime($userdate)); ?></span>
            </div>
          </div>
          <div class="my-sm-0 my-3 text-sm-end pt-1">
            <div class="d-flex align-items-center text-nowrap fs-sm">
              <div class="mb-2 me-sm-3 me-2 text-muted"><span class='fw-medium text-light'><?php echo $userpage; ?></span> <span class='text-white opacity-70'>Page Views</span></div>
              <div class="mb-2 ps-sm-3 ps-2 border-start border-light text-muted"><span class='fw-medium text-light'><?php echo $count; ?></span> <span class='text-white opacity-70'>Products</span></div>
            </div>
          </div>
        </div>
      </div>