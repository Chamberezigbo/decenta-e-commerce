<?php
session_start();

//if action is null, render the form to create a new package
$action = (isset($_GET) && isset($_GET['action'])) ? htmlspecialchars($_GET['action']) : null;
$singleId = (isset($_GET) && isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : null;


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
     if ($action == "view" && $singleId != null) {
          $singleProduct = $db->SelectAll("SELECT * FROM product WHERE id = :id ", [
               'id' => $singleId
          ]);
          if ($singleProduct) {
               foreach ($singleProduct as $i => $product) {
                    $_SESSION['proName'] = $product['name'];
                    $_SESSION['proAmount'] = $product['amount'];
                    $_SESSION['proDecs'] = $product['description'];
               }

               echo "<script>
                         document.addEventListener('DOMContentLoaded', function() {
                              //                //show the modal
                              $('#modal_upd_package').modal('show')
                    
                         })
               </script>";
          }
     }
     if ($_SERVER['REQUEST_METHOD'] == "POST") {
          try {
               if (isset($_POST['action']) && !empty($_POST['action'])) {
                    //update a package
                    if ($_POST['action'] == 'upd-package') {
                         $db->Update("UPDATE product SET name = :name, amount = :amount, description = :des WHERE id = :id", [
                              'name' => $_POST['product_name'],
                              'des' => $_POST['pro_description'],
                              'amount' => $_POST['pro_amount'],
                              'id' => $singleId,
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
               $temp = explode('.', $target);
               $doc = round(microtime(true)) . '.' . end($temp);
               if (!move_uploaded_file($_FILES["pro_image"]["tmp_name"], $target_dir . $doc)) {
                    $_SESSION['msg'] = "File upload failed";
                    $_SESSION['success'] = false;
                    header("Location:./products.php");
                    exit();
               } else {
                    $db->Insert("INSERT INTO product (name, description, amount, pro_image) VALUES (:name, :description, :amount, :pro_image)", [
                         'name' => $_POST['product_name'],
                         'description' => $_POST['pro_description'],
                         'amount' => $_POST['pro_amount'],
                         'pro_image' => $doc,
                    ]);


                    $_SESSION['success'] = true;
                    $_SESSION['msg'] = "Package has been created";
                    //reset post array
                    header("Location:products.php");
                    exit();
               }
          } catch (Exception $e) {
               error_log($e);
               $_SESSION['success'] = false;
               $_SESSION['msg'] = "A server error has occurred";
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
                              Add new Product </a>
                    <?php else : ?>
                         <a href="./products.php?action=view" class="btn btn-info mb-2 mb-md-0">
                              View Product </a>
                    <?php endif; ?>
               </div>
          </div>
          <?php if ($action === "view") : ?>
               <div class="table-responsive">
                    <table class="table mb-0 table-striped table-hover" id="table_id_1" class="display">
                         <thead>
                              <tr>
                                   <th>#</th>
                                   <th>Products Name</th>
                                   <th>Products Description</th>
                                   <th>Products Amount</th>
                                   <th>Product Image</th>
                                   <th class="text-center">Action</th>
                              </tr>
                         </thead>
                         <tbody>
                              <?php
                              if ($products && count($products)) {
                                   foreach ($products as $i => $product) {
                              ?>
                                        <tr>
                                             <td scope="row">
                                                  <?php echo ++$i; ?>
                                             </td>
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
                                                  <img src="<?= 'uploads/' . $product['pro_image'] ?>" class="rounded" alt="..." width="30px">
                                             </td>
                                             <td class="text-center">
                                                  <button data-package-id="<?php echo $product['id']; ?>" class="btn btn-info btn-upd-package  mb-2 mb-md-0"><a class="text-white" href="./products.php?action=view&id=<?= $product['id'] ?>">Update</a></button>
                                                  <form method="post" onsubmit="return confirm('Are you sure that you want to delete this package?')" class="d-inline">
                                                       <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                                       <input type="hidden" name="action" value="del-package" />
                                                       <button class="btn btn-danger mt-3"> Delete</button>
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
                              <input class="form-control" type="file" name="pro_image" id="inp_min_return" octavalidate="R" accept-mime="image/jpeg, image/png, image/jpg" maxsize="10mb">
                         </div>
                         <div class=" mb-2">
                              <button class="btn btn-success">Add Product</button>
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
                         <h5 class="modal-title">Update Product </h5>
                         <p class="model-title text-danger">You are meant to Update all filed</p>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                         </button>
                    </div>
                    <form method="post" id="form_upd_bal">
                         <div class="modal-body">
                              <input type="hidden" name="action" value="upd-package">
                              <input type="hidden" name="id" id="inp_package_id">
                              <div class="mb-3">
                                   <label class="form-label">Product name</label>
                                   <input class="form-control" type="text" value="<?= $_SESSION['proName'] ?>" name="product_name" id="inp_package_name" octavalidate="R,TEXT">
                              </div>
                              <div class="mb-3">
                                   <label class="form-label">Product Description</label>
                                   <textarea name="pro_description" class="form-control" cols="30" id="inp_pro_des" rows="10" octavalidate="R,TEXT">
                                        <?= $_SESSION['proDecs'] ?>
                                   </textarea>
                              </div>
                              <div class="mb-3">
                                   <label class="form-label">Product Amount</label>
                                   <input class="form-control" type="number" name="pro_amount" value="<?= $_SESSION['proAmount'] ?>" id="inp_max_deposit" octavalidate="R,DIGITS">
                              </div>
                         </div>
                         <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Save changes</button>
                         </div>
                    </form>
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

          // [...$('.btn-upd-package')].forEach(el => {
          //      $(el).on('click', function() {
          //           if (this.getAttribute('data-package-id')) {
          //                $('#inp_package_id').val(this.getAttribute('data-package-id'))
          //                //show the modal
          //                $('#modal_upd_package').modal('show')
          //           }
          //      })
          // })
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