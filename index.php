			<?php
               require('auth.php');
               $products = $db->SelectAll("SELECT * FROM product LIMIT 3", []);
               ?>
			<div class="site-blocks-cover" style="background-image: linear-gradient(rgba(0,0,0,0.7),rgba(0,0,0,0.7)) ,url('images/black_doc.jpeg')">
			     <div class="container">
			          <div class="row">
			               <div class="col-lg-7 mx-auto order-lg-2 align-self-center ">
			                    <div class="site-block-cover-content text-center">
			                         <h2 class="sub-title">
			                              Natural Medicine Alternative
			                         </h2>
			                         <h1>The Complete Healthcare Solutions of Ayurvedic origin</h1>
			                         <p>
			                              <a href="shop.php" class="btn btn-primary px-5 py-3">See Products</a>
			                         </p>
			                    </div>
			               </div>
			          </div>
			     </div>
			</div>

			<div class="site-section">
			     <div class="container">
			          <div class="row align-items-stretch section-overlap">
			               <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
			                    <div class="banner-wrap bg-dark h-100">
			                         <a href="#">
			                              <h5>
			                                   Vitamins
			                                   Minerals
			                              </h5>
			                              <p>
			                                   We offer natural medicine alternatives,
			                                   including vitamins & minerals.
			                              </p>
			                         </a>
			                    </div>
			               </div>
			               <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
			                    <div class="banner-wrap h-100">
			                         <a href="#" class="h-100">
			                              <h5>
			                                   Beauty
			                                   Products
			                              </h5>
			                              <p>
			                                   We offer authentic ayurvedic and herbal medicines,
			                                   including beauty products.
			                              </p>
			                         </a>
			                    </div>
			               </div>
			               <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
			                    <div class="banner-wrap bg-dark h-100">
			                         <a href="#" class="h-100">
			                              <h5>
			                                   Nutritional
			                                   Drinks
			                              </h5>
			                              <p>
			                                   We offer authentic ayurvedic and herbal medicines,
			                                   including nutritional drinks.
			                              </p>
			                         </a>
			                    </div>
			               </div>
			          </div>
			     </div>
			</div>

			<div class="site-section">
			     <div class="container">
			          <div class="row">
			               <div class="title-section text-center col-12">
			                    <h2 class="text-uppercase">Popular Products</h2>
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
			                              <a href="shop-single.php?productId=<?= $product['id'] ?>">
			                                   <img src="<?= $imageUrl ?>" alt="Image" width="100px" /></a>
			                              <h3 class="text-dark">
			                                   <a href="shop-single.php?productId=<?= $product['id'] ?>"><?= $product['name'] ?></a>
			                              </h3>
			                              <!-- <p class="price"><del>95.00</del> &mdash; $55.00</p> -->
			                              <p class="price">&#8358 <?= $product['amount'] ?></p>
			                         </div>
			               <?php }
                              } ?>
			          </div>
			          <div class="row mt-5">
			               <div class="col-12 text-center">
			                    <a href="shop.php" class="btn btn-primary px-4 py-3">View All Products</a>
			               </div>
			          </div>
			     </div>
			</div>

			<!-- No Content -->

			<!-- <div class="site-section">
			     <div class="container">
			          <div class="row">
			               <div class="title-section text-center col-12">
			                    <h2 class="text-uppercase">Testimonials</h2>
			               </div>
			          </div>
			          <div class="row">
			               <div class="col-md-12 block-3 products-wrap">
			                    <div class="nonloop-block-3 no-direction owl-carousel">
			                         <div class="testimony">
			                              <blockquote>
			                                   <img src="images/person_1.jpg" alt="Image" class="img-fluid w-25 mb-4 rounded-circle" />
			                                   <p>
			                                        &ldquo;Lorem ipsum dolor, sit amet
			                                        consectetur adipisicing elit. Nemo
			                                        omnis voluptatem consectetur quam
			                                        tempore obcaecati maiores voluptate
			                                        aspernatur iusto eveniet, placeat ab
			                                        quod tenetur ducimus. Minus ratione
			                                        sit quaerat unde.&rdquo;
			                                   </p>
			                              </blockquote>

			                              <p>&mdash; Kelly Holmes</p>
			                         </div>

			                         <div class="testimony">
			                              <blockquote>
			                                   <img src="images/person_2.jpg" alt="Image" class="img-fluid w-25 mb-4 rounded-circle" />
			                                   <p>
			                                        &ldquo;Lorem ipsum dolor, sit amet
			                                        consectetur adipisicing elit. Nemo
			                                        omnis voluptatem consectetur quam
			                                        tempore obcaecati maiores voluptate
			                                        aspernatur iusto eveniet, placeat ab
			                                        quod tenetur ducimus. Minus ratione
			                                        sit quaerat unde.&rdquo;
			                                   </p>
			                              </blockquote>

			                              <p>&mdash; Rebecca Morando</p>
			                         </div>

			                         <div class="testimony">
			                              <blockquote>
			                                   <img src="images/person_3.jpg" alt="Image" class="img-fluid w-25 mb-4 rounded-circle" />
			                                   <p>
			                                        &ldquo;Lorem ipsum dolor, sit amet
			                                        consectetur adipisicing elit. Nemo
			                                        omnis voluptatem consectetur quam
			                                        tempore obcaecati maiores voluptate
			                                        aspernatur iusto eveniet, placeat ab
			                                        quod tenetur ducimus. Minus ratione
			                                        sit quaerat unde.&rdquo;
			                                   </p>
			                              </blockquote>

			                              <p>&mdash; Lucas Gallone</p>
			                         </div>

			                         <div class="testimony">
			                              <blockquote>
			                                   <img src="images/person_4.jpg" alt="Image" class="img-fluid w-25 mb-4 rounded-circle" />
			                                   <p>
			                                        &ldquo;Lorem ipsum dolor, sit amet
			                                        consectetur adipisicing elit. Nemo
			                                        omnis voluptatem consectetur quam
			                                        tempore obcaecati maiores voluptate
			                                        aspernatur iusto eveniet, placeat ab
			                                        quod tenetur ducimus. Minus ratione
			                                        sit quaerat unde.&rdquo;
			                                   </p>
			                              </blockquote>

			                              <p>&mdash; Andrew Neel</p>
			                         </div>
			                    </div>
			               </div>
			          </div>
			     </div>
			</div> -->

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
               include("footer.php");
               ?>