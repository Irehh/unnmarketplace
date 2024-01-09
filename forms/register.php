<?php  
session_start();
if(isset($_SESSION["authenticated"]))
{
       $_SESSION["message"] = "You are log in";
       header("location:../index.php");
       exit(0);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Sign Up | UNN Marketplace</title>
    <!-- SEO Meta Tags-->
    <meta name="description" content="Sign up and start selling - A marketplace for students">
    <meta name="keywords" content="Registration form, shop, e-commerce, market, unnmarketplace, responsive,  business, used items  in unn, sell used item in unnmarketplace">
    <meta name="author" content="Truth">
    <meta property="og:title"         content="Come sell with us!" />
    <meta property="og:description"   content="A marketplace for students to buy and sell used items for free." />
    <meta property="og:image"         content="http://localhost/unnmarketplace/img/UNN_Fountain.png" />
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
  <body>
  <!-- sign up modal-->
  <div class="container" style="margin:auto;">
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
            <li class="nav-item"><a class="nav-link fw-medium active" href="#signup-tab" data-bs-toggle="tab" role="tab" aria-selected="true"><i class="ci-add-user me-2 mt-n1"></i>Sign up</a></li>
          </ul>
        </div>
        <div class="modal-body tab-content py-4">
          <form class="needs-validation tab-pane fade show active" autocomplete="on" id="signup-tab" method="POST" action="../php/action.php">
            <div class="mb-3">
              <label class="form-label" for="su-name">Name</label>
              <input class="form-control" type="text" id="su-name" name="name" placeholder="John" value="<?php echo htmlspecialchars($_SESSION["name"]) ?? ""; ?>" maxlength="100" minlength="2"  required>
              <div class="invalid-feedback">Please fill in your name.</div>
            </div>
            <div class="mb-3">
              <label for="su-email">Email address</label>
              <input class="form-control" type="email" id="su-email" placeholder="johndoe@example.com" value="<?php echo htmlspecialchars($_SESSION["email"]) ?? ""; ?>" maxlength="50" name="email" required>
              <div class="invalid-feedback">Please provide a valid email address.</div>
            </div>
            <div class="mb-3">
              <label class="form-label" for="su-number">Number</label>
              <input class="form-control" type="text" id="su-number" placeholder="09035627134" value="<?php echo htmlspecialchars($_SESSION["number"]) ?? ""; ?>" maxlength="11" minlength="11" name="number" required>
              <input type="hidden" name="date" value="<?php echo date("Y-m-d"); ?>">
              <input type="hidden" name="verifytoken" value="<?php echo md5(rand()); ?>">
              <div class="invalid-feedback">Please fill in your number that is reachable.</div>
            </div>
            <div class="mb-3">
              <label class="form-label" for="su-password">Password</label>
              <div class="password-toggle">
                <input class="form-control" type="password" id="su-password" maxlength="30" value="<?php echo htmlspecialchars($_SESSION["password"]) ?? ""; ?>" name="password" required>
                <label class="password-toggle-btn" aria-label="Show/hide password">
                  <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                </label>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label" for="su-password-confirm">Confirm password</label>
              <div class="password-toggle">
                <input class="form-control" type="password" id="su-password-confirm" maxlength="30" value="<?php echo htmlspecialchars($_SESSION["confirmpassword"]) ?? ""; ?>" name="confirmpassword" required>
                <label class="password-toggle-btn" aria-label="Show/hide password">
                  <input class="password-toggle-check" type="checkbox" ><span class="password-toggle-indicator"></span>
                </label>
              </div>
            </div>
            <button class="btn btn-primary btn-shadow d-block w-100" name="register" type="register">Sign up</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- {"/^([0-9]{11})$/") -->
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