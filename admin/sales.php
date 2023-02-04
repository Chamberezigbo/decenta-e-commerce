<?php
include 'header.php';
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
$orders = $db->SelectAll("SELECT * FROM orders", []);
?>

<!-- Begin Page Content -->
<div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-2 text-gray-800">List of Sales</h1>
     <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
          For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

     <!-- DataTales Example -->
     <div class="card shadow mb-4">
          <div class="card-header py-3">
               <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
          </div>
          <div class="card-body">
               <div class="table-responsive">
                    <table class="display table table-bordered" id="table_id" width="100%" cellspacing="0">
                         <thead>
                              <tr>
                                   <th>Email</th>
                                   <th>Total Amount</th>
                                   <th>Date</th>
                                   <th>view products</th>
                              </tr>
                         </thead>
                         <tfoot>
                              <tr>
                                   <th>Email</th>
                                   <th>Total Amount</th>
                                   <th>Date</th>
                                   <th>view products</th>
                              </tr>
                         </tfoot>
                         <tbody>
                              <?php
                              if ($orders && count($orders)) {
                                   foreach ($orders as $i => $order) {
                              ?>
                                        <tr>
                                             <?php print(stripslashes($product['email'])); ?>
                                             <?php print(stripslashes($product['amount'])); ?>
                                             <td><?php print(stripslashes($product['date'])); ?></td>
                                             <td><?php print(stripslashes($product['name'])); ?></td>
                                             <td><button data-package-id="<?php echo $product['id']; ?>" class="btn btn-success btn-upd-package  mb-2 mb-md-0">View Products</button></td>
                                        </tr>
                              <?php }
                              } ?>
                         </tbody>
                    </table>
               </div>
          </div>
     </div>

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
                    <div class="modal-body">
                         <h1>List of products in orders</h1>
                    </div>
               </div>
          </div>
     </div>
     <!-- Page Footer-->

</div>
<!-- /.container-fluid -->

</div>
<script>
     [...$('.btn-upd-package')].forEach(el => {
          $(el).on('click', function() {
               if (this.getAttribute('data-package-id')) {
                    $('#inp_package_id').val(this.getAttribute('data-package-id'))
                    //show the modal
                    $('#modal_upd_package').modal('show')
               }
          })
     })
</script>
<?php
include "footer.php";
