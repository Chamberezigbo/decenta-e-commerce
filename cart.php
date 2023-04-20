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

               // total balance of transactions //
               $total = 0;
               ?>
			<div class="bg-light py-3">
			     <div class="container">
			          <div class="row">
			               <div class="col-md-12 mb-0">
			                    <a href="index.html">Home</a> <span class="mx-2 mb-0">/</span>
			                    <strong class="text-black">Cart</strong>
			               </div>
			          </div>
			     </div>
			</div>

			<div class="site-section">
			     <div class="container">
			          <div class="row mb-5">
			               <form class="col-md-12" method="post">
			                    <div class="site-blocks-table">
			                         <table class="table table-bordered">
			                              <thead>
			                                   <tr>
			                                        <th class="product-thumbnail">Image</th>
			                                        <th class="product-name">Product</th>
			                                        <th class="product-price">Price</th>
			                                        <th class="product-quantity">Quantity</th>
			                                        <th class="product-total">Total</th>
			                                        <th class="product-remove">Remove</th>
			                                   </tr>
			                              </thead>
			                              <tbody>
			                                   <?php
                                                  if (!empty($_SESSION['shopping_cart'])) {
                                                       # code...
                                                       foreach ($_SESSION['shopping_cart'] as $keys => $value) {
                                                  ?>
			                                             <tr>
			                                                  <td class="product-thumbnail">
			                                                       <img src="<?= $value['item_image'] ?>" alt="Image" class="img-fluid">
			                                                  </td>
			                                                  <td class="product-name">
			                                                       <h2 class="h5 text-black"><?= $value['item_name'] ?></h2>
			                                                  </td>
			                                                  <td><?php echo number_format($value['item_price'], 2) ?></td>
			                                                  <td>
			                                                       <?= $value['item_quantity'] ?>
			                                                  </td>
			                                                  <td><?php echo number_format($value['item_quantity'] * $value["item_price"], 2); ?></td>
			                                                  <td>
			                                                       <a onclick="confirm('Are you sure you want to remove this from cart')" href="add-to-cart.php?action=delete&id=<?= $value['item_id'] ?>" class="btn btn-primary height-auto btn-sm">X</a>
			                                                  </td>
			                                             </tr>
			                                        <?php
                                                            $total = $total + ($value['item_quantity'] * $value['item_price']);
                                                       }
                                                  } else { ?>
			                                        <tr>
			                                             <td colspan="6" class="text-center text-danger">Cart is empty</td>
			                                        </tr>
			                                   <?php
                                                  }
                                                  ?>
			                              </tbody>
			                         </table>
			                    </div>
			               </form>
			          </div>

			          <div class="row">
			               <div class="col-md-6">
			                    <div class="row mb-5">
			                         <!-- <div class="col-md-6 mb-3 mb-md-0">
			                              <button class="btn btn-primary btn-md btn-block" onclick="confirm('Are you sure tou want to clear your cart')"><a class="text-dark" href="">Empty Cart</a></button>
			                         </div> -->
			                         <div class="col-md-6">
			                              <button class="btn btn-outline-primary btn-md btn-block"><a class="text-dark" href="shop.php">Continue Shopping</a></button>
			                         </div>
			                    </div>
			                    <div class="row">
			                         <div class="col-md-12">
			                              <label class="text-black h4" for="coupon">Coupon</label>
			                              <p>Enter your coupon code if you have one.</p>
			                         </div>
			                         <div class="col-md-8 mb-3 mb-md-0">
			                              <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
			                         </div>
			                         <div class="col-md-4">
			                              <button class="btn btn-primary btn-md px-4">Apply Coupon</button>
			                         </div>
			                    </div>
			               </div>
			               <div class="col-md-6 pl-5">
			                    <div class="row justify-content-end">
			                         <div class="col-md-7">
			                              <div class="row">
			                                   <div class="col-md-12 text-right border-bottom mb-5">
			                                        <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
			                                   </div>
			                              </div>
			                              <div class="row mb-3">
			                                   <div class="col-md-6">
			                                        <span class="text-black">Subtotal</span>
			                                   </div>
			                                   <div class="col-md-6 text-right">
			                                        <strong class="text-black"><?php echo number_format($total, 2); ?></strong>
			                                   </div>
			                              </div>
			                              <div class="row mb-5">
			                                   <div class="col-md-6">
			                                        <span class="text-black">Total</span>
			                                   </div>
			                                   <div class="col-md-6 text-right">
			                                        <strong class="text-black"><?php echo number_format($total, 2); ?></strong>
			                                   </div>
			                              </div>

			                              <!-- Add whatsapp link -->
			                              <div class="row">
			                                   <div class="col-md-12">
			                                        <button class="btn btn-primary btn-lg btn-block" onclick="window.location='checkout.php'">Continue</button>
			                                   </div>
			                              </div>
			                         </div>
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
			                         <div class="text-dark align-self-center">
			                              <h2>NID Africa Products</h2>
			                              <p>
			                                   NID manufactures authentic ayurvedic and herbal medicines, including beauty Products, nutritional drinks, toiletries, and other topical health products like hand sanitizers.
			                              </p>
			                         </div>
			                    </a>
			               </div>
			               <div class="col-lg-6 mb-5 mb-lg-0">
			                    <a href="#" class="banner-1 h-100 d-flex" style="background-color:white;">
			                         <div class="text-dark ml-auto align-self-center">
			                              <h2>Exclusive Distributor</h2>
			                              <p>
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