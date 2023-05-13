<?php

session_start();
include("config.php");
$conn = db();
$report= $class = "";
error_reporting(0);
$category = safe($_GET['category']);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Emcee | Catalog</title>
    <!-- SEO Meta Tags-->
    <meta name="description" content="Emcee Store | Shoe and Bag Store ">
    <meta name="keywords" content="Emcee store, emcee, shop, e-commerce, market, honest, dealer, fashion, bags, latest bag, latest shoe, women shoe">
    <meta name="author" content="Truth">
    <!-- Viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon and Touch Icons-->
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="mask-icon" color="#fe6a6a" href="safari-pinned-tab.svg">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendor Styles including: Font Icons, Plugins, etc.-->
    <link rel="stylesheet" media="screen" href="vendor/simplebar/dist/simplebar.min.css"/>
    <link rel="stylesheet" media="screen" href="vendor/tiny-slider/dist/tiny-slider.css"/>
    <link rel="stylesheet" media="screen" href="vendor/nouislider/dist/nouislider.min.css"/>
    <!-- Main Theme Styles + Bootstrap-->
    <link rel="stylesheet" media="screen" href="css/theme.min.css">
  </head>
  <!-- Body-->
  <body class="handheld-toolbar-enabled">
    <main class="page-wrapper">
      <!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
      <header class="navbar d-block navbar-sticky navbar-expand-lg navbar-light bg-light">
        <div class="container"><a class="navbar-brand d-none d-sm-block me-4 order-lg-1" href="index.php"><img src="img/unnmarketplace.png" width="142" alt="unnmarketplace"></a><a class="navbar-brand d-sm-none me-2 order-lg-1" href="index.php"><img src="img/unnmarketplace.png" width="74" alt="Emcee store logo"></a>
          <div class="navbar-toolbar d-flex align-items-center order-lg-3">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"><span class="navbar-toggler-icon"></span></button><a class="navbar-tool d-none d-lg-flex" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#searchBox" role="button" aria-expanded="false" aria-controls="searchBox"><span class="navbar-tool-tooltip">Search</span>
              <div class="navbar-tool-icon-box"><i class="navbar-tool-icon ci-search"></i></div></a>
              <?php if(isset($_SESSION["authenticated"]) && (!isset($_SESSION["admin"])))
              :?>
               <a class="navbar-tool ms-lg-2" href="user\dashboard.php"><span class="navbar-tool-tooltip">Dashboard</span>
                <div class="navbar-tool-icon-box"><i class="navbar-tool-icon ci-user"></i></div></a>
              <?php endif ?>
              <?php if(!isset($_SESSION["authenticated"]) && (isset($_SESSION["admin"])))
              :?>
               <a class="navbar-tool ms-lg-2" href="./admin/admin.php"><span class="navbar-tool-tooltip">Dashboard</span>
                <div class="navbar-tool-icon-box"><i class="navbar-tool-icon ci-user"></i></div></a>
              <?php endif ?>
              <?php if((!isset($_SESSION["authenticated"])) && (!isset($_SESSION["admin"])))
              :?>
                <a class="navbar-tool ms-lg-2" href="forms\register.php"><span class="navbar-tool-tooltip">Sign Up</span>
                <div class="navbar-tool-icon-text">Sign Up</div></a>
              <?php endif ?>
          </div>

          <!-- search(mobile collapse) and primary menu -->

          <?php  include "Primarymenu.php";  ?>


      </header>
      <!-- Page Title-->
      <div class="bg-accent pt-4 pb-5">
        <div class="container pt-2 pb-3 pt-lg-3 pb-lg-4">
          <div class="d-lg-flex justify-content-between pb-3">
            <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
                  <li class="breadcrumb-item"><a class="text-nowrap" href="index.html"><i class="ci-home"></i>Home</a></li>
                  <li class="breadcrumb-item text-nowrap"><a href="home-nft.html">Catalog</a>
                  </li>
                  <li class="breadcrumb-item text-nowrap active" aria-current="page">All Product</li>
                </ol>
              </nav>
            </div>
            <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
              <h1 class="h3 text-light mb-0">Catalog</h1>
            </div>
          </div>
        </div>
      </div>
      <div class="container pb-5 mb-2 mb-md-4">
        <!-- Toolbar-->
        <div class="bg-light shadow-lg rounded-3 p-4 mt-n5 mb-4">
          <div class="row gy-3 gx-4 justify-content-between">
            <div class="col-lg-2 col-md-3 col-sm-5 col-12 order-md-1 order-sm-2 order-3">
              <div class="dropdown"><a class="btn btn-outline-secondary dropdown-toggle w-100" href="#shop-filters" data-bs-toggle="collapse"><i class="ci-filter me-2"></i>Filters</a></div>
            </div>
            <div class="col-md col-12 order-md-2 order-sm-1 order-1">
              <div class="input-group">
                <input class="form-control pe-5 rounded" type="text" placeholder="This feature is currently unavailable"><i class="ci-search position-absolute top-50 end-0 translate-middle-y zindex-5 me-3"></i>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-7 col-12 order-md-3 order-sm-3 order-2">
              <div class="d-flex align-items-center flex-shrink-0">
                <label class="form-label mb-0 me-2 pe-1 fw-normal text-nowrap d-sm-block d-none">Sort by:</label>
                <select class="form-select">
                  <option selected disabled>Newest</option>
                  <option>Oldest</option>
                </select>
              </div>
            </div>
          </div>
          <!-- Toolbar with expandable filters-->
          <div class="collapse" id="shop-filters">
            <div class="row g-4 pt-4">
              <div class="col-lg-4 col-sm-6">
                <!-- Categories-->
                <div class="card">
                  <div class="card-body px-4">
                    <div class="widget">
                      <h3 class="widget-title mb-2 pb-1">Categories</h3>
                      <ul class="widget-list list-unstyled">
                        <li class="d-flex justify-content-between align-items-center mb-1">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="all">
                            <label class="form-check-label" for="all">Price</label>
                          </div><span class="fs-xs text-muted">< 20,000</span>
                        </li>
                        <li class="d-flex justify-content-between align-items-center mb-1">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="premium">
                            <label class="form-check-label" for="premium">Price</label>
                          </div><span class="fs-xs text-muted">< 30,000</span>
                        </li>
                        <li class="d-flex justify-content-between align-items-center mb-1">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="art">
                            <label class="form-check-label" for="art">Price</label>
                          </div><span class="fs-xs text-muted">< 50,000</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-sm-6">
              </div>
            </div>
          </div>
        </div>
        <!-- Products grid-->
        <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 gy-sm-4 gy-3 pt-sm-3">
          <!-- Product-->
          <?php 
          if(isset($category)){
              $category = safe($_GET['category']);
              $sqls = "SELECT * FROM product WHERE category='$category' ";
              $results = mysqli_query($conn , $sqls);
              if(mysqli_num_rows($results) > 0){  if($rows = mysqli_fetch_array($results)) {
              while($rows = mysqli_fetch_assoc($results)){
      ?>
          <div class="col mb-2">
            <article class="card h-100 border-0 shadow">
              <div class="card-img-top position-relative overflow-hidden"><a class="d-block" href="productdetails.php?id=<?php echo safe($rows['id']); ?>"><img style="max-height:312.66px!important;" src="images/<?php echo safe($rows['image']); ?>" alt="<?php echo safe($rows['name']); ?>"></a>
              </div>
              <div class="card-body">
                <h3 class="product-title mb-2 fs-base"><a class="d-block text-truncate" href="#"><?php echo safe($rows['name']); ?></a></h3><span class="fs-sm text-muted">Current Price:</span>
                <div class="d-flex align-items-center flex-wrap">
                  <h4 class="mt-1 mb-0 fs-base text-darker"><span style="color: red;">&#8358;</span><?php echo safe($rows['amount']); ?></h4>
                </div>
              </div>
            </article>
          </div>

          <?php } } } }?>
        
        </div>
        <hr class="mt-4 mb-3">
      </div>
    </main>
   <!-- foter file -->
   <?php include "footer.php"; ?>
   
    <!-- Back To Top Button--><a class="btn-scroll-top" href="#top" data-scroll><span class="btn-scroll-top-tooltip text-muted fs-sm me-2">Top</span><i class="btn-scroll-top-icon ci-arrow-up">   </i></a>
    <!-- Vendor scrits: js libraries and plugins-->
    <script src="vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/simplebar/dist/simplebar.min.js"></script>
    <script src="vendor/tiny-slider/dist/min/tiny-slider.js"></script>
    <script src="vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
    <script src="vendor/nouislider/dist/nouislider.min.js"></script>
    <!-- Main theme script-->
    <script src="js/theme.min.js"></script>
  </body>
</html>