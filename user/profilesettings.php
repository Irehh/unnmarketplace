<?php

session_start();

if(!isset($_SESSION["authenticated"]))
   {
       $_SESSION["message"] = "Please login to access user dashboard";
       header("location:../forms/login.php");
       exit(0);
   }
   $location= $about= $tags= $link ="";

include "../config.php";
$conn = db();

// $acct_id = safe($_GET['user_id']);
$user_id = $_SESSION['auth_user']['user_id'];
//dont delete
include "user_info.php";

  if(isset($_POST["submit"])){

      $imageName = safe($_FILES["image"]["name"]);
      $tmpName = $_FILES["image"]["tmp_name"];
      $link = safe($_POST["link"]);
      $location = safe($_POST["location"]);
      $about = safe($_POST["about"]);
      $tags = safe($_POST["tags"]);

      // Image extension validation
  $validImageExtension = ['jpg', 'jpeg', 'png'];
  $imageExtension = explode('.', $imageName);

  $extensionname = $imageExtension[0];
  $imageExtension = strtolower(end($imageExtension));
  

  if (!in_array($imageExtension, $validImageExtension))
  {
    $response = array(
      "type" => "alert-danger",
      "message" => "Unacceptable image extension. Please use image with 'jpg', 'jpeg' and 'png' extension"
  );
  }
  // Validate image file size

elseif(($_FILES["image"]["size"] > 4000000)) {
  $response = array(
      "type" => "alert-danger",
      "message" => "Image size exceeds 3MB.Sorry we only accept image with maximum of 4mb"
  );
}elseif(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $tags))
{
  $response = array(
    "type" => "alert-danger",
    "message" => "Tags -Must be a comma separated list"
);

}
elseif(!filter_var($link, FILTER_SANITIZE_URL))
{
  $response = array(
    "type" => "alert-danger",
    "message" => "Please enter a valid link"
);

}
  else{
    // Generate new image name
    $uniquename = uniqid();
    $newImageName = $uniquename . '.' . $imageExtension;
    $target = "../images/" . $newImageName;
    $tags = strtolower($tags);

      if(move_uploaded_file($tmpName, $target)){

        $sql = "UPDATE `users` SET image='$newImageName',link='$link',location='$location',about='$about',tags='$tags' WHERE id=$user_id ";

        $result = mysqli_query($conn,$sql);
     if($result){
      
      $response = array(
        "type" => "alert-success",
        "message" => "About business added succcessfully"
    );
    header("location:http://localhost/unnmarketplace/user/profilesettings.php") ;
    exit;
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
    <title>UNNMarketplace - Account</title>
    <!-- SEO Meta Tags-->
    <meta name="description" content="UNNMarketplace - Account">
    <meta name="keywords" content="shop, e-commerce, market, modern, responsive,  business, ">
    <meta name="author" content="Truth">
      <meta property="og:type"          content="website" />
     <meta property="og:title"         content="<?php echo $username; ?>" />
    <meta property="og:description"   content="<?php echo $userabout; ?>" />
    <!-- Viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon and Touch Icons-->
    <link rel="apple-touch-icon" sizes="180x180" href="../apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon-16x16.png">
    <link rel="manifest" href="../site.webmanifest">
    <link rel="mask-icon" color="#fe6a6a" href="./img/icon/unnmarketplace logo.svg">
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
      <!-- Navbar for NFT Marketplace demo-->
      <!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
      <?= include "userheader.php"; ?>
      <div class="container mb-5 pb-3">
        <div class="bg-light shadow-lg rounded-3 overflow-hidden">
          <div class="row">
            <!-- Sidebar-->
            <?php include "usersidebar.php";  ?>
            <!-- Content-->
            <section class="col-lg-9 pt-lg-4 pb-4 mb-3">
              <div class="pt-2 px-4 ps-lg-0 pe-xl-5">
                <h1 class="h3 mb-4 pt-2 text-center text-sm-start">Add Profile Details</h1>
                <!-- alert -->
                <?php if(!empty($response)) { ?>
              <div class="alert <?php echo $response["type"]; ?> alert-dismissible fade show" role="alert">
                <span class="fw-medium">alert:</span> <?php echo $response["message"]; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>

              </div>
              <?php unset($response);}?>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                  <div class="row gy-3 mb-4 pb-md-3 mb-2">
                  <div class="file-drop-area mb-3">
                    <div class="file-drop-icon ci-cloud-upload"></div><span class="file-drop-message">Drag and drop here to upload product screenshot</span>
                    <input class="file-drop-input" type="file" name="image" value="<?php echo $image; ?>">
                    <button class="file-drop-btn btn btn-primary btn-sm mb-2" type="button">Or select file</button>
                    <div class="form-text">Upload JPG, jpeg or PNG image is required.</div>
                  </div>
                    <div class="col-sm-6">
                      <label class="form-label" for="profile-location">Location</label>
                      <input class="form-control" id="profile-Location" type="text" name="location" value="<?php echo $location; ?>" placeholder="hilltop">
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label" for="profile-location">Tags</label>
                      <input class="form-control" id="profile-Location" type="text" name="tags" value="<?php echo $tags; ?>">
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label" for="profile-website">Preferred link</label>
                      <input class="form-control" id="profile-website" type="url" name="link" placeholder="Enter URL" value="<?php echo $link; ?>">
                    </div>
                    <div class="col-12">
                      <label class="form-label" for="profile-bio">Short Description</label>
                      <textarea  maxlength="300" class="form-control" id="profile-bio" name="about" rows="4" placeholder="Tell about your business in few words"><?php echo $about; ?></textarea><span class="form-text">0 of 300 characters used.</span>
                    </div>
                  </div>
                  <!-- Submit-->
                  <div class="d-flex flex-sm-row flex-column">
                    <button class="btn btn-accent" type="submit" name="submit">Add profile</button>
                  </div>
                </form>
              </div>
            </section>
          </div>
        </div>
      </div>
    </main>
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