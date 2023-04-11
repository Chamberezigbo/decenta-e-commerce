<!DOCTYPE html>
<html lang="en">

<head>

     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <meta name="description" content="">
     <meta name="author" content="">

     <title>NID Africa - Dashboard</title>

     <!-- Custom fonts for this template-->
     <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
     <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

     <!-- for table data -->
     <script src="../js/jquery-3.3.1.min.js"></script>
     <script src="vendor/jquery/jquery.min.js"></script>
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">


     <!-- Custom styles for this template-->
     <link href="css/sb-admin-2.min.css" rel="stylesheet">
     <script src="https://unpkg.com/octavalidate@1.2.5/native/validate.js"></script>
     <link rel="stylesheet" href="../js/toastr-master/build/toastr.min.css" />
     <!-- loader script -->
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
<style>
     /* loader */
     .loader {
          position: fixed;
          top: 0;
          left: 0;
          width: 100vw;
          height: 100vh;
          display: flex;
          align-items: center;
          justify-content: center;
          background: #ffff;
          z-index: 1;
          transition: opacity 0.75s, visibility 0.75s;
     }

     .loader--hidden {
          opacity: 0;
          visibility: hidden;
     }

     .loader::after {
          content: " ";
          width: 75px;
          height: 75px;
          border: 15px solid #dddddd;
          border-top-color: #009578;
          border-radius: 50%;
          animation: loading 0.75s ease infinite;
     }

     @keyframes loading {
          from {
               transform: rotate(0turn)
          }

          to {
               transform: rotate(1turn)
          }
     }

     /* end of loader  */
</style>

<body id="page-top">
     <div class="loader"></div>
     <!-- Page Wrapper -->
     <div id="wrapper">

          <!-- Sidebar -->
          <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

               <!-- Sidebar - Brand -->
               <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                    <div class="sidebar-brand-icon rotate-n-15">
                         <i class="fas fa-laugh-wink"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">NID <sup>Africa</sup></div>
               </a>

               <!-- Divider -->
               <hr class="sidebar-divider my-0">

               <!-- Nav Item - Dashboard -->
               <li class="nav-item active">
                    <a class="nav-link" href="index.php">
                         <i class="fas fa-fw fa-tachometer-alt"></i>
                         <span>Dashboard</span></a>
               </li>

               <!-- Divider -->
               <hr class="sidebar-divider">

               <!-- Heading -->
               <div class="sidebar-heading">
                    Action
               </div>

               <!-- Nav Item - Pages Collapse Menu -->
               <!-- <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                         <i class="fas fa-fw fa-folder"></i>
                         <span>Pages</span>
                    </a>
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                         <div class="bg-white py-2 collapse-inner rounded">
                              <h6 class="collapse-header">Login Screens:</h6>
                              <a class="collapse-item" href="login.html">Login</a>
                              <a class="collapse-item" href="register.html">Register</a>
                              <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                              <div class="collapse-divider"></div>
                              <h6 class="collapse-header">Other Pages:</h6>
                              <a class="collapse-item" href="404.html">404 Page</a>
                              <a class="collapse-item" href="blank.html">Blank Page</a>
                         </div>
                    </div>
               </li> -->

               <!-- Nav Item - Charts -->
               <li class="nav-item">
                    <a class="nav-link" href="products.php?action=view">
                         <i class=" fas fa-fw fa-chart-area"></i>
                         <span>All Products</span></a>
               </li>

               <!-- Nav Item - Tables -->
               <li class="nav-item">
                    <a class="nav-link" href="tables.php">
                         <i class="fas fa-fw fa-table"></i>
                         <span>Tables OF Users</span></a>
               </li>

               <!-- Nav Item - Sales Tables  -->
               <li class="nav-item">
                    <a class="nav-link" href="sales.php">
                         <i class="fas fa-fw fa-table"></i>
                         <span>Sales</span></a>
               </li>

               <!-- Divider -->
               <hr class="sidebar-divider d-none d-md-block">

               <!-- Sidebar Toggler (Sidebar) -->
               <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
               </div>

          </ul>
          <!-- End of Sidebar -->

          <!-- Content Wrapper -->
          <div id="content-wrapper" class="d-flex flex-column">

               <!-- Main Content -->
               <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                         <!-- Sidebar Toggle (Topbar) -->
                         <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                              <i class="fa fa-bars"></i>
                         </button>

                         <!-- Topbar Navbar -->
                         <ul class="navbar-nav ml-auto">
                              <div class="topbar-divider d-none d-sm-block"></div>

                              <!-- Nav Item - User Information -->
                              <li class="nav-item dropdown no-arrow">
                                   <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">Logout Here </span>
                                   </a>
                                   <!-- Dropdown - User Information -->
                                   <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                                             <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                             Logout
                                        </a>
                                   </div>
                              </li>

                         </ul>

                    </nav>
                    <!-- End of Topbar -->