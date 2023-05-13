 <!-- Footer-->
 <footer class="footer bg-darker">
        <div class="container" style="padding-top: 0.2rem !important;
    padding-bottom: 0rem !important;">
          <div class="row py-lg-4 text-center">
          <a class="" href="#"><img src="img/unnmarketplace.png" width="187" alt="UNNmarketplace"></a><span class="d-inline-block align-middle h5 fw-light text-white mb-0">Online Marketplace For UNN Community</span>
            <p class="fs-sm text-white opacity-70 pb-1">Buy/sell items from the community.</p>
            <div><a class="btn-social bs-light bs-facebook me-2 mb-2" href="https://facebook.com/groups/745670956863374/"><i class="ci-facebook"></i></a><a class="btn-social bs-light bs-whatsapp me-2 mb-2" href="https://chat.whatsapp.com/KsmlTJJrLd2Exr7oWn5j6x"><i class="ci-whatsapp"></i></a><a class="btn-social bs-light bs-instagram me-2 mb-2" href="https://instagram.com/unnmarketplace?igshid=ZDdkNTZiNTM="><i class="ci-instagram"></i></a><a class="btn-social bs-light bs-telegram me-2 mb-2" href="https://t.me/unnmarketplace"><i class="ci-telegram"></i></a></div>
            <div class="fs-xs text-light opacity-50">&copy;2023 <a class="text-light" href="" target="_blank" rel="noopener"> UNNMarketplace</a> </div>
          </div>
          
        </div>
    </footer>
    <!-- Toolbar for handheld devices-->
    <div class="handheld-toolbar">
      <div class="d-table table-layout-fixed w-100"><a class="d-none handheld-toolbar-item" href="#vendor-sidebar" data-bs-toggle="offcanvas"><span class="handheld-toolbar-icon"><i class="ci-sign-in"></i></span><span class="handheld-toolbar-label">Sidebar</span></a>
      
      <?php if(isset($_SESSION["authenticated"]) && (!isset($_SESSION["admin"])))
              :?>
               <a class="d-table-cell handheld-toolbar-item" href="./user/dashboard.php" data-bs-toggle="modal"><span class="handheld-toolbar-icon"><i class="ci-user"></i></span><span class="handheld-toolbar-label">Dashboard</span></a>
              <?php endif ?>
              <?php if(!isset($_SESSION["authenticated"]) && (isset($_SESSION["admin"])))
              :?>
               <a class="d-table-cell handheld-toolbar-item" href="./admin/admin.php" data-bs-toggle="modal"><span class="handheld-toolbar-icon"><i class="ci-user"></i></span><span class="handheld-toolbar-label">Dashboard</span></a>
              <?php endif ?>
              <?php if((!isset($_SESSION["authenticated"])) && (!isset($_SESSION["admin"])))
              :?>
               <a class="d-table-cell handheld-toolbar-item" href="./forms/register.php" data-bs-toggle="modal"><span class="handheld-toolbar-icon"><i class="ci-add-user"></i></span><span class="handheld-toolbar-label">Sign Up</span></a>
              <?php endif ?>
      
      <a class="d-table-cell handheld-toolbar-item" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" onclick="window.scrollTo(0, 0)"><span class="handheld-toolbar-icon"><i class="ci-menu"></i></span><span class="handheld-toolbar-label">Menu</span></a>
      </div>
    </div>
    
      <?php mysqli_close($conn); ?>