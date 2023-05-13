<?php
session_start();

if(!isset($_SESSION["admin"])){
  header("location:../index.php");
  exit(0);
}
include "../config.php";
$conn = db();

$admin_id = $_SESSION["admin_id"];
include_once "./admin_info.php";

$sqlcount = "SELECT * FROM `product` ";
$resultcount = mysqli_query($conn , $sqlcount);
$count = mysqli_num_rows($resultcount);

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
    <title>Product List</title>
    <!-- SEO Meta Tags-->
    <meta name="description" content="Admin">
    <meta name="keywords" content="Admin, e-commerce, market, honest, dealer, unn students market">
    <meta name="author" content="Truth">
    <!-- Viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon and Touch Icons-->
    <link rel="apple-touch-icon" sizes="180x180" href="../apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon-16x16.png">
    <link rel="manifest" href="../site.webmanifest">
    <link rel="mask-icon" color="#fe6a6a" href="../safari-pinned-tab.svg">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendor Styles including: Font Icons, Plugins, etc.-->
    <link rel="stylesheet" media="screen" href="../vendor/simplebar/dist/simplebar.min.css"/>
    <link rel="stylesheet" media="screen" href="../vendor/tiny-slider/dist/tiny-slider.css"/>
    <!-- Main Theme Styles + Bootstrap-->
    <link rel="stylesheet" media="screen" href="../css/theme.min.css">
  </head>
  <!-- Body-->
  <body class="handheld-toolbar-enabled">
      <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P7FCDD3"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    <main class="page-wrapper">
      <?= include "./adminheader.php"; ?>
      <div class="container mb-5 pb-3">
        <div class="bg-light shadow-lg rounded-3 overflow-hidden">
          <div class="row">
            <!-- Sidebar-->
            <?php  include "./adminsidebar.php"; ?>
            <!--Admin contents--- Content-->
            <section class="col-lg-9 pt-lg-4 pb-4 mb-3">
              <div class="pt-2 px-4 ps-lg-0 pe-xl-5">
                <h1 class="h3 mb-4 pb-2 text-sm-start text-center">Product List</h1>
                <div class="bg-secondary rounded-3 p-4">
                  <table class="table table-hover">
                    <thead>
                    <tr>
                      <th scope="col">Item</th>
                      <th scope="col">ID</th>
                      <th scope="col">Edit</th>
                      <th scope="col">Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row"><img class="rounded-circle" src="../img/toonme.jpg" alt="truth" width="45" height="45"></th>
                      <td>001</td>
                      <td><a class="btn btn-sm btn-success rounded-1" href="#">Edit</a></td>
                      <td><a class="btn btn-sm btn-danger rounded-1" href="#">Delete</a></td>
                    </tr>
                    <?php
                      $sqls = "SELECT * FROM `product` WhERE user_id='1' ORDER BY 'date' DESC ";
                      $results = mysqli_query($conn , $sqls);
                      $count = mysqli_num_rows($results);
                      while($rows = mysqli_fetch_assoc($results)){
                    ?>
                      <tr>
                        <td> <img width="40" height="32" src="../images/<?php echo safe($rows['image']); ?>" /></td>
                          <td><?php echo safe($rows['id']); ?></td>
                          <td><a class="btn btn-sm btn-success rounded-1" href="./updateproduct.php?id=<?php echo safe($rows['id']); ?>&user_id=<?php echo safe($rows['user_id']); ?>">Edit</a> </td>
                          <td> <a class="btn btn-sm btn-danger rounded-1" onclick=" javascript:return confirm('Are you sure to delete this');" href="./delete.php?id=<?php echo safe($rows['id']); ?>">Delete</a>
                        </td>
                      </tr>
                <?php 
                      }
                ?>


                  </tbody>
                  </table>
                              <!-- vendors contents -->
                <h1 class="h3 mb-4 pb-2 text-sm-start text-center">Vendors Product List</h1>
                <div class="bg-secondary rounded-3 p-4">

                  <table class="table table-hover">
                    <thead>
                    <tr>
                      <th scope="col">Item</th>
                      <th scope="col">ID</th>
                      <th scope="col">Edit</th>
                      <th scope="col">Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row"><img class="rounded-circle" src="../img/toonme.jpg" alt="truth" width="45" height="45"></th>
                      <td>001</td>
                      <td><a class="btn btn-sm btn-success rounded-1" href="#">Edit</a></td>
                      <td><a class="btn btn-sm btn-danger rounded-1" href="#">Delete</a></td>
                    </tr>
                    <?php
                      $vendors_sqls = "SELECT * FROM `product` ORDER BY date DESC ";
                      $results = mysqli_query($conn , $vendors_sqls);
                      $count = mysqli_num_rows($results);
                      while($rows = mysqli_fetch_assoc($results)){
                      ?>

                        <tr>
                        <td> <img width="40" height="32" src="../images/<?php echo safe($rows['image']); ?>" /></td>
                          <td><?php echo safe($rows['id']); ?></td>
                          <td><a class="btn btn-sm btn-success rounded-1" href="./updateproduct.php?id=<?php echo safe($rows['id']); ?>&user_id=<?php echo safe($rows['user_id']); ?>">Edit</a> </td>
                          <td> <a class="btn btn-sm btn-danger rounded-1" onclick=" javascript:return confirm('Are you sure to delete this');" href="./delete.php?id=<?php echo safe($rows['id']); ?>">Delete</a>
                        </td>
                        </tr>

                        <?php 
                      }
                      ?>


                  </tbody>
                  </table>
                 
                </div>
                 
                </div>
              </div>
            </section>

          </div>
        </div>
      </div>
    </main>

    <hr class="my-3" style="
    margin-top: 3rem !important;
    margin-bottom: 3rem !important;
">
    <!-- Footer-->
    <?php include "../forms/forms_footer.php"; ?>
    <!-- Back To Top Button--><a class="btn-scroll-top" href="#top" data-scroll><span class="btn-scroll-top-tooltip text-muted fs-sm me-2">Top</span><i class="btn-scroll-top-icon ci-arrow-up">   </i></a>
    <!-- Vendor scrits: js libraries and plugins-->
    <script src="../vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/simplebar/dist/simplebar.min.js"></script>
    <script src="../vendor/tiny-slider/dist/min/tiny-slider.js"></script>
    <script src="../vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
    <!-- Main theme script-->
    <script src="../js/theme.min.js"></script>
  </body>

</html>