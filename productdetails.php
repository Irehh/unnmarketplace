<?php

session_start();
include("config.php");
$conn = db();


  ?>
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
  $count = safe($row['product_views_count']);
  $diff = safe($row["id"]);
  $timestamp = safe($row["date"]);
  $user_id = safe($row["user_id"]);
  $url = "http://localhost/unnmarketplace/productdetails.php?id=$id";
  $text = urlencode("I want to buy this item $url ");
$sall = "for sale:&#20A6;";
$count = $count + 1;
  $page_count = "UPDATE product SET product_views_count = '$count' WHERE id = '$id'";
  mysqli_query($conn, $page_count);
 
   ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $dname; ?></title>
    <!-- SEO Meta Tags-->
    <meta name="description" content="Buy/Sell from the community | UNNMarketplace">
    <meta name="keywords" content="UNNMarketplace, shop, e-commerce, university of nigeria, unn market">
    <meta name="author" content="Truth">
    <!-- Viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Favicon and Touch Icons-->
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <!--<link rel="mask-icon" color="#fe6a6a" href="safari-pinned-tab.svg">-->
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
     <!--Open graph tags-->
<meta property="og:type"          content="website" />
<meta property="og:description"   content="Buy or Sell used items for free." />
<meta property="og:image"         content="http://localhost/unnmarketplace/images/<?php echo $dimage1; ?>" />
        <!-- comments files link -->
    <script src="./4b-comments.js"></script>
    <link href="./4c-comments.css" rel="stylesheet">
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
                <a class="navbar-tool ms-lg-2" href="forms\register.php"><span class="navbar-tool-tooltip">Sign Up</span>
                <div class="navbar-tool-icon-text">Sign Up</div></a>
              <?php endif ?>
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
                <li class="breadcrumb-item"><a class="text-nowrap" href="index.php"><i class="ci-home"></i>Home</a></li>
                <li class="breadcrumb-item text-nowrap"><a href="./shop.php">catalog</a>
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

   
      <!--  main product details -->
      <section class="container pb-md-4">
        <!-- Product-->
        <div class="bg-light shadow-lg rounded-3 px-4 py-lg-4 py-3 mb-5">
          <div class="py-lg-3 py-2 px-lg-3">
            <div class="row gy-4">
              <!-- Product image-->
              <div class="col-lg-6">
                <div class="position-relative rounded-3 overflow-hidden mb-lg-4 mb-2"><img class="image-zoom" src="./images/<?php echo $dimage1; ?>" alt="Product image">
            
                </div>
                <div class="pt-2 text-lg-start text-center">
                <!-- for social media share -->
                <?php
                        $message = "Check this item up for sale: $url";
                        $encoded_message = urlencode($message);
                        $whatsapp_url = "whatsapp://send?text=$encoded_message";
                        $facebook_url = "https://facebook.com/sharer.php?u=" . $url;
                       
                ?>
                  <button class="btn btn-secondary rounded-pill btn-icon me-sm-3 me-2" type="button" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Share on whatsapp" data-bs-original-title="Share on whatsapp"><a target="_blank" href="<?php echo $whatsapp_url; ?>"><i class="ci-whatsapp"></i></a></button>
                  <button class="btn btn-secondary rounded-pill btn-icon me-sm-3 me-2" type="button" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Share" data-bs-original-title="copied"  onclick="copy()"><i class="ci-share-alt"></i></button>
                  <input type="hidden" id="link-to-copy" value="<?= $url; ?>">
                  <script>
                  function copy() {
                    navigator.clipboard.writeText($('#link-to-copy').val());
                  }
                  // Wait for 5 seconds after page load
                    setTimeout(function() {
                        // Show the alert element
                        $("#welcome-alert").show();
                    }, 5000);
                </script>
                  <button class="btn btn-secondary rounded-pill btn-icon me-sm-3 me-2" type="button" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="share on facebook" data-bs-original-title="share on facebook"><a target="_blank" href="<?php echo $facebook_url; ?>"><i class="ci-facebook"></i></a></button>                  
                </div>
              </div>
              <!-- Product details-->
              <div class="col-lg-6">
                <div class="ps-xl-5 ps-lg-3">
                  <!-- Meta-->
                  <h2 class="h3 mb-3"><?php echo $dname; ?></h2>
                  <div class="d-flex align-items-center flex-wrap text-nowrap mb-sm-4 mb-3 fs-sm">
                    <div class="mb-2 me-sm-3 me-2 text-muted">Posted on <?php echo date('M j',strtotime($timestamp)); ?></div>
                    <div class="mb-2 me-sm-3 me-2 ps-sm-3 ps-2 border-start text-muted"><i class="ci-eye me-1 fs-base mt-n1 align-middle"></i><?php echo $count; ?> views</div>
                    <!-- Launch warning modal -->
                    <div class="mb-2 me-sm-3 me-2 ps-sm-3 ps-2 border-start text-muted" data-bs-toggle="modal" data-bs-target="#warning"><i class="ci-loudspeaker me-1 fs-base mt-n1 align-middle"></i>1</div>
                  </div>
                  <div class="row row-cols-sm-2 row-cols-1 gy-3 gx-4 mb-4 pb-md-2">
                    <!-- Creator-->
                    <div class="col">
                      <div class="card position-relative h-100">
                        <div class="card-body p-3">
                          <h3 class="h6 mb-2 fs-sm text-muted">From</h3>
                          <?php
                          
                          $user_id = safe($row["user_id"]);
                          if(isset($user_id)){
                            $usersql = "SELECT name,image,number FROM users WHERE id='$user_id' limit 1 ";
                            $userresult = mysqli_query($conn , $usersql);
                            $userrow = mysqli_fetch_assoc($userresult);
                                $name = safe($userrow['name']);
                                $image = safe($userrow['image']);
                                $number = safe($userrow['number']); 
                                // $number = substr($number, 1); 
                          ?>
                          <div class="d-flex align-items-center"><img class="rounded-circle me-2" src="./profile_image/<?php if($image != null){ echo $image; }else{ echo "logo.png"; } ?>" width="32" alt="Avatar"><a class="nav-link-style stretched-link fs-sm" href="vendor_information.php?user_id=<?php echo $user_id; ?>">@<?php echo $name; ?></a></div>
                        </div>
                        <?php  } ?>
                      </div>
                    </div>
                    <!-- Collection-->
                    <div class="col">
                      <div class="card position-relative h-100">
                        <div class="card-body p-3">
                          <h3 class="h6 mb-2 fs-sm text-muted">Specification</h3>
                          <div class="d-flex align-items-center"><a class="btn-share btn-instagram me-2 my-2" href="#"><?php echo $dcategory; ?></a>
                          <a class="btn-share btn-primary me-2 my-2" href="#"><?php echo $dtype; ?></a></div>
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
                  <!-- Primary alert -->
                      <div  class="alert alert-primary alert-dismissible fade show" id="welcome-alert" role="alert" style="display: none;">
                        <span class="fw-medium">Take note!</span>
                        <p class="fs-xs" style="margin-bottom: 0!important;">1. Physically inspect in a public space or see the product before you buy it.</p>
        <p class="fs-xs" style="margin-bottom: 0!important;">2. Don't make payment until you see the item.</p>
        <p class="fs-xs" style="margin-bottom: 0!important;">3. The platform only connects buyers and sellers though assistance can be <a style="color:black;" target="_blank" href="https://wa.me/message/OX3BTMPRXKEOD1"><u>offered</u></a></p>
        <p class="fs-xs"style="margin-bottom: 0!important;">4. Contact the seller if you understand the above warnings.</p>
                        <hr>
                        <p class="pt-3 mb-2 accent" >Need Help? <a style="color:black;" target="_blank" href="https://wa.me/message/OX3BTMPRXKEOD1"><u>Contact us</u></a></p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    <a target="_blank" href="<?php echo "https://wa.me/+234$number?text=$text"; ?>"><button class="btn btn-lg btn-success d-block w-100 mb-4"><i class="ci-whatsapp"></i>BUY NOW</button></a>
                  <a target="_blank" href="tel:+234<?php echo $number; ?>"><button class="btn btn-lg btn-accent d-block w-100 mb-4" type="submit" name="send"><i class="ci-phone"></i></button></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      
       <!-- comment start here -->
                      <!-- tested  -->
                   <!-- (A) GIVE THIS PAGE A HIDDEN POST ID -->
                   <input type="hidden" id="pid" value="<?= $id; ?>">
                   <!-- comment output -->
      <div class="container pb-5">
        <div class="row justify-content-center pt-5 mt-md-2">
          <div class="col-lg-9">
          
                  <!-- comment-->
                  <h2 class="h4">Post a Comments<span class="badge bg-secondary fs-sm text-body align-middle ms-2"></span></h2>
                  <!-- Post comment form--><!-- (C) ADD NEW COMMENT -->
                  <div class="card border-0 shadow mt-2 mb-4">
                    <div class="card-body">
                      <div class="d-flex align-items-start"><img class="rounded-circle" src="img/talk.png" width="50" alt="Mary Alice">
                        <form class="w-100 ms-3" id="cAdd" onsubmit="return comments.add(this)">
                        <div class="mb-3">
                        <input class="form-control" type="text" id="cName" placeholder="Name" required>
                        </div>
                          <div class="mb-3">
                            <textarea class="form-control" rows="4" id="cMsg" placeholder="Write comment..." required></textarea>
                            <div class="valid-feedback">Please write your comment.</div>
                          </div>
                          <button class="btn btn-primary btn-sm" type="submit" value="Post Comment" >Post comment</button>
                        </form>
                      </div>
                    </div>
                  </div>
              <!-- (B) COMMENTS WILL LOAD HERE -->
              <h2 class="h4">Comments<span class="badge bg-secondary fs-sm text-body align-middle ms-2"></span></h2>
              <div id="cWrap"></div>
          </div>
        </div>
      </div>
      
          <!-- Modal markup -->
