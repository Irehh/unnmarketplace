<?php

session_start();
include("config.php");
$conn = db();


  ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Product Details</title>
    <!-- SEO Meta Tags-->
    <meta name="description" content="Emcee Store | Shoe and Bag Store ">
    <meta name="keywords" content="Emcee store, emcee, shop, e-commerce, market, honest, dealer, fashion, bags, latest bag, latest shoe, women shoe">
    <meta name="author" content="Truth Irechukwu">
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
    <link rel="stylesheet" media="screen" href="vendor/drift-zoom/dist/drift-basic.min.css"/>
    <!-- Main Theme Styles + Bootstrap-->
    <link rel="stylesheet" media="screen" href="css/theme.min.css">
   
</head>
  <!-- Body-->
  <body class="handheld-toolbar-enabled">
    <main class="page-wrapper">
      <!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
      <header class="navbar d-block navbar-sticky navbar-expand-lg navbar-light bg-light">
        <div class="container"><a class="navbar-brand d-none d-sm-block me-4 order-lg-1" href="index.php"><img src="img/Emceelogo.png" width="142" alt="unnmarketplace"></a><a class="navbar-brand d-sm-none me-2 order-lg-1" href="index.php"><img src="img/Emceelogo.png" width="74" alt="unnmarketplace"></a>
          <div class="navbar-toolbar d-flex align-items-center order-lg-3">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"><span class="navbar-toggler-icon"></span></button><a class="navbar-tool d-none d-lg-flex" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#searchBox" role="button" aria-expanded="false" aria-controls="searchBox"><span class="navbar-tool-tooltip">Search</span>
              <div class="navbar-tool-icon-box"><i class="navbar-tool-icon ci-search"></i></div></a><a class="navbar-tool ms-lg-2" href="#signin-modal" data-bs-toggle="modal"><span class="navbar-tool-tooltip">Account</span>
              <div class="navbar-tool-icon-box"><i class="navbar-tool-icon ci-user"></i></div></a>
          </div>

          <!-- search(mobile collapse) and primary menu -->

          <?php  include "Primarymenu.php";  ?>

      </header>
      <!-- Page Title-->
      <div class="page-title-overlap bg-accent pt-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
          <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
                <li class="breadcrumb-item"><a class="text-nowrap" href="index.html"><i class="ci-home"></i>Home</a></li>
                <li class="breadcrumb-item text-nowrap"><a href="home-nft.html">catalog</a>
                </li>
                <li class="breadcrumb-item text-nowrap active" aria-current="page">Single Item</li>
              </ol>
            </nav>
          </div>
          <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
            <h1 class="h3 text-light mb-0">Single Item</h1>
          </div>
        </div>
      </div>

      <?php  //select data from database
      $id = safe($_GET['id']);
  $change = "SELECT * FROM product WHERE id='$id'";
  $result=mysqli_query($conn,$change);
  while($row=mysqli_fetch_assoc($result)){
  $dname = safe($row['name']);
  $damount = safe($row['amount']);
  $ddesc = safe($row['descp']);
  $dtype = safe($row['type']);
  $dimage1 = safe($row['image']);
  $dcategory = safe($row['category']);
  $diff = safe($row["id"]);
  $timestamp = safe($row["timestamp"]);
  $user_id = safe($row["user_id"]);


 
   ?>
      <!--  main product details -->
      <section class="container pb-md-4">
        <!-- Product-->
        <div class="bg-light shadow-lg rounded-3 px-4 py-lg-4 py-3 mb-5">
          <div class="py-lg-3 py-2 px-lg-3">
            <div class="row gy-4">
              <!-- Product image-->
              <div class="col-lg-6">
                <div class="position-relative rounded-3 overflow-hidden mb-lg-4 mb-2"><img class="image-zoom" src="images/<?php echo $dimage1; ?>" data-zoom="images/<?php echo $dimage1; ?>" alt="Product image">
                  <div class="image-zoom-pane"></div>
                </div>
                <div class="pt-2 text-lg-start text-center">
                  <button class="btn btn-secondary rounded-pill btn-icon me-sm-3 me-2" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Add to Favorites"><i class="ci-heart"></i></button>
                  <button class="btn btn-secondary rounded-pill btn-icon me-sm-3 me-2" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Share"><i class="ci-share-alt"></i></button>
                </div>
              </div>
              <!-- Product details-->
              <div class="col-lg-6">
                <div class="ps-xl-5 ps-lg-3">
                  <!-- Meta-->
                  <h2 class="h3 mb-3"><?php echo $dname; ?></h2>
                  <div class="d-flex align-items-center flex-wrap text-nowrap mb-sm-4 mb-3 fs-sm">
                    <div class="mb-2 me-sm-3 me-2 text-muted">Posted on <?php echo date('M j',strtotime($timestamp)); ?></div>
                    <div class="mb-2 me-sm-3 me-2 ps-sm-3 ps-2 border-start text-muted"><i class="ci-eye me-1 fs-base mt-n1 align-middle"></i>15 views</div>
                    <div class="mb-2 me-sm-3 me-2 ps-sm-3 ps-2 border-start text-muted"><i class="ci-heart me-1 fs-base mt-n1 align-middle"></i>4 favorite</div>
                  </div>
                  <div class="row row-cols-sm-2 row-cols-1 gy-3 gx-4 mb-4 pb-md-2">
                    <!-- Creator-->
                    <div class="col">
                      <div class="card position-relative h-100">
                        <div class="card-body p-3">
                          <h3 class="h6 mb-2 fs-sm text-muted">From</h3>
                          <?php
                          
                          $user_id = safe($row["user_id"]);
                            $usersql = "SELECT name FROM users WHERE id='$user_id' limit 1 ";
                            $userresult = mysqli_query($conn , $usersql);
                              while($userrow = mysqli_fetch_assoc($userresult)){
                                $name = safe($userrow['name']);
                          ?>
                          <div class="d-flex align-items-center"><img class="rounded-circle me-2" src="./img/toonme.jpg" width="32" alt="Avatar"><a class="nav-link-style stretched-link fs-sm" href="">@<?php echo $name; ?></a></div>
                        </div>
                        <?php  } ?>
                      </div>
                    </div>
                    <!-- Collection-->
                    <div class="col">
                      <div class="card position-relative h-100">
                        <div class="card-body p-3">
                          <h3 class="h6 mb-2 fs-sm text-muted">Specification</h3>
                          <div class="d-flex align-items-center"><a class="btn-share btn-instagram me-2 my-2" href="#"><i class="ci-cart"></i><?php echo $dcategory; ?></a><a class="btn-share me-2 my-2" href="#"><i class="ci-cart"></i><?php echo $dtype; ?></a></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Description-->
                  <p class="mb-4 pb-md-2 fs-sm"><?php echo $ddesc; ?></p>
                  <!-- Auction-->
                  <div class="row row-cols-sm-2 row-cols-1 gy-3 mb-4 pb-md-2">
                    <div class="col">
                      <h3 class="h6 mb-2 fs-sm text-muted">Current Price:</h3>
                      <h2 class="h3 mb-1"><span style="color: red;">&#8358;</span><?php echo $damount; ?></h2>
                    </div>
                  </div>
                  <form action="send.php" method="GET">
                    <input style="display: none;" type="number" name="diff" value="<?php echo $diff; ?>" placeholder="<?php echo $diff; ?>">
                    <input style="display: none;" type="text" name="dname"  value="<?php echo $dname; ?>" placeholder="<?php echo $dname; ?>">
                    <button class="btn btn-lg btn-accent d-block w-100 mb-4" type="submit" name="send">BUY NOW</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
     
      
      <!-- same collection-->

      <!-- Product carousel (others shoes)-->
      <section class='container mb-2 py-lg-5 py-4'>
                                <div class='d-flex align-items-center justify-content-between mb-sm-3 mb-2'>
                                  <h2 class='h3 mb-0'>Collection</h2>
                                </div>
                                <!-- Product carousel-->
                                <div class='tns-carousel tns-controls-static tns-controls-outside mx-xl-n4 mx-n2 px-xl-4 px-0'>
                                  <div class='tns-carousel-inner row gx-xl-0 gx-3 mx-0' data-carousel-options='{&quot;items&quot;: 2, &quot;nav&quot;: true, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1,&quot;controls&quot;: false, &quot;gutter&quot;: 0},&quot;500&quot;:{&quot;items&quot; :2},&quot;768&quot;:{&quot;items&quot;:3}, &quot;1100&quot;:{&quot;items&quot;:4}, &quot;1278&quot;:{&quot;controls&quot;: true, &quot;nav&quot;: false, &quot;gutter&quot;: 30}}}'>
          
      <?php

            if($dcategory){
              $collectionsql = "SELECT * FROM `product` WHERE category='$dcategory' ";
              $collectionresult = mysqli_query($conn , $collectionsql);
              if(!empty($collectionresult)){
                while($rowr = mysqli_fetch_array($collectionresult)){ 
                echo  "
                <div class='col py-3'>
                  <article class='card h-100 border-0 shadow'>
                    <div class='card-img-top position-relative overflow-hidden'>
                      <a class='d-block' href='productdetails.php?id=".safe($rowr['id'])."'><img style='max-height:312.66px!important;' src='./images/".safe($rowr['image'])."' alt='Product image'></a>
                    
                      <!-- Wishlist button-->
                      <button class='btn-wishlist btn-sm position-absolute top-0 end-0' type='button' data-bs-toggle='tooltip' data-bs-placement='left' title='Add to Favorites' style='margin: 12px;'><i class='ci-heart'></i></button>
                    </div>
                    <div class='card-body'>
                      <h3 class='product-title mb-2 fs-base'><a class='d-block text-truncate' href='productdetails.php?id=".safe($rowr['id'])."'>".safe($rowr['name'])."</a></h3><span class='fs-sm text-muted'>Price:</span>
                      <div class='d-flex align-items-center flex-wrap'>
                        <h4 class='mt-1 mb-0 fs-base text-darker'><span style='color: red;'>&#8358;</span> ".safe($rowr['amount'])."</h4>
                      </div>
                    </div>
                  </article>
                </div> ";
                }
              }
            }  else{
              echo"<h3 class='h6 mb-2 fs-sm text-muted'>unavailable</h3>";
            }

            ?>
            </div>
                  </div>
                </section>
                <?php } ?>

        <!-- Product carousel-->
        <section class="container mb-2 py-lg-5 py-4">
                      <div class="d-flex align-items-center justify-content-between mb-sm-3 mb-2">
                        <h2 class="h3 mb-0">Check Also</h2>
                      </div>
                      <!-- Product carousel-->
                      <div class="tns-carousel tns-controls-static tns-controls-outside mx-xl-n4 mx-n2 px-xl-4 px-0">
                        <div class="tns-carousel-inner row gx-xl-0 gx-3 mx-0" data-carousel-options="{&quot;items&quot;: 2, &quot;nav&quot;: true, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1,&quot;controls&quot;: false, &quot;gutter&quot;: 0},&quot;500&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3}, &quot;1100&quot;:{&quot;items&quot;:4}, &quot;1278&quot;:{&quot;controls&quot;: true, &quot;nav&quot;: false, &quot;gutter&quot;: 30}}}">
                        <?php
              $sqls = "SELECT * FROM `product`";
              $results = mysqli_query($conn , $sqls);
              while($rows = mysqli_fetch_assoc($results)){
              ?>


            <!-- Product item for men shoe-->
            <div class="col py-3">
              <article class="card h-100 border-0 shadow">
                <div class="card-img-top position-relative overflow-hidden">
                  <a class="d-block" href="productdetails.php?id=<?php echo safe($rows['id']); ?>"><img style="max-height:312.66px!important;" src="images/<?php echo safe($rows['image']); ?>" alt="Product image"></a>
                
                </div>
                <div class="card-body">
                  <h3 class="product-title mb-2 fs-base"><a class="d-block text-truncate" href="productdetails.php?id=<?php echo safe($rows['id']); ?>"><?php echo safe($rows['name']); ?></a></h3><span class="fs-sm text-muted">Current Price:</span>
                  <div class="d-flex align-items-center flex-wrap">
                    <h4 class="mt-1 mb-0 fs-base text-darker"><span style="color: red;">&#8358;</span><?php echo safe($rows['amount']); ?></h4>
                  </div>
                </div>
              </article>
            </div>
            <?php } ?>
          </div>
        </div>
      </section>
    </main>

    <!-- Footer-->
    <footer class="footer bg-darker">
        <div class="container" style="padding-top: 0.2rem !important;
    padding-bottom: 0rem !important;">
          <div class="row py-lg-4 text-center">
          <a class="" href="#"><img src="img/unnmarketplace.png" width="187" alt="UNNmarketplace"></a><span class="d-inline-block align-middle h5 fw-light text-white mb-0">Online Marketplace For UNN Community</span>
            <p class="fs-sm text-white opacity-70 pb-1">Buy/sell items from the community.</p>
            <div><a class="btn-social bs-light bs-twitter me-2 mb-2" href="#"><i class="ci-twitter"></i></a><a class="btn-social bs-light bs-whatsapp me-2 mb-2" href="https://wa.me/message/VB7YIZ64KQAHA1"><i class="ci-whatsapp"></i></a><a class="btn-social bs-light bs-instagram me-2 mb-2" href="https://www.instagram.com/invites/contact/?i=sr6g0roc462d&utm_content=olw0lzd"><i class="ci-instagram"></i></a></div>
            <div class="fs-xs text-light opacity-50">&copy;2023 <a class="text-light" href="" target="_blank" rel="noopener"> UNNMarketplace</a> </div>
          </div>
          
        </div>
    </footer>
    <!-- Toolbar for handheld devices-->
    <div class="handheld-toolbar">
      <div class="d-table table-layout-fixed w-100"><a class="d-none handheld-toolbar-item" href="#vendor-sidebar" data-bs-toggle="offcanvas"><span class="handheld-toolbar-icon"><i class="ci-sign-in"></i></span><span class="handheld-toolbar-label">Sidebar</span></a><a class="d-table-cell handheld-toolbar-item" href="#signin-modal" data-bs-toggle="modal"><span class="handheld-toolbar-icon"><i class="ci-user"></i></span><span class="handheld-toolbar-label">Account</span></a><a class="d-table-cell handheld-toolbar-item" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" onclick="window.scrollTo(0, 0)"><span class="handheld-toolbar-icon"><i class="ci-menu"></i></span><span class="handheld-toolbar-label">Menu</span></a>
      </div>
    </div>
    <!-- Back To Top Button--><a class="btn-scroll-top" href="#top" data-scroll><span class="btn-scroll-top-tooltip text-muted fs-sm me-2">Top</span><i class="btn-scroll-top-icon ci-arrow-up">   </i></a>
    <!-- Vendor scrits: js libraries and plugins-->
    <script src="vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/simplebar/dist/simplebar.min.js"></script>
    <script src="vendor/tiny-slider/dist/min/tiny-slider.js"></script>
    <script src="vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
    <script src="vendor/drift-zoom/dist/Drift.min.js"></script>
    <!-- Main theme script-->
    <script src="js/theme.min.js"></script>
  </body>
</html>