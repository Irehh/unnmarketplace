<?php
if(!isset($_SESSION["authenticated"]))
{
    $_SESSION["message"] = "Please login to access user dashboard";
    header("location:../forms/login.php");
    exit(0);
}

?>

<!-- Sidebar-->
<aside class="col-lg-3 pe-xl-5">
              <!-- Account menu toggler (hidden on screens larger 992px)-->
              <div class="d-block d-lg-none p-4"><a class="btn btn-outline-accent d-block" href="#account-menu" data-bs-toggle="collapse"><i class="ci-menu me-2"></i>Account menu</a></div>
              <!-- Actual menu-->
              <div class="h-100 border-end mb-2">
                <div class="d-lg-block collapse" id="account-menu">
                  <ul class="list-unstyled mb-0">
                    <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="./additem.php"><i class="ci-upload opacity-60 me-2"></i>Add Product</a></li>
                    <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="./dashboard.php"><i class="ci-list opacity-60 me-2"></i>Listed Product</a></li>
                    <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="./update_profile_details.php"><i class="ci-settings opacity-60 me-2"></i>Update Details</a></li>
                    <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="./logout.php"><i class="ci-sign-out opacity-60 me-2"></i>Sign out</a></li>
                  </ul>
                </div>
              </div>
            </aside>