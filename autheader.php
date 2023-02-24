<!DOCTYPE html>
<html lang="en">

<head>
     <title>Pharma</title>
     <meta charset="utf-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

     <link href="https://fonts.googleapis.com/css?family=Rubik:400,700|Crimson+Text:400,400i" rel="stylesheet" />
     <link rel="stylesheet" href="fonts/icomoon/style.css" />

     <link rel="stylesheet" href="css/bootstrap.min.css" />
     <link rel="stylesheet" href="css/magnific-popup.css" />
     <link rel="stylesheet" href="css/jquery-ui.css" />
     <link rel="stylesheet" href="css/owl.carousel.min.css" />
     <link rel="stylesheet" href="css/owl.theme.default.min.css" />

     <link rel="stylesheet" href="css/aos.css" />

     <link rel="stylesheet" href="css/style.css" />
     <link rel="stylesheet" href="js/toastr-master/build/toastr.min.css" />
     <!-- fluterwave -->
     <script src="https://checkout.flutterwave.com/v3.js"></script>
     <script>
          window.addEventListener('load', () => {
               const loader = document.querySelector('.loader');
               loader.classList.add('loader--hidden');
               loader.addEventListener('transitionend', () => {
                    document.body.removeChild(loader);
               })
          });
     </script>
</head>

<body>
     <div class="loader"></div>
     <div class="site-wrap">
          <div class="site-navbar py-2">
               <div class="search-wrap">
                    <div class="container">
                         <a href="#" class="search-close js-search-close"><span class="icon-close2"></span></a>
                         <form action="#" method="post">
                              <input type="text" class="form-control" placeholder="Search keyword and hit enter..." />
                         </form>
                    </div>
               </div>

               <div class="container">
                    <div class="d-flex align-items-center justify-content-between">
                         <div class="logo">
                              <div class="site-logo">
                                   <a href="index.php" class="js-logo-clone"><?= $_SESSION['fullName'] ?> </a>
                              </div>
                         </div>
                         <div class="main-nav d-none d-lg-block">
                              <?php $page = basename($_SERVER['PHP_SELF']) ?>
                              <nav class="site-navigation text-right text-md-center" role="navigation">
                                   <ul class="site-menu js-clone-nav d-none d-lg-block">
                                        <li class="<?php if ($page == 'index.php') : echo 'active';
                                                       endif ?>">
                                             <a href="index.php">Home</a>
                                        </li>
                                        <li class="<?php if ($page == 'shop.php') : echo 'active';
                                                       endif ?>"><a href="shop.php">Product</a></li>
                                        <li class="has-children"></li>
                                        <li class="<?php if ($page == 'about.php') : echo 'active';
                                                       endif ?>" class="<?php if ($page == 'index.php') : echo 'active';
                                                                           endif ?>"><a href="about.php">About</a></li>
                                        <li class="<?php if ($page == 'contact.php') : echo 'active';
                                                       endif ?>"><a href="contact.php">Contact</a></li>
                                   </ul>
                              </nav>
                         </div>
                         <div class="icons">
                              <a href="#" class="icons-btn d-inline-block js-search-open"><span class="icon-search"></span></a>
                              <a href="cart.php" class="icons-btn d-inline-block bag">
                                   <span class="icon-shopping-bag"></span>
                                   <span class="number"><?php echo ((isset($_SESSION['shopping_cart'])) ? count($_SESSION['shopping_cart']) : 0) ?></span>
                              </a>
                              <a href="#" class="site-menu-toggle js-menu-toggle d-inline-block d-lg-none"><span class="icon-menu"></span></a>
                              <a href="logout.php" class="icons-btn"><i class="fa-solid fa-circle-left"></i></a>
                         </div>
                    </div>
               </div>
          </div>