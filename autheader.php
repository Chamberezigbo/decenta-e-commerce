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
</head>

<body>
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
                                   <a href="index.php" class="js-logo-clone">Pharma</a>
                              </div>
                         </div>
                         <div class="main-nav d-none d-lg-block">
                              <nav class="site-navigation text-right text-md-center" role="navigation">
                                   <ul class="site-menu js-clone-nav d-none d-lg-block">
                                        <li class="active">
                                             <a href="index.php">Home</a>
                                        </li>
                                        <li><a href="shop.php">Store</a></li>
                                        <li class="has-children"></li>
                                        <li><a href="contact.php">Contact</a></li>
                                   </ul>
                              </nav>
                         </div>
                         <div class="icons">
                              <a href="#" class="icons-btn d-inline-block js-search-open"><span class="icon-search"></span></a>
                              <a href="cart.html" class="icons-btn d-inline-block bag">
                                   <span class="icon-shopping-bag"></span>
                                   <span class="number">2</span>
                              </a>
                              <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none"><span class="icon-menu"></span></a>
                              <a href="logout.php" class="icons-btn"><?= $_SESSION['fullName'] ?> <i class="fa-solid fa-circle-left"></i></a>
                         </div>
                    </div>
               </div>
          </div>