<?php
include 'header.php';
require('../core/pdo.php');
$db = new DatabaseClass();

// quarry the database //
$users = $db->SelectAll("SELECT * FROM users");
?>

<!-- Begin Page Content -->
<div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-2 text-gray-800">List of users</h1>
     <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
          For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

     <!-- DataTales Example -->
     <div class="card shadow mb-4">
          <div class="card-header py-3">
               <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
          </div>
          <?php if (isset($users) && count($users)) { ?>
               <div class="card-body">
                    <div class="table-responsive">
                         <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                              <thead>
                                   <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                              </thead>
                              <tfoot>
                                   <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                   </tr>
                              </tfoot>
                              <?php
                              foreach ($users as $i => $user) {
                              ?>
                                   <tbody>
                                        <tr>
                                             <th scope="row"><?php echo ++$i; ?></th>
                                             <td><?php print(stripslashes($user['fullName']));  ?></td>
                                             <td><?php print(stripslashes($user['email']));  ?></td>
                                        </tr>
                                   </tbody>
                              <?php } ?>
                         </table>
                    </div>
               </div>
          <?php } else { ?>
               <div class="text-center" style="font-size: 1.2rem;">
                    <p><i class="fa-4x fas fa-exclamation-triangle text-warning"></i></p>
                    <p>No users found. <a href="./users.php">Try again?</a></p>
               </div>
          <?php } ?>
     </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php
include "footer.php";
