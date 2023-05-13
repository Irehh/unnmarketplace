<?php

session_start();

if(!isset($_SESSION["admin"])){
  header("location:index.php");

}
include "config.php";
$conn = db();

$msg = $css_class ="";


$id = safe($_GET['id']);
$acct_id = safe($_GET['user_id']);

  //select data from database
  $change = "SELECT * FROM product WHERE user_id=$acct_id AND id=$id limit 1 ";
  $result=mysqli_query($conn,$change) or die("could not select");
  while($row=mysqli_fetch_assoc($result)){
  $oldname = safe($row['name']);
  $oldamount = safe($row['amount']);
  $olddesc = safe($row['descp']);
  $oldtype = safe($_POST["type"]);
  $oldimage = safe($row['image']);
  }

//update product

if(isset($_POST["submit"])){

  $imageName = safe($_FILES["image"]["name"]);
  $tmpName = $_FILES["image"]["tmp_name"];
  $name = safe($_POST["name"]);
  $amount = safe($_POST["amount"]);
  $type = safe($_POST["type"]);
  $desc = safe($_POST["desc"]);
  $category = safe($_POST['category']);
  $user_id = $_POST["user_id"];

  include "pathunlink.php";

  // Image extension validation
$validImageExtension = ['jpg', 'jpeg', 'png'];
$imageExtension = explode('.', $imageName);

$extensionname = $imageExtension[0];
$imageExtension = strtolower(end($imageExtension));


if (!in_array($imageExtension, $validImageExtension))
{
$msg = "Unacceptable image extension. Please use image with 'jpg', 'jpeg' and 'png' extension";
$css_class = "alert-danger";
}
// Validate image file size

elseif(($_FILES["image"]["size"] > 4000000)) {
$response = array(
  "type" => "alert-danger",
  "message" => "Image size exceeds 4MB.Sorry we only accept image with maximum of 4mb"
);
}
else{
// Generate new image name
$uniquename = uniqid("im");
$newImageName = $uniquename . '.' . $imageExtension;
$target = "../images/" . $newImageName;


 if(move_uploaded_file($tmpName, $target)){

    //update query
    $update = "UPDATE `product` SET `image`='$newImageName',`type`='$type',`amount`='$amount',`descp`='$desc',`name`='$name','category'='$category','user_id'='$user_id','timestamp'=CURRENT_TIMESTAMP() WHERE id = $id";

    $result = mysqli_query($conn,$update);
 if($result){
  
  $response = array(
    "type" => "alert-success",
    "message" => "Item updated succcessfully"
);
 }else{
  $response = array(
    "type" => "alert-danger",
    "message" => "Try again"
);
 }
}
else{
  $response = array(
    "type" => "alert-danger",
    "message" => "Failed to upload file"
);
  }
}
}

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
    <title></title>
    <!-- SEO Meta Tags-->
    <meta name="description" content="">
    <meta name="keywords" content=" e-commerce, market, honest, dealer, fashion, bags, latest bag, latest shoe, women shoe">
    <meta name="author" content="Truth">
    <!-- Viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon and Touch Icons-->
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="mask-icon" color="#fe6a6a" href="">
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
      <?= include "./template/adminheader.php"; ?>
      <div class="container mb-5 pb-3">
        <div class="bg-light shadow-lg rounded-3 overflow-hidden">
          <div class="row">
            <?php include "./template/adminsidebar.php";  ?>
            <!-- Content-->
