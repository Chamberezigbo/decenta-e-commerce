<?php
require('auth.php');

if (isset($_GET['status']) && $_GET['status'] == 'completed') {
     // check if user is adding a different address//
     // insert order//
     $array_order = $_SESSION['shopping_cart'];
     $user_id = $_SESSION['user_id'];
     $date = time();
     $json_data = json_encode($array_order);

     $query = "INSERT INTO orders (user_id, details, total_balance, date, order_id)
               VALUES(:user_id, :details, :total_balance, :date,:order_id)";
     $data = [
          'user_id' => $user_id,
          'details' => $json_data,
          'total_balance' => $_SESSION['orderAmount'],
          'date' => $date,
          'order_id' => $_SESSION['order_id'],
     ];

     $result = $db->Insert($query, $data);
     if ($result) {
          $query = "INSERT INTO billing (order_id, fullName,email, phone, address, country, company_name,state)
                    VALUES(:order_id, :fullName, :email,:phone, :address, :country, :company_name,:state)";
          $data = [
               'order_id' => $_SESSION['order_id'],
               'fullName' => $_SESSION['billFullName'],
               'email' => $_SESSION['billEmail'],
               'phone' => $_SESSION['billPhone'],
               'address' => $_SESSION['billAddress'],
               'country' =>  $_SESSION['billCountry'],
               'company_name' =>  $_SESSION['billCompany'],
               'state' => $_SESSION['billState'],
          ];

          $billing_result = $db->Insert($query, $data);
          if ($billing_result) {
               unset($_SESSION['shopping_cart']);
               unset($_SESSION['orderAmount']);
               unset($_SESSION['order_id']);
               unset($_SESSION['billFullName']);
               unset($_SESSION['billEmail']);
               unset($_SESSION['billPhone']);
               unset($_SESSION['billAddress']);
               unset($_SESSION['billCountry']);
               unset($_SESSION['billCompany']);
               unset($_SESSION['billState']);
          }
     } else {
          print('<script>
                    window.location("cart.php");
               </script>');
     }
     // } else {
     //      // use default billing information from the users database //
     //      // Get values from form //
     //      $fullName = $_POST['fullName'];
     //      $email = $_POST['email'];
     //      $phone = $_POST['phone'];
     //      $address = $_POST['address'];
     //      $state = $_POST['state'];
     //      $company_name = $_POST['companyName'];
     //      $country = $_POST['country'];

     //      // insert order//
     //      $array_order = $_SESSION['shopping_cart'];
     //      $user_id = $_SESSION['user_id'];
     //      $totalAmount = $_POST['total_amount'];
     //      $order_id = md5(time() . $email);
     //      $date = time();
     //      $json_data = json_encode($array_order);

     //      $query = "INSERT INTO orders (user_id, details,	total_balance, date, order_id)
     //           VALUES(:user_id, :details, :total_balance, :date,:order_id)";
     //      $data = [
     //           'user_id' => $user_id,
     //           'details' => $json_data,
     //           'total_balance' => $totalAmount,
     //           'date' => $date,
     //           'order_id' => $order_id,
     //      ];

     //      $result = $db->Insert($query, $data);
     //      if ($result) {
     //           $query = "INSERT INTO billing (order_id, fullName,email, phone, address, country, company_name,state)
     //                VALUES(:order_id, :fullName, :email,:phone, :address, :country, :company_name,:state)";
     //           $data = [
     //                'order_id' => $order_id,
     //                'fullName' => $fullName,
     //                'email' => $email,
     //                'phone' => $phone,
     //                'address' => $address,
     //                'country' => $country,
     //                'company_name' => $company_name,
     //                'state' => $state,
     //           ];

     //           $billing_result = $db->Insert($query, $data);
     //           if ($billing_result) {
     //                echo 'successfully insert billing';
     //                die();
     //                // print('<script type="text/javascript">
     //                //      window.location
     //                // </script>');
     //           }
     //      }
     // }
}
?>

<div class="bg-light py-3">
     <div class="container">
          <div class="row">
               <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Thank You</strong></div>
          </div>
     </div>
</div>

<div class="site-section">
     <div class="container">
          <div class="row">
               <div class="col-md-12 text-center">
                    <span class="icon-check_circle display-3 text-success"></span>
                    <h2 class="display-3 text-black">Thank you!</h2>
                    <p class="lead mb-5">You order was successfully completed.</p>
                    <p><a href="shop.php" class="btn btn-md height-auto px-4 py-3 btn-primary">Back to store</a></p>
               </div>
          </div>
     </div>
</div>

<?php
require('footer.php');

?>