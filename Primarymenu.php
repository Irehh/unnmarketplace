<!-- dont touch the html code -->

<div class="collapse navbar-collapse me-auto order-lg-2" id="navbarCollapse">
            <!-- Search (mobile)-->
            <form action="shop.php" method="get">
            <div class="d-lg-none py-3">
              <div class="input-group"><i class="ci-search position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                <input class="form-control rounded-start" type="text" name="search" value="<?php  if(isset($_GET['search'])){ echo safe($_GET['search']); } ?>" placeholder="Search for specific Item">
              </div>
            </div>
            </form>
            <!-- Primary menu-->
            <ul class="navbar-nav">
              <li class="nav-item"><a class="nav-link" href="./index.php">Home</a></li>
              <li class="nav-item"><a class="nav-link" href="shop.php">Shop</a></li>
              <!--<li class="nav-item"><a class="nav-link" href="vendors.php">Vendors</a></li>-->
              <?php
              if(!isset($_SESSION["authenticated"]) && (!isset($_SESSION["admin"])))
               :?>
                <li class="nav-item" style="text-align: center;"><a class="nav-link" href="./forms/login.php"><span class="navbar-tool-tooltip"><strong>Sign in</strong> </span>
                </a>
              </li>
              <?php endif ?>
            </ul>
          </div>
        </div>
        <!-- Search collapse-->
        <form action="shop.php" method="get">
        <div class="search-box collapse" id="searchBox">
          <div class="container py-2">
            <div class="input-group"><i class="ci-search position-absolute top-50 start-0 translate-middle-y ms-3"></i>
              <input class="form-control rounded-start" type="text" name="search" value="<?php  if(isset($_GET['search'])){ echo safe($_GET['search']); } ?>"  placeholder="Search for specific item">
            </div>
          </div>
        </div>
        </form>