<?php
session_start();
if(!isset($_SESSION["authenticated"])) {
   $_SESSION["message"] = "Please login";
   header("location:../index.php");
   exit(0);
}

require_once "../config.php";
$conn = db();
$user_id = $_SESSION['auth_user']['user_id'];
require_once "user_info.php";

if(isset($_POST["submit"])) {
    $imageName = safe($_FILES["image"]["name"]);
    $source_url = $_FILES["image"]["tmp_name"];
    $name = safe($_POST["name"]);
    $amount = safe($_POST["amount"]);
    $type = safe($_POST["type"]);
    $desc = safe($_POST["desc"]);
    $category = safe($_POST['category']);
    $id = $_POST["id"];
    $date = safe($_POST["date"]);

    // Image extension validation
    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);
  
    if (!in_array($imageExtension, $validImageExtension)) {
        $response = [
            "type" => "alert-danger",
            "message" => "Unacceptable image extension. Please use image with 'jpg', 'jpeg' and 'png' extension"
        ];
    }
    // Validate image file size
    elseif($_FILES["image"]["size"] > 10000000) {
        $response = [
            "type" => "alert-danger",
            "message" => "Image size exceeds 10MB. Crop the image"
        ];
    } else {
        //Generate new image name
//      $newImageName = "../images/";
//      $newImageName1 =  $user_id . uniqid() . '.jpeg';
//       $target_width = 500;
//       $target_height = 500;
//         function compress_resize_rename_uploaded_image($tmpName, $imageName, $newImageName, $target_width, $target_height) 
// {
//         // Get the file extension of the uploaded image
//         $file_extension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
    
//         // Create an image resource based on the uploaded image
//         switch ($file_extension) {
//             case 'jpg':
//             case 'jpeg':
//                 $image = imagecreatefromjpeg($tmpName);
//                 break;
//             case 'png':
//                 $image = imagecreatefrompng($tmpName);
//                 break;
//             case 'gif':
//                 $image = imagecreatefromgif($tmpName);
//                 break;
//             default:
//                 return false;
//         }
    
//         // Get the current dimensions of the uploaded image
//         list($width, $height) = getimagesize($tmpName);
  
//             $new_width = $target_width;
//             $new_height = $target_height;
    
//         // Create a new image resource for the resized image
//         $resized_image = imagecreatetruecolor($new_width, $new_height);
    
//         // Resize the uploaded image to the new dimensions
//         imagecopyresampled($resized_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    
//         // Get the file size of the resized image
//         ob_start();
//         switch ($file_extension) {
//             case 'jpg':
//             case 'jpeg':
//                 imagejpeg($resized_image, null, 100);
//                 break;
//             case 'png':
//                 imagepng($resized_image, null, 9);
//                 break;
//             case 'gif':
//                 imagegif($resized_image, null);
//                 break;
//         }
//         $image_data = ob_get_clean();
//         $file_size = strlen($image_data);
    
//         // Compress the resized image and save it with the new name
//         if ($file_size > 1000000) {
//             $quality = 5;
//         } elseif ($file_size <= 1000000 && $file_size > 200000) {
//             $quality = 20;
//         } else {
//             $quality = 50;
//         }
//         switch ($file_extension) {
//             case 'jpg':
//             case 'jpeg':
//                 imagejpeg($resized_image, $newImageName, $quality);
//                 break;
//             case 'png':
//                 imagepng($resized_image, $newImageName);
//                 break;
//             case 'gif':
//                 imagegif($resized_image, $newImageName);
//                 break;
//         }
    
//         // Free up memory by destroying the image resources
//         imagedestroy($image);
//         imagedestroy($resized_image);
    
//         return true;
// }

        function compress_image($source_url, $destination_url, $quality, $width, $height) 
        {
          $info = getimagesize($source_url);
          
          if ($info['mime'] == 'image/jpeg') {
              $image = imagecreatefromjpeg($source_url);
          } elseif ($info['mime'] == 'image/png') {
              $image = imagecreatefrompng($source_url);
          } elseif ($info['mime'] == 'image/jpg') {
              $image = imagecreatefromjpeg($source_url);
          }
          
          // Resize the image to the desired dimensions
          $resized_image = imagecreatetruecolor($width, $height);
          imagecopyresampled($resized_image, $image, 0, 0, 0, 0, $width, $height, imagesx($image), imagesy($image));
          
          // Save the resized image to a file with the specified quality
          imagejpeg($resized_image, $destination_url, $quality);
          
          // Free up memory
          imagedestroy($image);
          imagedestroy($resized_image);
          
          // Return the destination file URL
          return $destination_url;
        }
      
        $width = 500;
       $height = 500;
       // Generate new image name
       $newImageName = $user_id . uniqid() . '.jpeg';
       $destination_url = "../images/" . $newImageName;

          if($_FILES["image"]["size"] >= 3000000 )
      {
        $quality = 31;
      }
         elseif($_FILES["image"]["size"] >= 2000000 && $_FILES["image"]["size"] < 3000000)
      {
        $quality = 36;
      }
        elseif($_FILES["image"]["size"] >= 1000000 && $_FILES["image"]["size"] < 2000000)
      {
        $quality = 43;
      } 
        elseif($_FILES["image"]["size"] >= 200000 && $_FILES["image"]["size"] < 1000000)
      {
        $quality = 43;
      }
      else
      {
        $quality = 75;
      }
        if(compress_image($source_url, $destination_url, $quality, $width, $height)) {
            $stmt = $conn->prepare("INSERT INTO `product`(image,amount,type,descp,name,category,date,user_id) VALUES (?,?,?,?,?,?,?,?)");
            $stmt->bind_param("sisssssi", $newImageName, $amount, $type, $desc, $name, $category,$date, $id);
          
            if($stmt->execute()) {
                $_SESSION["message"] = "Image added successfully";
                header("location:./dashboard.php");
                exit();
            } else {
                $response = [
                    "type" => "alert-danger",
                    "message" => "Try again"
                ];
            }
        } else {
            $response = [
                "type" => "alert-danger",
                "message" => "Failed to upload file"
            ];
        } 
    }
}

