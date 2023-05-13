
<section class="container">
  <div class="card py-5 border-0 shadow">
    <div class="card-body py-md-4 py-3 px-4 text-center">
      <h3 class="mb-3">Never miss our offers!</h3>
      <p class="mb-4 pb-2">Subscribe to our ultra-exclusive drop list and be the first to know about upcoming drops.</p>
      <div class="widget mx-auto" style="max-width: 500px;">
        <form class="" action="./mailsub.php" method="POST"  >
          <div class="input-group flex-nowrap"><i class="ci-mail position-absolute top-50 translate-middle-y text-muted fs-base ms-3"></i>
            <input class="form-control rounded-start" type="email" name="mail" placeholder="Your email" required>
            <button class="btn btn-accent hover" type="submit" name="sub">Subscribe*</button>
          </div>
          <div class="form-text mt-3">*Receive early discount offers, updates and new products info.</div>
          <div class="subscription-status"></div>
        </form>
      </div>
    </div>
  </div>
</section>

<?php 

#form check
if ($_SERVER["REQUEST_METHOD"] == "POST"){
 if(isset($_POST['sub'])){
    // $mail = $_POST['mail'];

    // $emailsql = "INSERT INTO 'users' ('email') VALUES ('$mail')";
    // $result = mysqli_query($conn, $emailsql);
    // echo "nawa o";
    // if($result){

    //   echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    //   <strong>Holy guacamole!</strong> You should check in on some of those fields below.
    //   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    //     <span aria-hidden="true">&times;</span>
    //   </button>
    // </div>';

    // }

    $open = fopen("./custo.csv", 'a');
    $insert = $_POST['mail'];
    $data = array(
      'mail' => $insert
    );
    fputcsv($open, $data);
    echo "success";
    header("location:index.php");
}
}
 ?>
