<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['add_to_cart'])) {
     # code...
     // check if variable has some data or not//
     if (isset($_SESSION['shopping_cart'])) {
          # code...
          $item_array_id = array_column($_SESSION["shopping_cart"], 'item_id');
          if (!in_array($_GET['id'], $item_array_id,)) {
               # code...
               $count = count($_SESSION['shopping_cart']);
               $item_array = array(
                    'item_id' => $_GET['id'],
                    'item_name' => $_POST['hidden_product_name'],
                    'item_price' => $_POST['hidden_product_price'],
                    'item_quantity' => $_POST['quantity'],
                    "item_image" => $_POST['hidden_product_image'],
               );
               $_SESSION['shopping_cart'][$count] = $item_array;
               $_SESSION['success'] = true;
               $_SESSION['msg'] = "Item Has been added to cart";
               echo "<script>history.back() </script>";
          } else {
               $_SESSION['success'] = true;
               $_SESSION['msg'] = "Item Already Added";
               echo "<script>history.back() </script>";
          }
     } else {
          $item_array = array(
               'item_id' => $_GET['id'],
               'item_name' => $_POST['hidden_product_name'],
               'item_price' => $_POST['hidden_product_price'],
               'item_quantity' => $_POST['quantity'],
               "item_image" => $_POST['hidden_product_image'],
          );
          $_SESSION['shopping_cart'][0] = $item_array;
          $_SESSION['success'] = true;
          $_SESSION['msg'] = "Item has been added to cart";
          echo "<script>history.back() </script>";
     }
}

if (isset($_GET['action'])) {
     if ($_GET['action'] == 'delete') {
          #delete a product from cart
          foreach ($_SESSION['shopping_cart'] as $keys => $values) {
               if ($values['item_id'] == $_GET['id']) {
                    # code...
                    unset($_SESSION['shopping_cart'][$keys]);
                    $_SESSION['success'] = true;
                    $_SESSION['msg'] = "Item removed from cart";
                    echo "<script>window.location='cart.php'</script>";
               }
          }
     }
}
