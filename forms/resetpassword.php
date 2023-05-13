<?php
session_start();
include "../config.php";

$conn = db();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Password reset | UNNMarketplace</title>
    <!-- SEO Meta Tags-->
    <meta name="description" content="Cartzilla - Bootstrap E-commerce Template">
    <meta name="keywords" content="bootstrap, shop, e-commerce, market, modern, responsive,  business, mobile, bootstrap, html5, css3, js, gallery, slider, touch, creative, clean">
    <meta name="author" content="Createx Studio">
    <!-- Viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon and Touch Icons-->
    <link rel="apple-touch-icon" sizes="180x180" href="../apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon-16x16.png">
    <link rel="manifest" href="../site.webmanifest">
    <link rel="mask-icon" color="#fe6a6a" href="../img/icon/unnmarketplace logo.svg">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendor Styles including: Font Icons, Plugins, etc.-->
    <link rel="stylesheet" media="screen" href="../vendor/simplebar/dist/simplebar.min.css"/>
    <link rel="stylesheet" media="screen" href="../vendor/tiny-slider/dist/tiny-slider.css"/>
    <!-- Main Theme Styles + Bootstrap-->
    <link rel="stylesheet" media="screen" href="../css/theme.min.css">
  </head>
  <!-- Body-->
  <body  style="background-image:url(../img/pic.jpg);  background-repeat: no-repeat;">
    <!-- Sign in modal-->
    <div class="container" style="margin:auto;">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <?php  if(isset($_SESSION["message"])){
          ?>
          <div class="alert" >
            <h5><?= $_SESSION["message"]; ?></h5>
          </div>
          <?php
            unset($_SESSION["message"]);
      }
       ?>
          <div class="modal-header bg-secondary">
            <ul class="nav nav-tabs card-header-tabs" role="tablist">
              <li class="nav-item"><a class="nav-link fw-medium active" href="#" data-bs-toggle="tab" role="tab" aria-selected="true"><i class="ci-unlocked me-2 mt-n1"></i>Password Reset</a></li>
            </ul>
          </div>
          <div class="modal-body tab-content py-4">
            <form class="needs-validation tab-pane fade show active" autocomplete="off" id="signin-tab" action="../php/action.php" method="POST">
            
              <div class="mb-3">
                <label class="form-label" for="si-email">Email address</label>
                <input class="form-control" type="email" name="email" id="si-email" placeholder="mercy@gmail.com.com" value="<?php echo htmlspecialchars($_SESSION["email"]) ?? ""; ?>"  required>
                
                <div class="invalid-feedback">Please provide a valid email address.</div>
              </div>
              <div class="mb-3 d-flex flex-wrap justify-content-between">
            </div>
              <button class="btn btn-primary btn-shadow d-block w-100" name="reset" type="submit">Send</button>
            </form>
            
          </div>
        </div>
      </div>
    </div>
<!-- foter file -->
<?php include "forms_footer.php"; ?>
    <!-- Vendor scrits: js libraries and plugins-->
    <script src="../vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/simplebar/dist/simplebar.min.js"></script>
    <script src="../vendor/tiny-slider/dist/min/tiny-slider.js"></script>
    <!-- Main theme script-->
    <script src="../js/theme.min.js"></script>
  </body>
</html>