<?php
include 'header.php';
require('../core/pdo.php');

$db = new DatabaseClass();

$orderId = (isset($_GET) && isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : null;
$view = (isset($_GET) && isset($_GET['view'])) ? htmlspecialchars($_GET['view']) : null;
$Items = '';

$msg = $success = $packages = '';
if (isset($_SESSION['success']) && isset($_SESSION['msg'])) {
     // || checks for boolean values only
     $success = $_SESSION['success'] || false;
     $msg = $_SESSION['msg'];
     //remove the session
     unset($_SESSION['success']);
     unset($_SESSION['msg']);
}
if ($orderId != null) {
     # code...
     $billing = $db->SelectAll("SELECT * FROM billing WHERE order_id = :id", [
          'id' => $orderId
     ]);
     if ($billing) {
          foreach ($billing as $i => $bill) {
               $_SESSION['billFullName'] = $bill['fullName'];
               $_SESSION['billEmail'] = $bill['email'];
               $_SESSION['billPhone'] = $bill['phone'];
               $_SESSION['billCountry'] = $bill['country'];
               $_SESSION['billCompanyName'] = $bill['company_name'];
               $_SESSION['billSate'] = $bill['state'];
               $_SESSION['billAddress'] = $bill['address'];
          }
          echo "<script>
                         document.addEventListener('DOMContentLoaded', function() {
                              //                //show the modal
                              $('#modal_upd_package').modal('show')
                    
                         })
               </script>";
     }
} elseif ($view != null) {
     echo "<script>
                         document.addEventListener('DOMContentLoaded', function() {
                              //                //show the modal
                              $('#modal_order').modal('show')
                    
                         })
               </script>";
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
                                   <th>Total Amount</th>
                                   <th>Date</th>
                                   <th>view Products</th>
                                   <th>view List</th>
                              </tr>
                         </thead>
                         <tfoot>
                              <tr>
                                   <th>Total Amount</th>
                                   <th>Date</th>
                                   <th>view Products</th>
                                   <th>view List</th>
                              </tr>
                         </tfoot>
                         <tbody>
                              <?php
                              if ($orders && count($orders)) {
                                   foreach ($orders as $i => $order) {
                                        $orderId = $order['order_id'];
                                        $Items = json_decode($order["details"], true);
                              ?>
                                        <tr>
                                             <td><?php print(stripslashes($order['total_balance'])); ?> </td>
                                             <td><?php echo date('m/d/Y', $order['date']); ?></td>
                                             <td><button class="btn btn-success btn-upd-package  mb-2 mb-md-0"><a href="./sales.php?id=<?= $orderId ?>">View Billing Details</a></button></td>
                                             <td><button class="btn btn-success btn-upd-package  mb-2 mb-md-0"><a href="./sales.php?view=List">Order List</a></button></td>
                                        </tr>
                              <?php }
                              } ?>
                         </tbody>
                    </table>
               </div>
          </div>
     </div>

     <!-- Billing modal -->
     <div class="modal" id="modal_upd_package" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content">
                    <div class="modal-header">
                         <h5 class="modal-title">Billing Details </h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                         </button>
                    </div>
                    <div class="modal-body">
                         <ul class="list-group">
                              <li class="list-group-item">
                                   FullName <span class="float-right"><?= $_SESSION['billFullName'] ?></span>
                              </li>
                              <li class="list-group-item">
                                   Email <span class="float-right"><?= $_SESSION['billEmail'] ?></span>
                              </li>
                              <li class="list-group-item">
                                   Country <span class="float-right"><?= $_SESSION['billCompanyName'] ?></span>
                              </li>
                              <li class="list-group-item">
                                   Phone <span class="float-right"><?= $_SESSION['billPhone'] ?></span>
                              </li>
                              <li class="list-group-item">
                                   State <span class="float-right"><?= $_SESSION['billSate'] ?></span>
                              </li>
                              <li class="list-group-item">
                                   Address <span class="float-right"><?= $_SESSION['billAddress'] ?></span>
                              </li>
                              <li class="list-group-item">
                                   Company Name <span class="float-right"><?= $_SESSION['billCompanyName'] ?></span>
                              </li>
                         </ul>
                    </div>
               </div>
          </div>
     </div>

     <!-- Order modal -->
     <div class="modal" id="modal_order" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content">
                    <div class="modal-header">
                         <h5 class="modal-title">Billing Details </h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                         </button>
                    </div>
                    <div class="modal-body">
                         <ul class="list-group">
                              <?php
                              foreach ($Items as $i => $item) {
                              ?>
                                   <li class="list-group-item">
                                        Product Name <span class="float-right"><?= $item['item_name'] ?></span>
                                   </li>
                                   <li class="list-group-item">
                                        Product Price <span class="float-right"><?= $item['item_price'] ?></span>
                                   </li>
                                   <li class="list-group-item">
                                        Product Quantity <span class="float-right"><?= $item['item_quantity'] ?></span>
                                   </li>
                              <?php
                              }
                              ?>
                         </ul>
                    </div>
               </div>
          </div>
     </div>
     <!-- Page Footer-->

</div>
<!-- /.container-fluid -->

</div>
<!-- <script>
     [...$('.btn-upd-package')].forEach(el => {
          $(el).on('click', function() {
               if (this.getAttribute('data-package-id')) {
                    $('#inp_package_id').val(this.getAttribute('data-package-id'))
                    //show the modal
                    $('#modal_upd_package').modal('show')
               }
          })
     })
</script> -->
<?php
include "footer.php";
