<?php
include "config.php";
session_start();
$conn = db();
 $url = "http://localhost/unnmarketplace/";
  $url = urlencode("$url");
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <title>Buy & Sell Online from the community </title>
    <!-- SEO Meta Tags-->
    <meta name="description" content="An online marketplace for the UNN community to buy and sell online.">
    <meta name="keywords" content="unn store, unnmarketplace,online marketplace for unn students, shop, e-commerce, market, honest, dealer, fashion,sell used property online">
    <meta name="author" content="Truth">
    <!-- refresh very 3 min -->
    <!-- <meta http-equiv="refresh" content="60"> -->
    <!-- Viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon and Touch Icons-->
    <link rel="apple-touch-icon" sizes="180x180" href="./apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" color="#fe6a6a" href="./img/icon/unnmarketplace logo.svg">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <!-- dont delete for link preview -->
    <!--<meta property="og:url"           content="<?php echo urlencode('http://localhost/unnmarketplace'); ?> " />-->
    <!--<meta property="og:type"          content="website" />-->
    <meta property="og:title"         content="Local Online Marketplace" />
    <meta property="og:description"   content="Buy or Sell used items for free." />
    <meta property="og:image"         content="http://localhost/unnmarketplace/img/UNN_Fountain.png" />
    <!-- Vendor Styles including: Font Icons, Plugins, etc.-->
    <link rel="stylesheet" media="screen" href="vendor/simplebar/dist/simplebar.min.css"/>
    <link rel="stylesheet" media="screen" href="vendor/tiny-slider/dist/tiny-slider.css"/>
    <!-- Main Theme Styles + Bootstrap-->
    <link rel="stylesheet" media="screen" href="css/theme.min.css">
    
