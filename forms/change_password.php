<?php 
include_once "../php/action.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Change Password | UNN Marketplace</title>
    <!-- SEO Meta Tags-->
    <meta name="description" content="Change password - ">
    <meta name="keywords" content="e-commerce, market, modern, responsive,  business">
    <meta name="author" content="Truth">
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
    <link rel="stylesheet" href="../css/style.css">
  </head>
  <!-- Body-->
  <body >
  <!-- sign up modal-->
  <div class="container"  style="margin:auto;">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      <?php  if(isset($_SESSION["message"])){
          ?>
          <div class="alert" >
            <h3><?= $_SESSION["message"]; ?></h3>
          </div>
          <?php
            unset($_SESSION["message"]);
      }
       ?>
        <div class="modal-header bg-secondary">
          <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item"><a class="nav-link fw-medium active" href="#signup-tab" data-bs-toggle="tab" role="tab" aria-selected="true"><i class="ci-edit-alt me-2 mt-n1"></i>Change Password</a></li>
          </ul>
        </div>
        <div class="modal-body tab-content py-4">
          <form class="needs-validation tab-pane fade show active" autocomplete="off" id="signup-tab" method="post" action="../php/action.php">
            <div class="mb-3">
              <label class="form-label" for="su-password">New Password</label>
              <div class="password-toggle">
              <input type="hidden" name="user_id"  value="<?php if(isset($_GET["user_id"])){ echo $_GET["user_id"];}?>">
                <input class="form-control" type="password" id="su-password" name="password" value="<?php echo htmlspecialchars($_SESSION["password"]) ?? ""; ?>" required>
                <label class="password-toggle-btn" aria-label="Show/hide password">
                  <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                </label>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label" for="su-password-confirm">Confirm password</label>
              <div class="password-toggle">
                <input class="form-control" type="password" id="su-password-confirm" name="confirmpassword" value="<?php echo htmlspecialchars($_SESSION["confirmpassword"]) ?? ""; ?>" required>
                <label class="password-toggle-btn" aria-label="Show/hide password">
                  <input class="password-toggle-check" type="checkbox" ><span class="password-toggle-indicator"></span>
                </label>
              </div>
            </div>
            <button class="btn btn-primary btn-shadow d-block w-100" name="changepassword" type="register">Change Password</button>
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