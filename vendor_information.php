<?php
session_start();
include("config.php");
$conn = db();
error_reporting(0);
$user_id = $_GET['user_id'];

if(!isset($user_id)){
  header("location: index.php");
}

//select data from database
  $change = "SELECT name,link,about,image,number,location,date,email,page_views_count FROM users WHERE id=$user_id limit 1 ";
  $result=mysqli_query($conn,$change);
  $row=mysqli_fetch_assoc($result);
  $name = safe($row['name']);
  $link = safe($row['link']);
  $about = safe($row['about']);
  $image = safe($row['image']);
  $number = safe($row['number']);
  $location = safe($row['location']);
 $date = safe($row['date']);
 $count = safe($row['page_views_count']);
 
 //page count
 
 $count = $count + 1;
  $page_count = "UPDATE users SET page_views_count = '$count' WHERE id = '$user_id'";
  mysqli_query($conn, $page_count);
  
 //client message
 
  include ("clientMessage.php");

//total product count
 $sqlp = "SELECT count(*) as rowcount FROM product WHERE user_id=$user_id";
    $resultp = mysqli_query($conn , $sqlp);
    $rowp=mysqli_fetch_assoc($resultp);
    $rowcount = safe($rowp['rowcount']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-P7FCDD3');</script>
<!-- End Google Tag Manager -->
    <meta charset="utf-8">
    <title><?php echo $name; ?></title>
    <!-- SEO Meta Tags-->
    <meta name="description" content="<?php echo $name; ?>">
    <meta name="keywords" content="<?php echo $name; ?>, vendor page, seller details page, shop, e-commerce, market, modern, responsive,  business, small business">
    <meta name="author" content="truth">
    <meta property="og:type"          content="website" />
     <meta property="og:title"         content="<?php echo $name; ?>" />
    <meta property="og:description"   content="<?php echo $about; ?>" />
    <meta property="og:image"         content="https://www.unnmarketplace.live/profile_image/<?php echo $image; ?>" />
    <!-- Viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon and Touch Icons-->
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">
   <link rel="mask-icon" color="#fe6a6a" href="./img/icon/unnmarketplace logo.svg">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendor Styles including: Font Icons, Plugins, etc.-->
    <link rel="stylesheet" media="screen" href="vendor/simplebar/dist/simplebar.min.css"/>
    <link rel="stylesheet" media="screen" href="vendor/tiny-slider/dist/tiny-slider.css"/>
    <!-- Main Theme Styles + Bootstrap-->
    <link rel="stylesheet" media="screen" href="css/theme.min.css">
  </head>
  <!-- Body-->
  <body class="handheld-toolbar-enabled">
      <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P7FCDD3"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    <main class="page-wrapper">
      <!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
      <header class="bg-light shadow-sm navbar-sticky">
        <div class="navbar navbar-expand-lg navbar-light">
          <div class="container"><a class="navbar-brand d-none d-sm-block flex-shrink-0 me-4 order-lg-1" href="index.php"><img src="img/unnmarketplace.png" width="142" alt="unnmarketplace"></a><a class="navbar-brand d-sm-none me-2 order-lg-1" href="index.php"><img src="img/unnmarketplace.png" width="74" alt="unnmarketplace"></a>
            <!-- Toolbar-->
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
                <a class="navbar-tool ms-lg-2 btn btn-sm btn-accent rounded-1 ms-lg-4 ms-3" href="forms\register.php"><span class="navbar-tool-tooltip">Sign Up</span>
                <div class="navbar-tool-icon-text">Sign Up</div></a>
              <?php endif ?>
               <hr>
             
            </div>
            <!-- <div class="collapse navbar-collapse me-auto order-lg-2" id="navbarCollapse"> -->
              <!-- Search-->
              <!-- <div class="input-group d-lg-none my-3"><i class="ci-search position-absolute top-50 start-0 translate-middle-y text-muted fs-base ms-3"></i>
                <input class="form-control rounded-start" type="text" placeholder="Search marketplace">
              </div> -->
              <!-- Primary menu-->
              <!-- <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="index-2.html">Back to main demo</a></li>
              </ul>
            </div>
          </div>
        </div> -->

        <?php include "Primarymenu.php";  ?>
        <!-- Search collapse-->
        <!-- <div class="search-box collapse" id="searchBox">
          <div class="card pt-2 pb-4 border-0 rounded-0">
            <div class="container">
              <div class="input-group"><i class="ci-search position-absolute top-50 start-0 translate-middle-y text-muted fs-base ms-3"></i>
                <input class="form-control rounded-start" type="text" placeholder="Search marketplace">
              </div>
            </div>
          </div>
        </div> -->
      </header>
      <!-- Header-->
      <div class="page-title-overlap bg-accent pt-4">
        <div class="container d-flex flex-wrap flex-sm-nowrap justify-content-center justify-content-sm-between align-items-center pt-2">
          <div class="d-flex align-items-center pb-3">
            <div class="img-thumbnail rounded-circle flex-shrink-0" style="width: 6.375rem;"><img class="rounded-circle" src="./profile_image/<?php if($image != null){ echo $image; }else{ echo "logo.png"; } ?>" alt="unnmarketplace vendor logo"></div>
            <div class="ps-3">
              <h3 class="text-light fs-lg mb-0"><?php echo $name;  ?></h3><span class="d-block text-light fs-ms opacity-60 py-1">Member since <?php echo date('M j',strtotime($product_timestamp)); ?></span><span class="badge bg-success"><i class="ci-check me-1"></i>Available</span>
            </div>
          </div>
          <div class="d-flex">
            <div class="text-sm-end me-5">
              <div class="text-light fs-base">Total product</div>
              <h3 class="text-light"><?= $rowcount ?></h3>
            </div>
            <div class="text-sm-end">
              <div class="text-light fs-base">Seller's location</div>
              <div class="text-light opacity-60 fs-xs"><?php if($location != null){ echo $location; }else{ echo "not provided";} ?></div>
            </div>
          </div>
        </div>
      </div>
      <div class="container mb-5 pb-3">
        <div class="bg-light shadow-lg rounded-3 overflow-hidden">
          <div class="row">
            <!-- Sidebar-->
            <aside class="col-lg-4 pe-xl-5">
              <div class="bg-white h-100 border-end p-4">
                <div class="p-2">
                  <h6>About</h6>
                  <span class="fs-ms text-muted"><?php echo $about;  ?>.</span>
                  <hr class="my-4">
                  <h6>Contacts</h6>
                  <ul class="list-unstyled fs-sm">
                    <li><a class="nav-link-style d-flex align-items-center" href="mailto:contact@example.com"><i class="ci-mail opacity-60 me-2"></i>...</a></li>
                    <li style="overflow:hidden" ><a class="nav-link-style d-flex align-items-center" target="_blank" href="<?php echo $link;  ?>"><i class="ci-globe opacity-60 me-2"></i><?php if($link != ""){ echo $link; }else{ echo "not provided";} ?></a></li>
                  </ul>
                  <hr class="my-4">
                  <h6 class="pb-1">Send message</h6>
                  <?php  if(isset($_SESSION["message"])){
          ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert"" >
            <p><?= $_SESSION["message"]; ?></p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <?php
            unset($_SESSION["message"]);
      }
       ?>
                  <form class="needs-validation pb-2" method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                  <div class="md-3">
                      <label class="form-label" for="profile-name">Name</label>
                      <input class="form-control" id="profile-name" type="text" value="" name="clientname" placeholder="Uju Nwamama" required>
                      <input type="hidden" name="date" value="<?php echo date("Y-m-d"); ?>">
                      <input type="hidden" name="text" value="<?php $email; ?>">
                    </div>
                  <div class="md-3">
                      <label class="form-label" for="profile-email">Email</label>
                      <input class="form-control" id="profile-email" type="email" value="" name="clientemail" placeholder="ugu@gmail.com" required>
                    </div>
                    <div class="mb-3">
                    <label class="form-label" for="message">Message</label>
                      <textarea class="form-control" maxlength="500" rows="6" placeholder="Your message" name="message" required></textarea>
                      <div class="invalid-feedback">Please wirte your message!</div>
                    </div>
                    <button class="btn btn-primary btn-sm d-block w-100" type="submit" name="client">Send</button>
                  </form>
                </div>
              </div>
            </aside>
            <!-- Content-->
    

            <section class="col-lg-8 pt-lg-4 pb-md-4">
              <div class="pt-2 px-4 ps-lg-0 pe-xl-5">
                <h2 class="h3 pt-2 pb-4 mb-4 text-center text-sm-start border-bottom">Products</h2>
                <div class="row pt-2">
                  <!-- Product-->
                  <?php
                  if(isset($user_id)){
                      $sqls = "SELECT * FROM product WHERE user_id=$user_id ORDER BY date DESC";
                      $results = mysqli_query($conn , $sqls);
                      while($rows = mysqli_fetch_assoc($results)){
                        $product_image = safe($rows['image']);
                        $product_name = safe($rows['name']);
                        $product_amount = safe($rows['amount']);
                        $product_timestamp = safe($rows['date']);
                        $product_id = safe($rows['id']);
                  ?>
                  
                  <div class="col-sm-6 mb-grid-gutter">
                    <div class="card product-card-alt">
                      <div class="product-thumb">
                        <div class="product-card-actions"><a class="btn btn-light btn-icon btn-shadow fs-base mx-2" href="productdetails.php?id=<?php echo $product_id; ?>"><i class="ci-eye"></i></a>
                        </div><a class="product-thumb-overlay" href="productdetails.php?id=<?php echo $product_id; ?>"></a><img src="./images/<?php echo $product_image; ?>" alt="Product">
                      </div>
                      <div class="card-body">
                        <div class="d-flex flex-wrap justify-content-between align-items-start pb-2">
                          <div class="text-muted fs-xs me-1"><a class="product-meta fw-medium" href="#">Posted on <?php echo date('M j',strtotime($product_timestamp)); ?></a></div>
                        </div>
                        <h3 class="product-title fs-sm mb-2"><a href="productdetails.php?id=<?php echo $product_id; ?>"><?php echo $product_name; ?></a></h3>
                        <div class="d-flex flex-wrap justify-content-between align-items-center">
                          <div class="bg-faded-accent text-accent rounded-1 py-1 px-2">$<?php echo $product_amount; ?>.<small>00</small></div>
                        </div>
                      </div>
                    </div>
                    </div>
                  
                  <?php  } }?>
                  </div>
              </div>
            </section>
          </div>
        </div>
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
    <!-- Main theme script-->
    <script src="js/theme.min.js"></script>
  </body>
</html>