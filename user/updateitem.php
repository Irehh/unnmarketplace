<?php

session_start();

if(!isset($_SESSION["authenticated"]))
{
    $_SESSION["message"] = "Please login to access user dashboard";
    header("location:../forms/login.php");
    exit(0);
}
// database connection
include "../config.php";
$conn = db();
$user_id = $_SESSION['auth_user']['user_id'];
include "user_info.php";

//user ids
$id = safe($_GET['id']);
$acct_id = safe($_GET['user_id']);

  //select data from database
  $change = "SELECT * FROM product WHERE user_id=$acct_id AND id=$id limit 1 ";
  $result=mysqli_query($conn,$change);
  while($row=mysqli_fetch_assoc($result)){
  $oldname = safe($row['name']);
  $oldamount = safe($row['amount']);
  $olddesc = safe($row['descp']);
  $oldimage = safe($row['image']);
  }

if(isset($_POST["submit"]))
{

  $imageName = safe($_FILES["image"]["name"]);
  $tmpName = $_FILES["image"]["tmp_name"];
  $name = safe($_POST["name"]);
  $amount = safe($_POST["amount"]);
  $type = safe($_POST["type"]);
  $desc = safe($_POST["desc"]);
  $category = safe($_POST['category']);
  $date = safe($_POST['date']);

  // assuming that $productId is the ID of the product being updated
if ($_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) 
{
  // if the user uploaded a new image

  $validImageExtension = ['jpg', 'jpeg', 'png'];
  $imageExtension = explode('.', $imageName);

  $extensionname = $imageExtension[0];
  $imageExtension = strtolower(end($imageExtension));


if (!in_array($imageExtension, $validImageExtension))
{
  $response = array(
    "type" => "alert-danger",
    "message" =>  "Unacceptable image extension. Please use image with 'jpg', 'jpeg' and 'png' extension"
  );
  // $path = "../images/" . safe($row['image']);
  // unlink($path);
}
// Validate image file size

elseif(($_FILES["image"]["size"] > 10000000)) 
{
  $response = array(
    "type" => "alert-danger",
    "message" => "Image size exceeds 10MB.crop the image"
  );
}
else
{
  $source_url = $tmpName;
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
        $quality = 55;
      }
      else
      {
        $quality = 75;
      }

  $delete_old_image = "../images/".$oldimage;
if (compress_image($source_url, $destination_url, $quality, $width, $height))
{
  if(file_exists($delete_old_image))
  {
    unlink($delete_old_image);
  }
} else
{
  $response = array(
    "type" => "alert-danger",
    "message" => "An error ocurred. Try again"
  );
}

} 
} else 
{
  // if the user did not upload a new image, keep the old image
  $Imagename = $oldimage;
}

  // Prepare the SQL statement
  $stmt = mysqli_prepare($conn, "UPDATE product SET image=?, type=?,date=?, amount=?, descp=?, name=?, category=? WHERE id=?");

  // Bind the parameters to the SQL statement
  mysqli_stmt_bind_param($stmt, 'sssisssi', $newImageName, $type, $date, $amount, $desc, $name, $category, $id);

  // Execute the prepared statement
  mysqli_stmt_execute($stmt);

  // Check if the update was successful
  if (mysqli_stmt_affected_rows($stmt) > 0) {
    $response = array(
      "type" => "alert-success",
      "message" => "Item updated successfully"
    );
  } else 
  {
    $response = array(
      "type" => "alert-danger",
      "message" => "Try again"
    );
    // include "unused.php";
  }
  // Close the prepared statement
  mysqli_stmt_close($stmt);

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title></title>
    <!-- SEO Meta Tags-->
    <meta name="description" content="Update item | UNNMarketplace">
    <meta name="keywords" content="item update, unnmarketplace, market, honest, dealer">
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
    <link rel="stylesheet" media="screen" href="../vendor/simplebar/dist/simplebar.min.css"/>
    <link rel="stylesheet" media="screen" href="../vendor/tiny-slider/dist/tiny-slider.css"/>
    <!-- Main Theme Styles + Bootstrap-->
    <link rel="stylesheet" media="screen" href="../css/theme.min.css">
   
  </head>
  <!-- Body-->
  <body class="handheld-toolbar-enabled">

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
                <h1 class="h3 mb-4 pt-2 text-center text-sm-start">Update Product Details</h1>
                <?php if(!empty($response)){ ?>
          <div class="alert <?php echo $response['type']; ?>">
          <?php echo $response['message']; ?>
           </div>
          <?php } ?>

          <img style="margin: auto;" src="../images/<?php echo $oldimage; ?>"  width='100' height='100'>
                <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                  <div class="row gy-3 mb-4 pb-md-3 mb-2">
                  <div class="file-drop-area mb-3">
                    <div class="file-drop-icon ci-cloud-upload"></div><span class="file-drop-message">Drag and drop here to upload product screenshot</span>
                    <input class="file-drop-input" type="file" name="image" value="<?php echo $imagename; ?>">
                    <button class="file-drop-btn btn btn-primary btn-sm mb-2" type="button">Or select file</button>
                    <div class="form-text">Upload JPG, jpeg or PNG image is required.</div>
                  </div>
                  <!-- <div class="form-group">
                    <input type="file" class="form-control-file" placeholder="" name="image" id="exampleFormControlFile1" onchange="getImagePreview(event)">
                  </div> -->
                  <!-- <div id="preview"></div> -->
                    <div class="col-sm-6">
                      <label class="form-label" for="profile-name">Name</label>
                      <input class="form-control" id="profile-name" name="name" required type="text" value="<?php echo $oldname; ?>">
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
                      <input class="form-control" id="profile-amount" name="amount" type="number" placeholder="5000" value="<?php echo $oldamount; ?>" max="10000000">
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
                      <textarea class="form-control" maxlength="500" name="desc" id="profile-bio" rows="4" placeholder="<?php echo $olddesc; ?>" value="<?php echo $olddesc; ?>"><?php echo $olddesc; ?></textarea><span class="form-text">0 of 500 characters used.</span>
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
    <!-- <script type="text/javascript">
       function getImagePreview(event){
      var image =URL.createObjectURL(event.target.files[0]);
      var imagediv = document.getElementById('preview');
      var newimg = document.createElement('img');  
      newimg.src = image;
      imagediv.innerHTML= '';
      newimg.width ="300";
      imagediv.appendChild(newimg);
    } -->

    </script>
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