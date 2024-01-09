<?php
session_start();
include "../config.php";
$conn = db();

  if(isset($_POST["submit"]))
{

      $imageName = safe($_FILES["image"]["name"]);
      $tmpName = $_FILES["image"]["tmp_name"];
      $name = safe($_POST["name"]);
      $amount = safe($_POST["amount"]);
      $type = safe($_POST["type"]);
      $desc = safe($_POST["desc"]);
      $category = safe($_POST['category']);
      $id = $_POST["id"];
      $date = safe($_POST["date"]);

      // Image extension validation
  $validImageExtension = ['jpg', 'jpeg', 'png'];
  $imageExtension = explode('.', $imageName);

  $extensionname = $imageExtension[0];
  $imageExtension = strtolower(end($imageExtension));
  
if (!empty(!in_array($imageExtension, $validImageExtension)))
{
    $response = array(
      "type" => "alert-danger",
      "message" => "Unacceptable image extension. Please use image with 'jpg', 'jpeg' and 'png' extension"
  );
        // Validate image file size
    if(($_FILES["image"]["size"] > 4000000)) {
      $response = array(
          "type" => "alert-danger",
          "message" => "Image size exceeds 4MB.Sorry we only accept image with maximum of 4mb"
      );
    }else{
      // Generate new image name
      $uniquename = uniqid();
      $newImageName = $uniquename . '.' . $imageExtension;
      $target = "../images/" . $newImageName;



  if(move_uploaded_file($tmpName, $target)){
    $stmt = $conn->prepare("INSERT INTO `product`(image,amount,type,descp,name,category,date,user_id) VALUES (?,?,?,?,?,?,?,?)");
    $stmt->bind_param("sisssssi", $newImageName, $amount, $type, $desc, $name, $category,$date, $id);
    if($stmt->execute()){
      $response = array(
        "type" => "alert-success",
        "message" => "Item added successfully"
      );
    } else {
      $response = array(
        "type" => "alert-danger",
        "message" => "Try again"
      );
    }
  } else {
    $response = array(
      "type" => "alert-danger",
      "message" => "Failed to upload file"
    );
  }
  }
  }
    else{
      $stmt = $conn->prepare("INSERT INTO `used`(image,amount,location,about,name,number,date,email) VALUES (?,?,?,?,?,?,?,?)");
      $stmt->bind_param("sisssssi", $newImageName, $email,$name,$number,$description,$location,$image,$dates);
      if($stmt->execute()){
        $response = array(
          "type" => "alert-success",
          "message" => "Item added successfully"
        );
      } else {
        $response = array(
          "type" => "alert-danger",
          "message" => "Try again"
        );
      }

   
  }
}

  $stmt = mysqli_prepare($conn, "SELECT * FROM `product` WHERE user_id = ?");
  mysqli_stmt_bind_param($stmt, "s", $user_id);
  mysqli_stmt_execute($stmt);
  $resultcount = mysqli_stmt_get_result($stmt);
  $count = mysqli_num_rows($resultcount);
  mysqli_stmt_close($stmt);
  

  date_default_timezone_set("Africa/Lagos");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title></title>
    <!-- SEO Meta Tags-->
    <meta name="description" content="Cartzilla - Bootstrap E-commerce Template">
    <meta name="keywords" content="bootstrap, shop, e-commerce, market, modern, responsive,  business, mobile, bootstrap, html5, css3, js, gallery, slider, touch, creative, clean">
    <meta name="author" content="Createx Studio">
    <!-- Viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon and Touch Icons-->
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">
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
    <main class="page-wrapper">
      <main class="container-fluid px-0">
        <hr>
        <section class="row g-0">
          <div class="col-md-6 bg-position-center bg-size-cover bg-secondary order-md-2" style="min-height: 15rem; background-image: url(../img/unnmarketplace.png);"></div>
          <div class="col-md-6 px-3 px-md-5 py-5 order-md-1">
            <div class="mx-auto py-lg-5" style="max-width: 35rem;">
              <h2 class="h3 mb-2">I am looking for a ..</h2>
              <p class="fs-sm text-muted pb-2">If you are looking for something please submit your request using the form below:</p>
              <form class="needs-validation row g-4" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                <div class="col-sm-6">
                <label class="form-label" for="">Price</label>
                  <input class="form-control" type="number" placeholder="The amount you want to sell" required>
                </div>
                <div class="col-sm-6">
                <label class="form-label">Email</label>
                  <input class="form-control" type="email" placeholder="How we will reach you" required>
                  <input type="hidden" name="date" value="<?php echo date("Y-m-d"); ?>">
                </div>
                <div class="col-sm-6">
                <label class="form-label">Location</label>
                  <input class="form-control" type="text" placeholder="Your location" maxlength="10">
                </div>
                <div class="col-sm-6">
                <label class="form-label">Number</label>
                  <input class="form-control" type="text" placeholder="This is how customers will reach you"  maxlength="11" required>
                </div>
                <div class="col-12">
                <label class="form-label">description</label>
                  <textarea class="form-control" rows="4" placeholder="description" maxlength="100"  required></textarea>
                </div>
                <div class="file-drop-area mb-3">
                    <div class="file-drop-icon ci-cloud-upload"></div><span class="file-drop-message">Drag and drop here to upload product screenshot</span>
                    <input class="file-drop-input" type="file" name="image" accept=".jpeg,.png,.jpg">
                    <button class="file-drop-btn btn btn-primary btn-sm mb-2" type="button">Or select file</button>
                    <div class="form-text">Upload JPG, jpeg or PNG image is required.</div>
                  </div>
                <div class="col-12">
                  <button class="btn btn-info btn-shadow" type="submit">Submit your request</button>
                </div>
              </form>
            </div>
          </div>
        </section>
      </main>
    </main>
    <?php include "forms_footer.php"; ?>
    <!-- Vendor scrits: js libraries and plugins-->
    <script src="../vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/simplebar/dist/simplebar.min.js"></script>
    <script src="../vendor/tiny-slider/dist/min/tiny-slider.js"></script>
    <script src="../vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
    <!-- Main theme script-->
    <script src="../js/theme.min.js"></script>
  </body>
</html>