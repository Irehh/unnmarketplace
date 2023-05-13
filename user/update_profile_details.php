<?php

session_start();

if(!isset($_SESSION["authenticated"]))
   {
       $_SESSION["message"] = "Please login to access user dashboard";
       header("location:../forms/login.php");
       exit(0);
   }

include "../config.php";
$conn = db();

$user_id = $_SESSION['auth_user']['user_id'];
include "user_info.php";
$location= $about= $link ="";

  //select data from database
  $change = "SELECT * FROM users WHERE id=$user_id limit 1 ";
  $oldresult=mysqli_query($conn,$change);
  $row=mysqli_fetch_assoc($oldresult);
  $oldname = safe($row['name']);
  $oldlink = safe($row['link']);
  $oldabout = safe($row['about']);
  $oldimage = safe($row['image']);
  $oldnumber = safe($row['number']);
  $oldlocation = safe($row['location']);
  
//for about user
  if(isset($_POST["submit"]))
  {
    
      $link = safe($_POST["link"]);
      $location = safe($_POST["location"]);
      $about = safe($_POST["about"]);
      $link = filter_var($link, FILTER_SANITIZE_URL);
      $name = safe($_POST["name"]);
      $number = safe($_POST["number"]);

      if(!empty($number)){
        if(!preg_match("/^([0-9]{11})$/", $number)) {
          $_SESSION["message"] = "Enter a correct phone number. This is how customers will reach you";
          header("location:./update_profile_details.php");
          exit();
          }
        }

        $stmt = mysqli_prepare($conn, "UPDATE users SET name=?, number=?, link=?,location=?,about=? WHERE id=$user_id");
        mysqli_stmt_bind_param($stmt, "sisss",$name,$number, $link, $location, $about);
         
        if (mysqli_stmt_execute($stmt)) {
          $response = array(
            "type" => "alert-success",
            "message" => "About added successfully"
          );
        }
        else{
      $response = array(
        "type" => "alert-danger",
        "message" => "Try again"
    );
     }

  }

  if(isset($_POST["change_image"]))
{
    $imageName = safe($_FILES["image"]["name"]);
    $tmpName = $_FILES["image"]["tmp_name"];
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

    elseif(($_FILES["image"]["size"] > 6000000)) {
      $response = array(
          "type" => "alert-danger",
          "message" => "Image size exceeds 6MB.Sorry we only accept image with maximum of 4mb"
      );
    }
  else{
       function compress_image($source_url, $destination_url, $quality)
    {
        $info = getimagesize($source_url);
         
        if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url);
        elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url);
        elseif ($info['mime'] == 'image/jpg') $image = imagecreatefromjpeg($source_url);
         
        //save it
        imagejpeg($image, $destination_url, $quality);
             
        //return destination file url
        return $destination_url;    
    }
    // Generate new image name
    $uniquename = uniqid();
    $newImageName = $uniquename . '.' . $imageExtension;
    $target = "../profile_image/" . $newImageName;
    $delete_old_image = "../profile_image/".$oldimage;
    
     if($_FILES["image"]["size"] > 3000000 )
      {
        $compressimage = compress_image($tmpName, $target, 3);
      }
         elseif($_FILES["image"]["size"] > 1000000 && $_FILES["image"]["size"] < 3000000)
      {
        $compressimage = compress_image($tmpName, $target, 5);
      }
        elseif($_FILES["image"]["size"] < 1000000 && $_FILES["image"]["size"] > 200000)
      {
        $compressimage = compress_image($tmpName, $target, 20);
      }
      else
      {
        $compressimage = compress_image($tmpName, $target, 50);
      }
    if ($compressimage) {
      // !empty(rename($delete_old_image, $trash_old_image));
      if(file_exists($delete_old_image)){
        unlink($delete_old_image);
      }
      $stmt = $conn->prepare("UPDATE `users` SET image=? WHERE id=?");
      $stmt->bind_param("si", $newImageName, $user_id);
      if ($stmt->execute()) {
        // $response = array(
        //   "type" => "alert-success",
        //   "message" => "Image updated successfully"
        // );
        $_SESSION["message"] = "Image updated successfully";
    header("location:./dashboard.php");
    exit();
      } else {
        $response = array(
          "type" => "alert-danger",
          "message" => "Try again"
        );
        echo mysqli_stmt_error($stmt);
      }
    } else {
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
    <title>Update Profile |  UNNMarketplace - Account</title>
    <!-- SEO Meta Tags-->
    <meta name="description" content="UNNMarketplace -Update Account ">
    <meta name="keywords" content=", shop, e-commerce, market, modern, responsive,  business, mobileUNNMarketplace -Update Account ">
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
                <h1 class="h3 mb-4 pt-2 text-center text-sm-start">Update Profile Details</h1>
                 <!-- alert -->
                 <?php if(!empty($response)) { ?>
              <div class="alert <?php echo $response["type"]; ?> alert-dismissible fade show" role="alert">
                <span class="fw-medium"><?php echo $response["message"]; ?></span> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>

              </div>
              <?php unset($response);}?>
              <?php  if(isset($_SESSION["message"])){
          ?>
          <div class="alert <?php echo $response["type"]; ?> alert-dismissible fade show" role="alert">
                <span class="fw-medium"><?= $_SESSION["message"]; ?></span> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <div class="alert" >
            <h3></h3>
          </div>
          <?php
            unset($_SESSION["message"]);
      }
       ?>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">   
              <div class="row gy-3 mb-4 pb-md-3 mb-2">
                    <div class="col-sm-6">
                      <label class="form-label" for="profile-name">Name</label>
                      <input class="form-control" id="profile-name" name="name" type="text" value="<?php echo $oldname; ?>" placeholder="A-Z collections">
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label" for="reg-phone">Phone Number</label>
                  <input class="form-control" type="text" required id="reg-phone" name="number" placeholder="09046684644" value="<?php echo "0" . $oldnumber; ?>">
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label" for="profile-location">Location</label>
                      <input class="form-control" id="profile-Location" type="text" name="location" placeholder="Hilltop" value="<?php echo $oldlocation; ?>">
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label" for="profile-website">Preferred link</label>
                      <input class="form-control" id="profile-website" type="url" name="link" value="<?php echo $oldlink; ?>" placeholder="Enter URL">
                    </div>
                    <div class="col-12">
                      <label class="form-label" for="profile-bio">Short bio</label>
                      <textarea  maxlength="500" class="form-control" id="profile-bio" name="about" rows="4" placeholder="Tell us about you in few words"><?php echo $oldabout; ?></textarea><span class="form-text">0 of 500 characters used.</span>
                    </div>
                  </div>
                  <!-- Submit-->
                  <div class="d-flex flex-sm-row flex-column">
                    <button class="btn btn-accent" type="submit" name="submit">Update</button>
                  </div>
                </form>

                <!-- form for updating image -->
                <h1 class="h3 mb-4 pt-2 text-center text-sm-start">Change Image</h1>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                <div class="file-drop-area mb-3">
                    <div class="file-drop-icon ci-cloud-upload"></div><span class="file-drop-message">Drag and drop here to upload your DP</span>
                    <input class="file-drop-input" type="file" name="image" value="">
                    <button class="file-drop-btn btn btn-primary btn-sm mb-2" type="button">Or select file</button>
                    <div class="form-text">Upload JPG, jpeg or PNG image is required.</div>
                </div>
                  <!-- Submit-->
                  <div class="d-flex flex-sm-row flex-column">
                    <button class="btn btn-accent" type="submit" name="change_image">Change Image</button>
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