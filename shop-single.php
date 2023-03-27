			<?php
               require('auth.php');
               $msg = $success = '';
               if (isset($_SESSION['success']) && isset($_SESSION['msg'])) {
                    // || checks for boolean values only
                    $success = $_SESSION['success'] || false;
                    $msg = $_SESSION['msg'];
                    //remove the session
                    unset($_SESSION['success']);
                    unset($_SESSION['msg']);
               }


               $productId = (isset($_GET) && isset($_GET['productId'])) ? htmlspecialchars($_GET['productId']) : null;
               $single_products = $db->SelectAll("SELECT * FROM product WHERE id = :id", ['id' => $productId]);
               foreach ($single_products as $product) {
                    $productName = $product['name'];
                    $imageUrl = 'admin/uploads/' . $product['pro_image'];
                    $des = $product['description'];
                    $amount = $product['amount'];
               };

               function substrwords($text, $maxchar, $end = '...')
               {
                    if (strlen($text) > $maxchar || $text == '') {
                         $words = preg_split('/\s/', $text);
                         $output = '';
                         $i      = 0;
                         while (1) {
                              $length = strlen($output) + strlen($words[$i]);
                              if ($length > $maxchar) {
                                   break;
                              } else {
                                   $output .= " " . $words[$i];
                                   ++$i;
                              }
                         }
                         $output .= $end;
                    } else {
                         $output = $text;
                    }
                    return $output;
               }
               ?>

			<div class="bg-light py-3">
			     <div class="container">
			          <div class="row">
			               <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <a href="shop.html">Store</a> <span class="mx-2 mb-0">/</span> <strong class="text-black"><?= $productName ?></strong></div>
			          </div>
			     </div>
			</div>

			<div class="site-section">
			     <div class="container">
			          <div class="row">
			               <div class="col-md-5 mr-auto">
			                    <div class="border text-center">
			                         <img src="<?= $imageUrl ?>" alt="Image" width="90%" class="img-fluid p-5">
			                    </div>
			               </div>
			               <div class="col-md-6">
			                    <h2 class="text-black"><?= $productName ?></h2>
			                    <p><?php echo substrwords($des, 20);
                                        ?><br>
			                         <!-- Button trigger modal -->
			                         <a class="ml-auto" data-toggle="modal" data-target="#exampleModal" style="cursor: pointer; font-size:small">
			                              View More
			                         </a>
			                    </p>


			                    <p><strong class="text-primary h4">$ <?= $amount ?></strong></p>
			                    <!-- <p> <del>$95.00</del> <strong class="text-primary h4">$55.00</strong></p> -->

			                    <form action="add-to-cart.php?action=add&id=<?= $productId ?>" method="post">
			                         <div class="mb-5">
			                              <div class="input-group mb-3" style="max-width: 220px;">
			                                   <div class="input-group-prepend">
			                                        <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
			                                   </div>
			                                   <input type="text" class="form-control text-center" name="quantity" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
			                                   <div class="input-group-append">
			                                        <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
			                                   </div>
			                                   <!-- list of hidden product to add to cart -->
			                                   <input type="hidden" name="hidden_product_name" value="<?= $productName ?>">
			                                   <input type="hidden" name="hidden_product_price" value="<?= $amount ?>">
			                                   <input type="hidden" name="hidden_product_image" value="<?= $imageUrl ?>">
			                              </div>

			                         </div>
			                         <button type="submit" class="buy-now btn btn-sm height-auto px-4 py-3 btn-primary" name="add_to_cart">Add To Cart</button>
			                    </form>

			                    <!-- <div class="mt-5">
			                         <ul class="nav nav-pills mb-3 custom-pill" id="pills-tab" role="tablist">
			                              <li class="nav-item">
			                                   <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Ordering Information</a>
			                              </li>
			                              <li class="nav-item">class="buy-now btn btn-sm height-auto px-4 py-3 btn-primary"
			                                   <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Specifications</a>
			                              </li>

			                         </ul>
			                         <div class="tab-content" id="pills-tabContent">
			                              <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
			                                   <table class="table custom-table">
			                                        <thead>
			                                             <th>Material</th>
			                                             <th>Description</th>
			                                             <th>Packaging</th>
			                                        </thead>
			                                        <tbody>
			                                             <tr>
			                                                  <th scope="row">OTC022401</th>
			                                                  <td><?= $des ?></td>
			                                                  <td>1 BT</td>
			                                             </tr>
			                                        </tbody>
			                                   </table>
			                              </div>
			                              <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

			                                   <table class="table custom-table">

			                                        <tbody>
			                                             <tr>
			                                                  <td>HPIS CODE</td>
			                                                  <td class="bg-light">999_200_40_0</td>
			                                             </tr>
			                                             <tr>
			                                                  <td>HEALTHCARE PROVIDERS ONLY</td>
			                                                  <td class="bg-light">No</td>
			                                             </tr>
			                                             <tr>
			                                                  <td>LATEX FREE</td>
			                                                  <td class="bg-light">Yes, No</td>
			                                             </tr>
			                                             <tr>
			                                                  <td>MEDICATION ROUTE</td>
			                                                  <td class="bg-light">Topical</td>
			                                             </tr>
			                                        </tbody>
			                                   </table>

			                              </div>

			                         </div>
			                    </div> -->


			               </div>
			          </div>
			     </div>
			</div>

			<div class="site-section bg-secondary bg-image" style="background-image: url('images/bg_2.jpg');">
			     <div class="container">
			          <div class="row align-items-stretch">
			               <div class="col-lg-6 mb-5 mb-lg-0">
			                    <a href="#" class="banner-1 h-100 d-flex" style="background-image: url('images/bg_1.jpg');">
			                         <div class="banner-1-inner align-self-center">
			                              <h2>Pharma Products</h2>
			                              <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae ex ad minus rem odio voluptatem.
			                              </p>
			                         </div>
			                    </a>
			               </div>
			               <div class="col-lg-6 mb-5 mb-lg-0">
			                    <a href="#" class="banner-1 h-100 d-flex" style="background-image: url('images/bg_2.jpg');">
			                         <div class="banner-1-inner ml-auto  align-self-center">
			                              <h2>Rated by Experts</h2>
			                              <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae ex ad minus rem odio voluptatem.
			                              </p>
			                         </div>
			                    </a>
			               </div>
			          </div>
			     </div>
			</div>


			<!-- Modal -->
			<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			     <div class="modal-dialog modal-dialog-centered">
			          <div class="modal-content">
			               <div class="modal-header">
			                    <h5 class="modal-title" id="exampleModalLabel"><?= $productName  ?></h5>
			                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                         <span aria-hidden="true">&times;</span>
			                    </button>
			               </div>
			               <div class="modal-body">
			                    <?= $des ?>
			               </div>
			               <div class="modal-footer">
			                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			               </div>
			          </div>
			     </div>
			</div>


			<?php
               include("footer.php");
               ?>

			<script>
			     <?php
                    if (isset($success) && isset($msg)) {
                         if ($success && !empty($msg)) {
                    ?>
			               toastr.success("<?php echo $msg; ?>")
			          <?php
                         } elseif (!$success && !empty($msg)) { ?>
			               toastr.error("<?php echo $msg; ?>")
			     <?php
                         }
                    }
                    ?>
			</script>