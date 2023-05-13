        <!-- Product carousel (used properties)-->
        <?php
                      $sqls = "SELECT * FROM `product` ORDER BY 'date' DESC LIMIT 25 ";
                      $results = mysqli_query($conn , $sqls);
                      if($rows = mysqli_fetch_array($results)) {
    ?>
      <section class="container mb-2 py-lg-5 py-4">
                      <div class="d-flex align-items-center justify-content-between mb-sm-3 mb-2">
                        <h2 class="h3 mb-0">New</h2><a class="btn btn-outline-accent ms-3" href="shop.php">Explore more<i class="ci-arrow-right ms-2"></i></a>
                      </div>
                      <!-- Product carousel-->
                      <div class="tns-carousel tns-controls-static tns-controls-outside mx-xl-n4 mx-n2 px-xl-4 px-0">
                        <div class="tns-carousel-inner row gx-xl-0 gx-3 mx-0" data-carousel-options="{&quot;items&quot;: 2, &quot;nav&quot;: true, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1,&quot;controls&quot;: false, &quot;gutter&quot;: 0},&quot;500&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3}, &quot;1100&quot;:{&quot;items&quot;:4}, &quot;1278&quot;:{&quot;controls&quot;: true, &quot;nav&quot;: false, &quot;gutter&quot;: 30}}}">
                      <?php 
              while($rows = mysqli_fetch_assoc($results)){
              ?>
            <!-- Product item for used-->
            <div class="col py-3">
              <article class="card h-100 border-0 shadow">
                <div class="card-img-top position-relative overflow-hidden">
                  <a class="d-block" href="productdetails.php?id=<?php echo safe($rows['id']); ?>"><img src="images/<?php echo safe($rows['image']); ?>" alt="Product image"></a>
                   <!-- Category-->
              <div class="badge bg-info m-3 fs-sm position-absolute top-0 start-0 zindex-5"><?php echo safe($rows['category']); ?>
                </div>
                <!-- type-->
                <div class="badge bg-dark m-3 fs-sm position-absolute top-0 end-0"  data-bs-toggle="tooltip" data-bs-placement="left" title="fairly used item" style="margin: 12px;"><?php echo safe($rows['type']); ?></div>
                  
                </div>
                <div class="card-body">
                  <h3 class="product-title mb-2 fs-base"><a class="d-block text-truncate" href="productdetails.php?id=<?php echo safe($rows['id']); ?>"><?php echo safe($rows['name']); ?></a></h3>
                  <div class="d-flex align-items-center flex-wrap">
                    <h4 class="mt-1 mb-0 fs-base text-darker"><span class="fs-sm text-muted">Price:</span><span style="color: red;">&#8358;</span><?php echo safe($rows['amount']); ?></h4>
                  </div>
                </div>
              </article>
            </div>
            <?php }  ?>
          </div>
        </div>
      </section>
<?php } ?>