<div class="modal" tabindex="-1" role="dialog" id="warning">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Warning!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="fs-sm"><strong> Physically inspect or see the product before you buy it.</strong> </p>
        <p class="fs-sm"><strong> Don't make payment until you see the item.</strong> </p>
        <p class="fs-sm"><strong> The platform only connects buyers and sellers.</strong> </p>
        <p class="fs-sm"><strong> Contact the seller if you understand the above warnings.</strong> </p>
        <p>Disclaimer:We are not liable for any loss or damage arising from your use of this website.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
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
              $collectionsql = "SELECT * FROM `product` WHERE category='$dcategory' OR type='$dtype' ";
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
                  <a class="d-block" href="productdetails.php?id=<?php echo safe($rows['id']); ?>"><img src="images/<?php echo safe($rows['image']); ?>" alt="Product image"></a>
                
                </div>
                <div class="card-body">
                  <h3 class="product-title mb-2 fs-base"><a class="d-block text-truncate" href="productdetails.php?id=<?php echo safe($rows['id']); ?>"><?php echo safe($rows['name']); ?></a></h3>
                  <?php  if($rows['amount'] != 0) {
                    echo '<span class="fs-sm text-muted">Current Price:</span>
                    <div class="d-flex align-items-center flex-wrap">
                      <h4 class="mt-1 mb-0 fs-base text-darker"><span style="color: red;">&#8358;</span>'. safe($rows["amount"]) . '</h4>
                    </div>'; } ?>
                </div>
              </article>
            </div>
            <?php } ?>
          </div>
        </div>
      </section>
    </main>

    <!-- Footer-->
                <?php include "footer.php"; ?>
    <!-- Back To Top Button--><a class="btn-scroll-top" href="#top" data-scroll><span class="btn-scroll-top-tooltip text-muted fs-sm me-2">Top</span><i class="btn-scroll-top-icon ci-arrow-up">   </i></a>
    <!-- Vendor scrits: js libraries and plugins-->
    <script src="vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/simplebar/dist/simplebar.min.js"></script>
    <script src="vendor/tiny-slider/dist/min/tiny-slider.js"></script>
    <script src="vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
    <script src="vendor/drift-zoom/dist/Drift.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Main theme script-->
    <script src="js/theme.min.js"></script>
  </body>
</html>