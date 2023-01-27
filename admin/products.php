<?php
session_start();

//if action is null, render the form to create a new package
$action = (isset($_GET) && isset($_GET['action'])) ? htmlspecialchars($_GET['action']) : null;

require('../core/pdo.php');

$db = new DatabaseClass();

$msg = $success = $packages = '';
if (isset($_SESSION['success']) && isset($_SESSION['msg'])) {
     // || checks for boolean values only
     $success = $_SESSION['success'] || false;
     $msg = $_SESSION['msg'];
     //remove the session
     unset($_SESSION['success']);
     unset($_SESSION['msg']);
}

//render the form 
if ($action == "view") {
     $products = $db->SelectAll("SELECT * FROM product", []);
     if ($_SERVER['REQUEST_METHOD'] == "POST") {
          try {
               if (isset($_POST['action']) && !empty($_POST['action'])) {
                    //update a package
                    if ($_POST['action'] == 'upd-package') {
                         $db->Update("UPDATE package SET package_name = :name, min_deposit = :min_d, max_deposit = :max_d, min_return = :min_r, max_return = :max_r, bonus = :bonus, duration = :dur WHERE id = :id", [
                              'id' => $_POST['id'],
                              'name' => $_POST['package_name'],
                              'min_d' => $_POST['min_deposit'],
                              'max_d' => $_POST['max_deposit'],
                              'min_r' => $_POST['min_return'],
                              'max_r' => $_POST['max_return'],
                              'bonus' => $_POST['bonus'],
                              'dur' => $_POST['duration'],
                         ]);
                         $_SESSION['success'] = true;
                         $_SESSION['msg'] = "Package has been updated";
                         //reset post array
                         header("Location: ./products.php?action=view");
                         exit();
                    } else if ($_POST['action'] == 'del-package') {
                         $db->Remove("DELETE FROM product WHERE id = :id", ['id' => $_POST['id']]);
                         $_SESSION['success'] = true;
                         $_SESSION['msg'] = "Package has been deleted";
                         //reset post array
                         header("Location:products.php?action=view");
                         exit();
                    }
               }
          } catch (Exception $e) {
               error_log($e);
               $_SESSION['success'] = false;
               $_SESSION['msg'] = "A server error has occurred";
               //reset post array
               header("Location:products.php?action=view");
               exit();
          }
     }
} else {
     if ($_SERVER['REQUEST_METHOD'] == "POST") {
          try {
               $target_dir = "uploads/";
               $target = $target_dir . basename($_FILES["pro_image"]["name"]);
               $target_file = $_FILES["pro_image"]["name"];
               // if (!move_uploaded_file($_FILES["proof_of_payment"]["tmp_name"], $target)) {
               //      $_SESSION['msg'] = "File upload failed";
               //      $_SESSION['success'] = false;
               //      header("Location:./products.php");
               //      exit();
               // } else {
               $db->Insert("INSERT INTO product (name, description, amount, pro_image) VALUES (:name, :description, :amount, :pro_image)", [
                    'name' => $_POST['product_name'],
                    'description' => $_POST['pro_description'],
                    'amount' => $_POST['pro_amount'],
                    'pro_image' => $target,
               ]);

               $_SESSION['success'] = true;
               $_SESSION['msg'] = "Package has been created";
               //reset post array
               header("Location:products.php");
               exit();
               // }
          } catch (Exception $e) {
               error_log($e);
               $_SESSION['success'] = false;
               $_SESSION['msg'] = "A server error has occured";
               //reset post array
               header("Location:products.php");
               exit();
          }
     }
}

require "header.php";
?>