$stmt = $conn->prepare("SELECT * FROM `product` WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$resultcount = $stmt->get_result();
$count = $resultcount->num_rows;
$stmt->close();

date_default_timezone_set("Africa/Lagos");
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
    <title>Add Item</title>
    <!-- SEO Meta Tags-->
    <meta name="description" content="<?php echo $userabout; ?>">
    <meta name="keywords" content="unnmarketplace vendor page shop, e-commerce, market, sell my property in UNN">
    <meta name="author" content="Truth">
    <!-- Viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon and Touch Icons-->
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="../image/png" sizes="32x32" href="../favicon-32x32.png">
    <link rel="icon" type="../image/png" sizes="16x16" href="../favicon-16x16.png">
    <link rel="manifest" href="../site.webmanifest">
    <link rel="mask-icon" color="#fe6a6a" href="./img/icon/unnmarketplace logo.svg">
    <meta property="og:type"          content="website" />
       <meta property="og:title"         content=" Hi! <?php echo $username; ?>" />
    <meta property="og:description"   content="<?php echo $userabout; ?>" />
    <meta property="og:image"         content="https://www.unnmarketplace.live/profile_image/<?php echo $userimage; ?>" />
    <meta property="og:image"         content="https://www.unnmarketplace.live/img/UNN_Fountain.png" />
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
            <?php include "usersidebar.php";  ?>
            <!-- Content-->
            <section class="col-lg-9 pt-lg-4 pb-4 mb-3">
              <div class="pt-2 px-4 ps-lg-0 pe-xl-5">
                <h1 class="h3 mb-4 pt-2 text-center text-sm-start">Add Product Details</h1>
                <!-- Warning alert -->
                <?php if(!empty($response)) { ?>
              <div class="alert <?php echo $response["type"]; ?> alert-dismissible fade show" role="alert">
                <span class="fw-medium">alert:</span> <?php echo $response["message"]; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php unset($response);}?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                  <div class="row gy-3 mb-4 pb-md-3 mb-2">
                    <div class="file-drop-area mb-3">
                    <div class="file-drop-icon ci-cloud-upload"></div><span class="file-drop-message">Drag and drop here to upload product screenshot</span>
                    <input class="file-drop-input" type="file" name="image" accept=".jpeg,.png,.jpg">
                    <button class="file-drop-btn btn btn-primary btn-sm mb-2" type="button">Or select file</button>
                    <div class="form-text">Upload JPG, jpeg or PNG image is required.</div>
                  </div>
                    <div class="col-sm-6">
                      <label class="form-label" for="profile-name">Name</label>
                      <input class="form-control" id="profile-name" name="name" type="text" value="" placeholer="plastic chair">
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label" for="dashboard-type">Type</label>
                        <select class="form-select" id="dashboard-type" name="type">
                          <option value selected>Select type</option>
                          <option value="New">New</option>
                          <option value="Used">Fairly Used</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label" for="profile-amount">Amount</label>
                      <input class="form-control" id="profile-amount" name="amount" type="number" placeholder="5000" min="" max="1000000"  value="">
                      <input type="hidden" name="date" value="<?php echo date("Y-m-d"); ?>">
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label" for="dashboard-category">Category</label>
                        <select class="form-select" id="dashboard-category" name="category">
                          <option value selected>Select Category</option>
                          <option value="Uncategorized">Uncategorized</option>
                          <option value="Gadgets">Gadgets</option>
                          <option value="Housing">Housing</option>
                          <option value="HomeFurniture">Furniture & Decor</option>
                          <option value="Services">Services</option>
                          <option value="Books">Books</option>
                          <option value="Free">Free</option>
                        </select>
                    </div>
                    <div class="col-12">
                      <label class="form-label" for="profile-bio">Short Description</label>
                      <textarea maxlength="500" class="form-control" spellcheck="true" name="desc" id="profile-bio" rows="4" placeholder="More about product in few words"></textarea><span class="form-text">0 of 500 characters used.</span>
                    </div>
                  </div>
                  <input type="hidden" name="id" value="<?php if(isset($_SESSION['auth_user'])) { echo $_SESSION['auth_user']['user_id'];} ?>" >
                  <!-- Submit-->
                  <div class="d-flex flex-sm-row flex-column">
                    <button class="btn btn-accent" name="submit" type="submit">Add Product</button>
                  </div>
                </form>
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