<section class="col-lg-9 pt-lg-4 pb-4 mb-3">
              <div class="pt-2 px-4 ps-lg-0 pe-xl-5">
                <h1 class="h3 mb-4 pt-2 text-center text-sm-start">Update Product Details</h1>
                <?php if(!empty($msg)){ ?>
          <div class="alert <?php echo $css_class; ?>">
          <?php echo $msg; ?>
           </div>
          <?php } ?>

          <img src="images/<?php echo $oldimage1; ?>"  width='80' height='80'>
                <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                  <div class="row gy-3 mb-4 pb-md-3 mb-2">
                  <div class="form-group">
                    <input type="file" class="form-control-file" name="image" id="exampleFormControlFile1" onchange="getImagePreview(event)">
                  </div>
                  <div id="preview"></div>
                    <div class="col-sm-6">
                      <label class="form-label" for="profile-name">Name</label>
                      <input class="form-control" id="profile-name" name="name" type="text" value="<?php echo $oldname; ?>">
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label" for="profile-username">Brand</label>
                      <input class="form-control" id="profile-username" name="brand" value="<?php echo $oldbrand; ?>" type="text" placeholder="<?php echo $oldbrand; ?>">
                    </div>
                    <div class="col-sm-6">
                    <input type="hidden" name="user_id" value="<?php if(isset($_SESSION["admin_id"])) { echo $_SESSION["admin_id"];} ?>" >
                      <label for="category" class="form-label"> Category </label>
                      <div class="form-check">
                        <input class="form-check-input" placeholder="menshoe" type="radio" name="category" id="exampleRadios1" value="menshoe">
                        <label class="form-check-label" for="exampleRadios1">
                            menshoe
                          </label>
                      </div>
                      <div class="form-check">
                          <input class="form-check-input" placeholder="womenshoe" type="radio" name="category" id="exampleRadios2" value="womenshoe" checked>
                          <label class="form-check-label" for="exampleRadios2">
                              womenshoe
                          </label>
                      </div>
                      <div class="form-check">
                          <input class="form-check-input" placeholder="womenbag" type="radio" name="category" id="exampleRadios3" value="womenbag">
                          <label class="form-check-label" for="exampleRadios3">
                              Womenbag
                          </label>
                      </div>
                      <div class="form-check">
                          <input class="form-check-input" placeholder="others" type="radio" name="category" id="exampleRadios4" value="others">
                          <label class="form-check-label" for="exampleRadios4">
                              Others
                          </label>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label" for="profile-amount">Amount</label>
                      <input class="form-control" id="profile-amount" name="amount" type="number" placeholder="5000" value="<?php echo $oldamount; ?>" min="1000" max="200000"  value="" required>
                    </div>
                    <div class="col-12">
                      <label class="form-label" for="profile-bio">Short Description</label>
                      <textarea class="form-control" name="desc" id="profile-bio" rows="4" placeholder="<?php echo $olddesc; ?>" value="<?php echo $olddesc; ?>"><?php echo $olddesc; ?></textarea><span class="form-text">0 of 500 characters used.</span>
                    </div>
                  </div>
                  <!-- Submit-->
                  <div class="d-flex flex-sm-row flex-column">
                    <button class="btn btn-accent" name="submit" type="submit">Update Product</button>
                  </div>
                </form>
              </div>
            </section>
          </div>
        </div>
      </div>
    </main>

    <!-- script for image preview -->
    <script type="text/javascript">
       function getImagePreview(event){
      var image =URL.createObjectURL(event.target.files[0]);
      var imagediv = document.getElementById('preview');
      var newimg = document.createElement('img');  
      newimg.src = image;
      imagediv.innerHTML= '';
      newimg.width ="300";
      imagediv.appendChild(newimg);
    }

    </script>
    <hr class="my-3" style="
    margin-top: 3rem !important;
    margin-bottom: 3rem !important;
">
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
      <div class="d-table table-layout-fixed w-100"><a class="d-table-cell handheld-toolbar-item" href="nft-account-settings.html" data-bs-toggle="modal"><span class="handheld-toolbar-icon"><i class="ci-user"></i></span><span class="handheld-toolbar-label">Account</span></a><a class="d-table-cell handheld-toolbar-item" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" onclick="window.scrollTo(0, 0)"><span class="handheld-toolbar-icon"><i class="ci-menu"></i></span><span class="handheld-toolbar-label">Menu</span></a>
      </div>
    </div>
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