<div class="content-inner w-100">
     <!-- Page Header-->
     <header class="bg-white shadow-sm px-4 py-3 z-index-20">
          <div class="container-fluid px-0">
               <h2 class="mb-0 p-1">Products</h2>
          </div>
     </header>
     <!-- Breadcrumb-->
     <div class="bg-white">
          <div class="container-fluid">
               <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 py-3">
                         <li class="breadcrumb-item"><a class="fw-light" href="index.html">Home</a></li>
                         <li class="breadcrumb-item active fw-light" aria-current="page">Products</li>
                    </ol>
               </nav>
          </div>
     </div>
     <section class="container-fluid p-3">
          <div class="row mb-3">
               <div class="col-10">&nbsp;</div>
               <div class="col-2 text-end">
                    <?php if ($action === "view") : ?>
                         <a href="./products.php" class="btn btn-info mb-2 mb-md-0">
                              Add new package </a>
                    <?php else : ?>
                         <a href="./products.php?action=view" class="btn btn-info mb-2 mb-md-0">
                              View packages </a>
                    <?php endif; ?>
               </div>
          </div>
          <?php if ($action === "view") : ?>
               <div class="table-responsive">
                    <table class="table mb-0 table-striped table-hover">
                         <thead>
                              <tr>
                                   <th>#</th>
                                   <th>Products Name</th>
                                   <th>Products Description</th>
                                   <th>Products Amount</th>
                                   <th>Product Image</th>
                                   <th colspan="2" class="text-center">Action</th>
                              </tr>
                         </thead>
                         <tbody>
                              <?php
                              if ($products && count($products)) {
                                   foreach ($products as $i => $product) {
                              ?>
                                        <tr>
                                             <th scope="row">
                                                  <?php echo ++$i; ?>
                                             </th>
                                             <td>
                                                  <?php print(stripslashes($product['name'])); ?>
                                             </td>
                                             <td>
                                                  <?php print(stripslashes($product['description'])); ?>
                                             </td>
                                             <td>
                                                  <?php print(stripslashes($product['amount'])); ?>
                                             </td>
                                             <td>
                                                  <?php print(stripslashes($product['pro_image'])); ?>
                                             </td>
                                             <td class="text-center">
                                                  <button data-package-id="<?php echo $product['id']; ?>" class="btn btn-success btn-upd-package  mb-2 mb-md-0">Update</button>
                                                  <form method="post" onsubmit="return confirm('Are you sure that you want to delete this package?')" class="d-inline">
                                                       <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                                       <input type="hidden" name="action" value="del-package" />
                                                       <button class="btn btn-danger"> Delete</button>
                                                  </form>
                                             </td>
                                        </tr>
                                   <?php }
                              } else { ?>
                                   <td colspan="10" class="text-center">
                                        No packages found
                                   </td>
                              <?php } ?>
                         </tbody>
                    </table>
               </div>
          <?php else : ?>
               <div style="max-width: 500px; margin:auto;">
                    <form method="post" id="form_new_package" action="" enctype="multipart/form-data" novalidate>
                         <div class="mb-3">
                              <label class="form-label">Product name</label>
                              <input class="form-control" type="text" name="product_name" id="inp_package_name" octavalidate="R,TEXT">
                         </div>
                         <div class="mb-3">
                              <label class="form-label">Product Description</label>
                              <textarea name="pro_description" class="form-control" cols="30" id="inp_pro_des" rows="10" octavalidate="R,TEXT"></textarea>
                         </div>
                         <div class="mb-3">
                              <label class="form-label">Product Amount</label>
                              <input class="form-control" type="number" name="pro_amount" id="inp_max_deposit" octavalidate="R,DIGITS">
                         </div>
                         <div class="mb-3">
                              <label class="form-label">Product Image</label>
                              <input class="form-control" type="file" name="pro_image" id="inp_min_return" octavalidate="R" accept-mime="image/jpeg, image/png, image/jpg" maxsize="5mb">
                         </div>
                         <div class=" mb-2">
                              <button class="btn btn-success">Save Package</button>
                         </div>
                    </form>
               </div>
          <?php endif; ?>
     </section>
     <!-- modal update balance -->
     <div class="modal" id="modal_upd_package" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content">
                    <div class="modal-header">
                         <h5 class="modal-title">Update Balance</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                         <form method="post" id="form_upd_bal">
                              <input type="hidden" name="action" value="upd-package">
                              <input type="hidden" name="id" id="inp_package_id">
                              <div class="mb-3">
                                   <label class="form-label">Package name</label>
                                   <input class="form-control" type="text" name="package_name" id="inp_package_name" octavalidate="R,TEXT">
                              </div>
                              <div class="mb-3">
                                   <label class="form-label">Minimum Deposit</label>
                                   <input class="form-control" type="number" name="min_deposit" id="inp_min_deposit" octavalidate="R,DIGITS">
                              </div>
                              <div class="mb-3">
                                   <label class="form-label">Maximum Deposit</label>
                                   <input class="form-control" type="number" name="max_deposit" id="inp_max_deposit" octavalidate="R,DIGITS">
                              </div>
                              <div class="mb-3">
                                   <label class="form-label">Minimum return</label>
                                   <input class="form-control" type="number" name="min_return" id="inp_min_return" octavalidate="R,DIGITS">
                              </div>
                              <div class="mb-3">
                                   <label class="form-label">Maximum return</label>
                                   <input class="form-control" type="number" name="max_return" id="inp_max_return" octavalidate="R,DIGITS">
                              </div>
                              <div class="mb-3">
                                   <label class="form-label">Gift Bonus</label>
                                   <input class="form-control" type="number" name="bonus" id="inp_bonus" octavalidate="R,DIGITS" value="0">
                              </div>
                              <div class="mb-3">
                                   <label class="form-label">Duration</label>
                                   <input class="form-control" type="text" name="duration" id="inp_duration" octavalidate="R,TEXT">
                              </div>
                         </form>
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                         <button form="form_upd_bal" class="btn btn-success">Update</button>
                    </div>
               </div>
          </div>
     </div>
     <!-- Page Footer-->
     <?php require 'footer.php' ?>
</div>
</div>
</div>
<!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<script>
     document.addEventListener('DOMContentLoaded', function() {
          const myForm = new octaValidate('form_new_package')
          $('#form_new_package').on('submit', (e) => {
               e.preventDefault()
               if (myForm.validate()) {
                    e.currentTarget.submit()
               }
          });

          [...$('.btn-upd-package')].forEach(el => {
               $(el).on('click', function() {
                    if (this.getAttribute('data-package-id')) {
                         $('#inp_package_id').val(this.getAttribute('data-package-id'))
                         //show the modal
                         new bootstrap.Modal('#modal_upd_package').show()
                    }
               })
          })
     })
</script>
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
</body>

</html>