</head>
  <!-- Body-->
  <body class="handheld-toolbar-enabled">
     <!-- Topbar-->
     <div class="topbar topbar-dark bg-dark">
          <div class="container">
            <div class="topbar-text text-nowrap d-none d-md-inline-block"><i class="ci-support"></i><span class="text-muted me-1">Support</span><a class="topbar-link" href="tel:00331697720">(+234) 81 444 1382</a></div>
            <div class="tns-carousel tns-controls-static d-none d-md-block">
              <div class="tns-carousel-inner" data-carousel-options="{&quot;mode&quot;: &quot;gallery&quot;, &quot;nav&quot;: false}">
                <div class="topbar-text">Enquiries</div>
              </div>
            </div>
          </div>
        </div>
    <main class="page-wrapper">
      <!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
      <header class="navbar d-block navbar-sticky navbar-expand-lg navbar-light position-absolute w-100">
        <div class="container"><a class="navbar-brand d-none d-sm-block me-4 order-lg-1" href="index.php"><img src="img/unnmarketplace.png" width="142" alt="unnmarketplace"></a><a class="navbar-brand d-sm-none me-2 order-lg-1" href="index.php"><img src="img/unnmarketplace.png" width="74" alt="unnmarketplace"></a>
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
                <a class="navbar-tool ms-lg-2 btn btn-sm btn-accent rounded-1 ms-lg-4 ms-3"   href="forms\register.php"><span class="navbar-tool-tooltip">Sign Up</span>
                <div class="navbar-tool-icon-text">Sign Up</div></a>
              <?php endif ?>
               <hr>
          </div>
          <?php  include "Primarymenu.php";  ?>
      </header>
       <!-- Hero slider-->
       <section class="tns-carousel tns-controls-lg mb-4 mb-lg-5">
        <div class="tns-carousel-inner" data-carousel-options="{&quot;mode&quot;: &quot;gallery&quot;, &quot;autoplay&quot;: &quot;true&quot;, &quot;autoplayTimeout&quot;: &quot;4000&quot;, &quot;responsive&quot;: {&quot;0&quot;:{&quot;nav&quot;:true, &quot;controls&quot;: false},&quot;992&quot;:{&quot;nav&quot;:false, &quot;controls&quot;: true}}}">
          <!-- Item-->
          <div class="px-lg-5" style="background-color: #f5b1b0;">
            <div class="d-lg-flex justify-content-between align-items-center ps-lg-4"><img class="d-block order-lg-2 me-lg-n5 flex-shrink-0" src="img/hero-slider/02.jpg" alt="Women Sportswear">
              <div class="position-relative mx-auto me-lg-n5 py-5 px-4 mb-lg-5 order-lg-1" style="max-width: 42rem; z-index: 10;">
                <div class="pb-lg-5 mb-lg-5 text-center text-lg-start text-lg-nowrap">
                  <h3 class="h2 text-light fw-light pb-1 from-bottom">It's Free! Your local online market.</h3>
                  <h2 class="text-light display-5 from-bottom delay-1">Buy and Sell Used Items</h2>
                  <p class="fs-lg text-light pb-3 from-bottom delay-2">Cylinder, Books, Bedstand &amp; much more...</p>
                  <div class="d-table scale-up delay-4 mx-auto mx-lg-0"><a class="btn btn-primary" href="shop.php">Shop Now<i class="ci-arrow-right ms-2 me-n1"></i></a></div>
                </div>
              </div>
            </div>
          </div>

          <!-- Item-->
          <div class="px-lg-5" style="background-color: #3aafd2;">
            <div class="d-lg-flex justify-content-between align-items-center ps-lg-4"><img class="d-block order-lg-2 me-lg-n5 flex-shrink-0" src="img/hero-slider/01.jpg" alt="Summer Collection">
              <div class="position-relative mx-auto me-lg-n5 py-5 px-4 mb-lg-5 order-lg-1" style="max-width: 42rem; z-index: 10;">
                <div class="pb-lg-5 mb-lg-5 text-center text-lg-start text-lg-nowrap">
                  <h3 class="h2 text-light fw-light pb-1 from-start">We Welcome Everyone!</h3>
                  <h2 class="text-light display-5 from-start delay-1">Share to your friends</h2>
                  <p class="fs-lg text-light pb-3 from-start delay-2">Connect UNN!</p>
                  <div class="d-table scale-up delay-4 mx-auto mx-lg-0"><a class="btn btn-success" href="<?= "whatsapp://send?text=$url"; ?>">Share<i class="ci-whatsapp ms-2 me-n1"></i></a></div>
                </div>
              </div>
            </div>
          </div>
          <!-- Item-->
                  <div class="px-lg-5" style="background-color: #eba170;">
            <div class="d-lg-flex justify-content-between align-items-center ps-lg-4"><img class="d-block order-lg-2 me-lg-n5 flex-shrink-0" src="img/hero-slider/03.jpg" alt="Men Accessories">
              <div class="position-relative mx-auto me-lg-n5 py-5 px-4 mb-lg-5 order-lg-1" style="max-width: 42rem; z-index: 10;">
                <div class="pb-lg-5 mb-lg-5 text-center text-lg-start text-lg-nowrap">
                  <h3 class="h2 text-light fw-light pb-1 from-top">It's back-to-school season</h3>
                  <h2 class="text-light display-5 from-top delay-1">Sell Your Unused Books!</h2>
                  <p class="fs-lg text-light pb-3 from-top delay-2">Book and material donations are welcome.</p>
                  <div class="d-table scale-up delay-4 mx-auto mx-lg-0"><a class="btn btn-primary" href="https://wa.me/message/OX3BTMPRXKEOD1">Contact Us Now<i class="ci-arrow-right ms-2 me-n1"></i></a></div>
                </div>
              </div>
            </div>
          </div>
          <!-- Item-->
          <!--<div class="px-lg-5" style="background-color: #eba170;">-->
          <!--  <div class="d-lg-flex justify-content-between align-items-center ps-lg-4"><img class="d-block order-lg-2 me-lg-n5 flex-shrink-0" src="img/hero-slider/03.jpg" alt="Men Accessories">-->
          <!--    <div class="position-relative mx-auto me-lg-n5 py-5 px-4 mb-lg-5 order-lg-1" style="max-width: 42rem; z-index: 10;">-->
          <!--      <div class="pb-lg-5 mb-lg-5 text-center text-lg-start text-lg-nowrap">-->
          <!--        <h3 class="h2 text-light fw-light pb-1 from-top">Want to buy or sell a property anonymously?</h3>-->
          <!--        <h2 class="text-light display-5 from-top delay-1">WE Got You!</h2>-->
          <!--        <p class="fs-lg text-light pb-3 from-top delay-2">Bed &amp; Curtains, chairs &amp; much more...</p>-->
          <!--        <div class="d-table scale-up delay-4 mx-auto mx-lg-0"><a class="btn btn-primary" href="https://wa.me/message/OX3BTMPRXKEOD1">Contact Us Now<i class="ci-arrow-right ms-2 me-n1"></i></a></div>-->
          <!--      </div>-->
          <!--    </div>-->
          <!--  </div>-->
          <!--</div>-->
        </div>
      </section>


        <!-- Product carousel (new properties)-->

      <section class="container mb-2 py-lg-5 py-4">
                      <div class="d-flex align-items-center justify-content-between mb-sm-3 mb-2">
                        <h2 class="h3 mb-0">New Arrivals</h2><a class="btn btn-outline-accent ms-3 btn-sm" href="shop.php">Explore more<i class="ci-arrow-right ms-2"></i></a>
                      </div>
                      <!-- Product carousel-->
                      <div class="tns-carousel tns-controls-static tns-controls-outside mx-xl-n4 mx-n2 px-xl-4 px-0">
                        <div class="tns-carousel-inner row gx-xl-0 gx-3 mx-0" data-carousel-options="{&quot;items&quot;: 2, &quot;nav&quot;: true, &quot;autoplay&quot;: &quot;true&quot;, &quot;autoplayTimeout&quot;: &quot;5000&quot;, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:2,&quot;controls&quot;: false, &quot;gutter&quot;: 0},&quot;500&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3}, &quot;1100&quot;:{&quot;items&quot;:4}, &quot;1278&quot;:{&quot;controls&quot;: true, &quot;nav&quot;: false, &quot;gutter&quot;: 30}}}">
            <!-- Product item for used-->
            <?php
                      $sqls = "SELECT * FROM `product` ORDER BY 'date' DESC LIMIT 25 ";
                     $results = mysqli_query($conn , $sqls);
              while($rows = mysqli_fetch_assoc($results)){
                         $name = safe($rows['name']);

                $position=15; // Define how many character you want to display.
               // $about is the text i want to trim
                $name = substr($name, 0, $position);
    ?>
            <div class="col py-3">
              <article class="card h-100 border-0 shadow">
                <div class="card-img-top position-relative overflow-hidden" style="max-height:300px;">
                  <a class="d-block" href="productdetails.php?id=<?php echo safe($rows['id']); ?>"><img src="images/<?php echo safe($rows['image']); ?>" alt="Product image"></a>
                </div>
                <div class="card-body">
                  <h3 class="product-title mb-2 fs-base" style="overflow-x: hidden;"><a class="d-block text-truncate" href="productdetails.php?id=<?php echo safe($rows['id']); ?>"><?php echo $name; ?></a></h3>
                  <div class="d-flex align-items-center flex-wrap">
                    <h4 class="mt-1 mb-0 fs-base text-darker"><span class="fs-sm text-muted">Price:</span><span style="color: red;">&#8358;</span><?php echo safe($rows['amount']); ?></h4>
                  </div>
                </div>
              </article>
            </div>
            <?php } ?>
          </div>
        </div>
      </section>

  
    <!-- Product carousel (free)-->
    <?php
                      $sqls = "SELECT * FROM `product` WHERE category='free' ORDER BY 'date' DESC LIMIT 25 ";
                      $results = mysqli_query($conn , $sqls);
                      if(mysqli_num_rows($results) != 0){  if($rows = mysqli_fetch_array($results)) {
    ?>
      <section class="container mb-2 py-lg-5 py-4">
                      <div class="d-flex align-items-center justify-content-between mb-sm-3 mb-2">
                        <h2 class="h3 mb-0">Free items</h2><a class="btn btn-outline-accent ms-3 btn-sm" href="shop.php?category=<?php echo safe($rows['category']); ?>">Explore more<i class="ci-arrow-right ms-2"></i></a>
                      </div>
                      <!-- Product carousel-->
                      <div class="tns-carousel tns-controls-static tns-controls-outside mx-xl-n4 mx-n2 px-xl-4 px-0">
                        <div class="tns-carousel-inner row gx-xl-0 gx-3 mx-0" data-carousel-options="{&quot;items&quot;: 2, &quot;nav&quot;: true, &quot;autoplay&quot;: &quot;true&quot;, &quot;autoplayTimeout&quot;: &quot;6000&quot;, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1,&quot;controls&quot;: false, &quot;gutter&quot;: 0},&quot;500&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3}, &quot;1100&quot;:{&quot;items&quot;:4}, &quot;1278&quot;:{&quot;controls&quot;: true, &quot;nav&quot;: false, &quot;gutter&quot;: 30}}}">
                      <?php 
              while($rows = mysqli_fetch_assoc($results)){
              ?>
            <!-- Product item for free -->
            <div class="col py-3">
              <article class="card h-100 border-0 shadow">
                <div class="card-img-top position-relative overflow-hidden">
                  <a class="d-block" href="productdetails.php?id=<?php echo safe($rows['id']); ?>"><img src="images/<?php echo safe($rows['image']); ?>" alt="Product image"></a>
                </div>
                <div class="card-body">
                  <h3 class="product-title mb-2 fs-base"><a class="d-block text-truncate" href="productdetails.php?id=<?php echo safe($rows['id']); ?>"><?php echo safe($rows['name']); ?></a></h3><span class="fs-sm text-muted">Current Price:</span>
                  <div class="d-flex align-items-center flex-wrap">
                    <h4 class="mt-1 mb-0 fs-base text-darker"><span style="color: red;">&#8358;</span><?php echo safe($rows['amount']); ?></h4>
                  </div>
                </div>
              </article>
            </div>
            <?php }  ?>
          </div>
        </div>
      </section>
    <?php } } ?>
    
     <!-- Product carousel (used)-->
    <?php
                      $sqls = "SELECT * FROM `product` WHERE type='used' ORDER BY 'date' DESC LIMIT 25 ";
                      $results = mysqli_query($conn , $sqls);
                      if(mysqli_num_rows($results) > -1){  if($rows = mysqli_fetch_array($results)) {
    ?>
      <section class="container mb-2 py-lg-5 py-4">
                      <div class="d-flex align-items-center justify-content-between mb-sm-3 mb-2">
                        <h2 class="h3 mb-0">Used</h2><a class="btn btn-outline-accent ms-3 btn-sm" href="shop.php?type=<?php echo safe($rows['type']); ?>">Explore more<i class="ci-arrow-right ms-2"></i></a>
                      </div>
                      <!-- Product carousel-->
                      <div class="tns-carousel tns-controls-static tns-controls-outside mx-xl-n4 mx-n2 px-xl-4 px-0">
                        <div class="tns-carousel-inner row gx-xl-0 gx-3 mx-0" data-carousel-options="{&quot;items&quot;: 2, &quot;nav&quot;: true, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1,&quot;controls&quot;: false, &quot;gutter&quot;: 0},&quot;500&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3}, &quot;1100&quot;:{&quot;items&quot;:4}, &quot;1278&quot;:{&quot;controls&quot;: true, &quot;nav&quot;: false, &quot;gutter&quot;: 30}}}">
                      <?php 
              while($rows = mysqli_fetch_assoc($results)){
              ?>
            <!-- Product item for used-->
            <div class="col py-3">
              <article class="card h-100 border-0 shadow">
                <div class="card-img-top position-relative overflow-hidden">
                  <a class="d-block" href="productdetails.php?id=<?php echo safe($rows['id']); ?>"><img src="images/<?php echo safe($rows['image']); ?>" alt="Product image"></a>
                </div>
                <div class="card-body">
                  <h3 class="product-title mb-2 fs-base"><a class="d-block text-truncate" href="productdetails.php?id=<?php echo safe($rows['id']); ?>"><?php echo safe($rows['name']); ?></a></h3><span class="fs-sm text-muted">Current Price:</span>
                  <div class="d-flex align-items-center flex-wrap">
                    <h4 class="mt-1 mb-0 fs-base text-darker"><span style="color: red;">&#8358;</span><?php echo safe($rows['amount']); ?></h4>
                  </div>
                </div>
              </article>
            </div>
            <?php }  ?>
          </div>
        </div>
      </section>
    <?php } } ?>
        
         <!-- Blog + Instagram info cards-->
      <section class="container-fluid px-0">
        <div class="row g-0">
          <div class="col-md-6"><a class="card border-0 rounded-0 text-decoration-none py-md-4 bg-faded-primary" href="https://chat.whatsapp.com/KsmlTJJrLd2Exr7oWn5j6x">
              <div class="card-body text-center"><i class="ci-whatsapp h3 mt-2 mb-4 text-primary"></i>
                <h3 class="h5 mb-1">Join the Community</h3>
                <p class="text-muted fs-sm">Advertise Your Product Here!</p>
              </div></a></div>
          <div class="col-md-6"><a class="card border-0 rounded-0 text-decoration-none py-md-4 bg-faded-accent" href="https://www.instagram.com/invites/contact/?i=sr6g0roc462d&utm_content=olw0lzd">
              <div class="card-body text-center"><i class="ci-instagram h3 mt-2 mb-4 text-accent"></i>
                <h3 class="h5 mb-1">Follow on Instagram</h3>
                <p class="text-muted fs-sm">#unnmarketplace</p>
              </div></a></div>
        </div>
      </section>
      <main class="container-fluid px-0">
        <!-- Row: Shop online-->
        <section class="row g-0">
          <div class="col-md-6 bg-position-center bg-size-cover bg-secondary" style="min-height: 15rem; background-image: url(img/unnmart/Marketplace-pana.png);"></div>
          <div class="col-md-6 px-3 px-md-5 py-5">
            <div class="mx-auto py-lg-5" style="max-width: 35rem;">
              <h2 class="h3 pb-3">
                  LETS GROW TOGETHER</h2>
              <p class="fs-sm pb-3 text-muted">    UNNMARKETLACE is an online marketplace, where students come together to sell and buy items online. We’re also a community pushing for positive change for small businesses, students, people, and the general UNN community to market their products to a broad audience. </p>
            <a class="btn btn-accent btn-shadow" href="./forms/register.php">Try It</a>
            </div>
          </div>
        </section>
      </main>
      <!-- Features-->
      <section class="container py-lg-5 py-4">
        <h2 class="mb-4 pb-md-3 pb-2">Why you should <STRONG style= "color:red;">BUY/SELL</STRONG> with us!</h2>
        <!-- Features carousel-->
        <div class="tns-carousel mb-4">
          <div class="tns-carousel-inner" data-carousel-options="{&quot;items&quot;: 2, &quot;nav&quot;: true, &quot;gutter&quot;: 30, &quot;autoplay&quot;: &quot;true&quot;, &quot;autoplayTimeout&quot;: &quot;4000&quot;, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1,&quot;controls&quot;: false},&quot;500&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3}, &quot;1100&quot;:{&quot;items&quot;:4}, &quot;1278&quot;:{&quot;controls&quot;: true}}}">
           
            <!-- Carousel item-->
            <div><img class="mb-4" src="img/icon/add.svg" width="60" alt="Icon">
              <h4 class="mb-2 fs-lg text-body">Products</h4>
              <p class="mb-0 fs-sm text-muted">See wide range of products from various sellers in one community, Buy and sell used items now, and get what you want! - all in one place and totally free of charge.</p>
            </div>
             <!-- Carousel item-->
            <div><img class="mb-4" src="img/icon/add.svg" width="60" alt="Icon">
              <h4 class="mb-2 fs-lg text-body">Convenience</h4>
              <p class="mb-0 fs-sm text-muted">No more joining countless different groups to find the right item - our platform has it all!</p>
            </div>
            <!-- Carousel item-->
            <div><img class="mb-4" src="img/icon/add.svg" width="60" alt="Icon">
              <h4 class="mb-2 fs-lg text-body">Search</h4>
              <p class="mb-0 fs-sm text-muted">With unnmarketplace, you can find exactly what you're looking for in no time, saving you the hassle of endlessly scrolling!</p>
            </div>
          </div>
        </div>
      </section>
    </main>
    <!-- Bg shape-->
    <!--<div class="pt-4 bg-secondary">-->
      <!-- Blog recent posts-->
    <!--  <section class="container py-lg-5 py-4">-->
    <!--    <div class="d-flex align-items-center justify-content-between mb-sm-4 mb-2 pb-2">-->
    <!--      <h2 class="h3 mb-0">Check also our blog Post</h2><a class="btn btn-outline-accent ms-3" href="#">All articles<i class="ci-arrow-right ms-2"></i></a>-->
    <!--    </div>-->
        <!-- Blog (carousel)-->
    <!--    <div class="tns-carousel pb-lg-5 pb-4">-->
    <!--      <div class="tns-carousel-inner" data-carousel-options="{&quot;items&quot;: 2, &quot;controls&quot;: false, &quot;nav&quot;: true, &quot;gutter&quot;: 30, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;576&quot;:{&quot;items&quot;:2},&quot;992&quot;:{&quot;items&quot;:3}}}">-->
            <!-- Carousel item-->
    <!--        <article><a class="d-block mb-3" href="blog-single.php"><img class="rounded-3" src="img/blog/shoes.jpg" alt="Blog image"></a>-->
    <!--          <div class="d-flex align-items-center fs-sm pb-2"><a class="blog-entry-meta-link" href="#">by Truth</a><span class="blog-entry-meta-divider"></span><a class="blog-entry-meta-link" href="#">Aug 15</a></div>-->
    <!--          <h2 class="h6 blog-entry-title mb-0"><a href="blog-single.php">How to Check ORIGINAL or COPY Footwear?</a></h2>-->
    <!--        </article>-->
            <!-- Carousel item-->
    <!--        <article><a class="d-block mb-3" href="blog-single.php"><img class="rounded-3" src="img/blog/shoes.jpg" alt="Blog image"></a>-->
    <!--          <div class="d-flex align-items-center fs-sm pb-2"><a class="blog-entry-meta-link" href="#">by Truth</a><span class="blog-entry-meta-divider"></span><a class="blog-entry-meta-link" href="#">Sep 18</a></div>-->
    <!--          <h2 class="h6 blog-entry-title mb-0"><a href="blog-single.php">How to Check ORIGINAL or COPY Footwear ?</a></h2>-->
    <!--        </article>-->
            <!-- Carousel item-->
    <!--        <article><a class="d-block mb-3" href="blog-single.php"><img class="rounded-3" src="img/blog/shoes.jpg" alt="Blog image"></a>-->
    <!--          <div class="d-flex align-items-center fs-sm pb-2"><a class="blog-entry-meta-link" href="#">by Mercy</a><span class="blog-entry-meta-divider"></span><a class="blog-entry-meta-link" href="#">Nov 26</a></div>-->
    <!--          <h2 class="h6 blog-entry-title mb-0"><a href="blog-single.php">How to Check ORIGINAL or COPY Footwear ?</a></h2>-->
    <!--        </article>-->
            <!-- Carousel item-->
    <!--        <article><a class="d-block mb-3" href="blog-single.php"><img class="rounded-3" src="img/blog/shoes.jpg" alt="Blog image"></a>-->
    <!--          <div class="d-flex align-items-center fs-sm pb-2"><a class="blog-entry-meta-link" href="#">by Mercy</a><span class="blog-entry-meta-divider"></span><a class="blog-entry-meta-link" href="#">Aug 15</a></div>-->
    <!--          <h2 class="h6 blog-entry-title mb-0"><a href="blog-single.php">How to Check ORIGINAL or COPY Footwear ?</a></h2>-->
    <!--        </article>-->
    <!--      </div>-->
    <!--    </div>-->
    <!--  </section>-->
    <!--</div>-->
    <hr class="my-3" style="
    margin-top: 3rem !important;
    margin-bottom: 3rem !important;
">
   <!-- footer file -->
   <?php include "footer.php"; ?>
   
    <!-- Back To Top Button--><a class="btn-scroll-top" href="#top" data-scroll><span class="btn-scroll-top-tooltip text-muted fs-sm me-2">Top</span><i class="btn-scroll-top-icon ci-arrow-up">   </i></a>
    <!-- Vendor scrits: js libraries and plugins-->
    <script src="vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/simplebar/dist/simplebar.min.js"></script>
    <script src="vendor/tiny-slider/dist/min/tiny-slider.js"></script>
    <script src="vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
    <!-- Main theme script-->
    <script src="js/theme.min.js"></script>
  </body>
</html>