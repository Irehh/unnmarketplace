<?php

session_start();
include("config.php");
$conn = db();
$in= $inf=$info = "";

$query = "SELECT * FROM product WHERE 1";

if(isset($_GET['search'])){
    $search = safe($_GET['search']);
    $query .= " AND CONCAT(name,DESCP) LIKE '%$search%'";
    $in .= " $search";
  }
  
if(isset($_GET['submit'])){

  if(isset($_GET['search'])){
    $search = safe($_GET['search']);
    $query .= " AND CONCAT(name,DESCP) LIKE '%$search%'";
    $in .= " $search";
  }
  
  if(isset($_GET['type'])){
    $type = safe($_GET['type']);
    $query .= " AND type='$type'";
    $inf .= " $type";
  }
  
  if(isset($_GET['category'])){
    $category = safe($_GET['category']);
    $query .= " AND category='$category'";
    $info .= " $category";
  }

}


$query .= " ORDER BY date DESC";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Catalog - Find items up for sell </title>
    <!-- SEO Meta Tags-->
    <meta name="description" content="Catalog | Buy & Sell Anything Online. Products catalog from different sellers">
    <meta name="keywords" content="unnmarketplace, unn online store, chairs, shop, e-commerce, market, honest, dealer, fashion, bags, Products catalog from different vendors">
    <meta name="author" content="Truth">
    <meta property="og:title"         content="Come sell with us!" />
    <meta property="og:description"   content="Find what you are looking for" />
    <meta property="og:image"         content="http://localhost/unnmarketplace/img/UNN_Fountain.png" />
    <!-- Viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon and Touch Icons-->
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="mask-icon" color="#fe6a6a" href="./img/icon/unnmarketplace logo.svg">
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
        <div class="container"><a class="navbar-brand d-none d-sm-block me-4 order-lg-1" href="./index.php"><img src="img/unnmarketplace.png" width="142" alt="unnmarketplace"></a><a class="navbar-brand d-sm-none me-2 order-lg-1" href="./index.php"><img src="img/unnmarketplace.png" width="74" alt="unnmarketplace logo"></a>
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
               <a class="navbar-tool ms-lg-2" href="admin/admin.php"><span class="navbar-tool-tooltip">Dashboard</span>
                <div class="navbar-tool-icon-box"><i class="navbar-tool-icon ci-user"></i></div></a>
              <?php endif ?>
              <?php if((!isset($_SESSION["authenticated"])) && (!isset($_SESSION["admin"])))
              :?>
                <a class="navbar-tool ms-lg-2 btn btn-sm btn-accent rounded-1 ms-lg-4 ms-3" href="forms\register.php"><span class="navbar-tool-tooltip">Sign Up</span>
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
                  <li class="breadcrumb-item"><a class="text-nowrap" href="index.php"><i class="ci-home"></i>Home</a></li>
                  <li class="breadcrumb-item text-nowrap"><a href="#">Catalog</a>
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
        <form action="<?php  echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="GET">
        <div class="bg-light shadow-lg rounded-3 p-4 mt-n5 mb-4">
          <div class="row gy-3 gx-4 justify-content-between">
            <div class="col-lg-2 col-md-3 col-sm-5 col-12 order-md-1 order-sm-2 order-3">
              <div class="dropdown"><a class="btn btn-outline-secondary dropdown-toggle w-100" href="#shop-filters" data-bs-toggle="collapse"><i class="ci-filter me-2"></i>Filters</a></div>
            </div>
            
            <div class="col-md col-12 order-md-2 order-sm-1 order-1">
            <div class="input-group">
                <input class="form-control pe-5 rounded" type="text"  name="search" value="<?php  if(isset($_GET['search'])){ echo $_GET['search']; } ?>" placeholder="search for name of product" maxlength="30"><i  class="ci-search position-absolute top-50 end-0 translate-middle-y zindex-5 me-3"></i>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-7 col-12 order-md-3 order-sm-3 order-2">
              <div class="d-flex align-items-center flex-shrink-0">
                <label class="form-label mb-0 me-2 pe-1 fw-normal text-nowrap d-sm-block d-none">Sort by:</label>
                <select name="type" class="form-select">
                  <option selected disabled>Type</option>
                  <option value="Used">Fairly Used</option>
                  <option value="New">New</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md col-12 order-md-2" style="margin-top: 2px;">
          <div><button class="btn btn-outline-accent w-100" type="submit" name="submit"><i class="ci-search me-2"></i>Submit</button></div>
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
                            <input class="form-check-input" name="category" value="uncategorized" type="checkbox" id="uncategorized">
                            <label class="form-check-label" for="Uncategorized">Uncategorized</label>
                          </div>
                        </li>
                        <li class="d-flex justify-content-between align-items-center mb-1">
                          <div class="form-check">
                            <input class="form-check-input" name="category" value="Housing" type="checkbox" id="Housing">
                            <label class="form-check-label" for="Housing">Housing</label>
                          </div>
                        </li>
                        <li class="d-flex justify-content-between align-items-center mb-1">
                          <div class="form-check">
                            <input class="form-check-input" name="category" value="HomeFurniture" type="checkbox" id="HomeFurniture">
                            <label class="form-check-label" for="HomeFurniture">Furniture & Decor</label>
                          </div>
                        </li>
                        <li class="d-flex justify-content-between align-items-center mb-1">
                          <div class="form-check">
                            <input class="form-check-input" name="category" value="Gadgets" type="checkbox" id="Gadgets">
                            <label class="form-check-label" for="Gadgets">Gadgets</label>
                          </div>
                        </li>
                        <li class="d-flex justify-content-between align-items-center mb-1">
                          <div class="form-check">
                            <input class="form-check-input" name="category" type="checkbox" value="Services" id="Services">
                            <label class="form-check-label" for="Services">Services</label>
                          </div>
                        </li>
                        <li class="d-flex justify-content-between align-items-center mb-1">
                          <div class="form-check">
                            <input class="form-check-input" name="category" type="checkbox" value="Books" id="Books">
                            <label class="form-check-label" for="Books">Books</label>
                          </div>
                        </li>
                        <li class="d-flex justify-content-between align-items-center mb-1">
                          <div class="form-check">
                            <input class="form-check-input" name="category" value="Free" type="checkbox" id="Free">
                            <label class="form-check-label" for="Free">Free</label>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
        </div>
        </form>
        <p><?php echo "Showing result for $in, $inf, $info sort by latest "; ?></p>
        <!-- Products grid-->
        <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 gy-sm-4 gy-3 pt-sm-3">


          <!-- Product from search-->
      <?php 
             if((isset($_GET['submit'])) || isset($_GET['search'])){
              $results = mysqli_query($conn , $query);
              if(mysqli_num_rows($results) > 0){
              while($rows = mysqli_fetch_assoc($results)){
      ?>

                 
          <div class="col mb-2" style="max-width:50%;">
            <article class="card h-100 border-0 shadow">
              <div class="card-img-top position-relative overflow-hidden"><a class="d-block" href="productdetails.php?id=<?php echo safe($rows['id']); ?>"><img style="max-height:312.66px!important;" src="images/<?php echo safe($rows['image']); ?>" loading="lazy" alt="<?php echo safe($rows['name']); ?>"></a>
              <!-- Category-->
              <div class="badge bg-info m-3 fs-sm position-absolute top-0 start-0 zindex-5"><?php echo safe($rows['category']); ?>
                </div>
                <!-- type-->
                <div class="badge bg-dark m-3 fs-sm position-absolute top-0 end-0"  data-bs-toggle="tooltip" data-bs-placement="left" title="fairly used item" style="margin: 12px;"><?php echo safe($rows['type']); ?></div>
              </div>
              <div class="card-body">
                <h3 class="product-title mb-2 fs-base"><a class="d-block text-truncate" href="#"><?php echo safe($rows['name']); ?></a></h3><span class="fs-sm text-muted">Price:</span>
                <div class="d-flex align-items-center flex-wrap">
                  <h4 class="mt-1 mb-0 fs-base text-darker"><span style="color: red;">&#8358;</span><?php echo safe($rows['amount']) ?? "nothing to see"; ?></h4>
                </div>
              </div>
            </article>
          </div>

          <?php }  } } else{
                 $results = mysqli_query($conn , $query);
              if(mysqli_num_rows($results) > 0){  
              while($rows = mysqli_fetch_assoc($results)){
      ?>
          <div class="col mb-2" style="max-width:50%;">
            <article class="card h-100 border-0 shadow">
              <div class="card-img-top position-relative overflow-hidden"><a class="d-block" href="productdetails.php?id=<?php echo safe($rows['id']); ?>"><img style="max-height:312.66px!important;" src="images/<?php echo safe($rows['image']); ?>" alt="<?php echo safe($rows['name']); ?>"></a>
              <!-- Category-->
              <div class="badge bg-dark m-3 fs-sm position-absolute top-0 start-0 zindex-5"><?php echo safe($rows['category']); ?>
                </div>
                <!-- type-->
                <div class="badge bg-dark m-3 fs-sm position-absolute top-0 end-0"  data-bs-toggle="tooltip" data-bs-placement="left" title="fairly used item" style="margin: 12px;"><?php echo safe($rows['type']); ?></div>
              </div>
              <div class="card-body">
                <h3 class="product-title mb-2 fs-base"><a class="d-block text-truncate" href="productdetails.php?id=<?php echo safe($rows['id']); ?>"><?php echo safe($rows['name']); ?></a></h3><span class="fs-sm text-muted">Current Price:</span>
                <div class="d-flex align-items-center flex-wrap">
                  <h4 class="mt-1 mb-0 fs-base text-darker"><span style="color: red;">&#8358;</span><?php echo safe($rows['amount'])?? "nothing to see"; ?></h4>
                </div>
              </div>
            </article>
          </div>

          <?php }  } }?>

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