			<?php
               require('auth.php');
               $products = $db->SelectAll("SELECT * FROM product ", []);
               ?>

			<div class="bg-light py-3">
			     <div class="container">
			          <div class="row">
			               <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Store</strong></div>
			          </div>
			     </div>
			</div>

			<div class="site-section">
			     <div class="container">

			          <div class="row mb-5">
			               <!-- <div class="col-lg-6">
			                    <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter by Price</h3>
			                    <div id="slider-range" class="border-primary"></div>
			                    <input type="text" name="text" id="amount" class="form-control border-0 pl-0 bg-white" disabled="" />
			               </div> -->
			               <div class="col-lg-6">
			                    <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter by Reference</h3>
			                    <button type="button" class="btn btn-secondary btn-md dropdown-toggle px-4" id="dropdownMenuReference" data-toggle="dropdown">Reference</button>
			                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
			                         <a class="dropdown-item" href="#">Relevance</a>
			                         <a class="dropdown-item" href="#">Name, A to Z</a>
			                         <a class="dropdown-item" href="#">Name, Z to A</a>
			                         <div class="dropdown-divider"></div>
			                         <a class="dropdown-item" href="#">Price, low to high</a>
			                         <a class="dropdown-item" href="#">Price, high to low</a>
			                    </div>
			               </div>
			          </div>

			          <div class="row">
			               <?php
                              if ($products && count($products)) {
                                   foreach ($products as $i => $product) {
                                        $imageUrl = 'admin/uploads/' . $product['pro_image'];
                              ?>
			                         <div class="col-sm-6 col-lg-4 text-center item mb-4">
			                              <span class="tag">Sale</span>
			                              <a href="shop-single.php?productId=<?= $product['id'] ?>"> <img src="<?= $imageUrl ?>" alt="Image" width="100px"></a>
			                              <h3 class="text-dark"><a href="shop-single.php?productId=<?= $product['id'] ?>"><?= $product['name'] ?></a></h3>
			                              <p class="price">&#8358 <?= $product['amount'] ?> </p>
			                              <!-- <p class="price"><del>95.00</del> &mdash; $55.00</p> -->
			                         </div>
			               <?php }
                              } ?>
			          </div>
			          <div class="row mt-5">
			               <div class="col-md-12 text-center">
			                    <div class="site-block-27">
			                         <ul>
			                              <li><a href="#">&lt;</a></li>
			                              <li class="active"><span>1</span></li>
			                              <li><a href="#">2</a></li>
			                              <li><a href="#">3</a></li>
			                              <li><a href="#">4</a></li>
			                              <li><a href="#">5</a></li>
			                              <li><a href="#">&gt;</a></li>
			                         </ul>
			                    </div>
			               </div>
			          </div>
			     </div>
			</div>


			<div class="site-section bg-secondary bg-image" style="background-image: url('images/bg_2.jpg')">
			     <div class="container">
			          <div class="row align-items-stretch">
			               <div class="col-lg-6 mb-5 mb-lg-0">
			                    <a href="#" class="banner-1 h-100 d-flex" style="background-color:white;">
			                         <div class="text-center">
			                              <h2 class="text-dark"> NID Africa Products</h2>
			                              <p class="text-secondary">
			                                   NID manufactures authentic ayurvedic and herbal medicines, including beauty Products, nutritional drinks, toiletries, and other topical health products like hand sanitizers.
			                              </p>
			                         </div>
			                    </a>
			               </div>
			               <div class="col-lg-6 mb-5 mb-lg-0">
			                    <a href="#" class="banner-1 h-100 d-flex" style="background-color:white;">
			                         <div class="text-center">
			                              <h2 class="text-dark">Exclusive Distributor</h2>
			                              <p class="text-secondary">
			                                   Naturetwig Impex (Nig.) Ltd is the Exclusive Distributor of North India Pharma Pvt. Ltd In Nigeria and West Africa in extension.
			                              </p>
			                         </div>
			                    </a>
			               </div>
			          </div>
			     </div>
			</div>

			<?php
               include('footer.php');
               ?>