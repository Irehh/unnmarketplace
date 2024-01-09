<?php

session_start();
include("config.php");
$conn = db();
$info= "";

$query = "SELECT * FROM users WHERE 1";

if(isset($_GET['search'])){
  $search = safe($_GET['search']);
  $query .= " AND CONCAT(name,tags) LIKE '%$search%'";
  $info .= " $search";
}

$query .= " AND status='1' ORDER BY date DESC";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Vendors | UNNMarketplace</title>
    <!-- SEO Meta Tags-->
    <meta name="description" content="Vendors registerer on unnmarketplace">
    <meta name="keywords" content="Vendors registerer on unnmarketplace, sellers in unn, list of sellers, shop, e-commerce, market, honest, dealer, fashion, bags, latest bag, latest shoe, women shoe, used chairs">
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
                  <li class="breadcrumb-item"><a class="text-nowrap" href="index.php"><i class="ci-home"></i>Home</a></li>
                  <li class="breadcrumb-item text-nowrap"><a href="#">Catalog</a>
                  </li>
                  <li class="breadcrumb-item text-nowrap active" aria-current="page">Vendors</li>
                </ol>
              </nav>
            </div>
            <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
              <h1 class="h3 text-light mb-0">Vendors</h1>
            </div>
          </div>
        </div>
      </div>
      <div class="container pb-5 mb-2 mb-md-4">
        <form action="<?php  echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="GET">
        <div class="bg-light shadow-lg rounded-3 p-4 mt-n5 mb-4">
          <div class="row gy-3 gx-4 justify-content-between">
            <div class="col-md col-12 order-md-2 order-sm-1 order-1">
            <div class="input-group">
                <input class="form-control pe-5 rounded" type="text"  name="search" value="<?php  if(isset($_GET['search'])){echo $_GET['search']; } ?>" placeholder="search for vendors or services e.g design" maxlength="10"><i  class="ci-search position-absolute top-50 end-0 translate-middle-y zindex-5 me-3"></i>
              </div>
            </div>
          </div>
        </div>
        </form>
        <p><?php echo "Showing result for $info sort by latest "; ?></p>
        <!-- vendors grid-->
        <main class="container-fluid px-0">
        <!-- Section: Team-->
        <section class="container py-3 py-lg-5 mt-4 mb-3">
          <div class="row pt-3">
                      <!-- Product from search-->
      <?php 
             if(isset($_GET['search'])){
              $results = mysqli_query($conn , $query);
              if(mysqli_num_rows($results) > 0){
              while($rows = mysqli_fetch_assoc($results)){
                $about = $rows["about"];
                $position=67; // Define how many character you want to display.
                // $about is the text i want to trim
                 $post = substr($about, 0, $position); 
      ?>
             <div class="col-lg-4 col-sm-6 mb-grid-gutter">
              <div class="d-flex align-items-center"><img class="rounded-circle" src=".\profile_image\<?php echo $rows['image'] ?? 'logo.png'; ?>" width="96" alt="Vendor Profile Image">
                <div class="ps-3">
                  <h6 class="fs-base pt-1 mb-1"><a href="vendor_information.php?user_id=<?php echo $rows['id']; ?>"><?php echo safe($rows['name']); ?></a></h6>
                  <p class="fs-ms text-muted mb-0"><?php echo $post ?? "<i class='ci-smile me-2'></i>"; ?></p><a class="nav-link-style fs-ms text-nowrap" href="<?php echo safe($rows["link"]) ?? "tel:+234" . safe($rows['number']); ?>"><?php if($rows["link"] = ""){ echo "<i class='ci-link me-2'></i>" . safe($rows["link"]); }else{ echo "<i class='ci-phone me-2'></i>" . safe($rows['number']); } ?></a>
                </div>
              </div>
            </div>
            <?php }  } } else{
                 $results = mysqli_query($conn , $query);
              if(mysqli_num_rows($results) > 0){  
              while($rows = mysqli_fetch_assoc($results)){
                $about = safe($rows["about"]);

                $position=67; // Define how many character you want to display.
               // $about is the text i want to trim
                $post = substr($about, 0, $position); 
      ?>
            <div class="col-lg-4 col-sm-6 mb-grid-gutter">
              <div class="d-flex align-items-center"><img class="rounded-circle" src="./profile_image/<?php echo $rows['image'] ?? 'logo.png'; ?>" width="96" alt="Vendor Profile Image">
                <div class="ps-3">
                  <h6 class="fs-base pt-1 mb-1"><a href="./vendor_information.php?user_id=<?php echo $rows['id']; ?>"><?php echo safe($rows['name']); ?></a></h6>
                  <p class="fs-ms text-muted mb-0" style="overflow:hidden" ><?php echo $post ?? "<i class='ci-smile me-2'></i>"; ?></p><a class="nav-link-style fs-ms text-nowrap" style="overflow:hidden" href="<?php echo safe($rows["link"]) ?? "tel:+234" . safe($rows['number']); ?>"><?php if($rows["link"] = ""){ echo "<i class='ci-link me-2'></i>" . safe($rows["link"]); }else{ echo "<i class='ci-phone me-2'></i>" . safe($rows['number']); } ?></a>
                </div>
              </div>
            </div>
            <?php }  } }?>
          </div>
        </section>
      </main>
        <hr class="mt-4 mb-3">
        
    </main>
    </div>

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