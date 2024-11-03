<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>PolluxUI Admin</title>
  <!-- base:css -->
  <link rel="stylesheet" href="../Assets/Templates/Admin/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="../Assets/Templates/Admin/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../Assets/Templates/Admin/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../Assets/Templates/Admin/images/favicon.png" />
</head>
<body>
 
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
          <a class="navbar-brand brand-logo" href="index.html"><img src="../Assets/Templates/Admin/images/logo.svg" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="index.html"><img src="../Assets/Templates/Admin/images/logo-mini.svg" alt="logo"/></a>
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="typcn typcn-th-menu"></span>
          </button>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="../Assets/Templates/Admin/images/faces/face5.jpg" alt="profile"/>
              <span class="nav-profile-name">Eugenia Mullins</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="typcn typcn-cog-outline text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item">
                <i class="typcn typcn-eject text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
        
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="typcn typcn-th-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    
    <div class="container-fluid page-body-wrapper">
     
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="index.html">
              <i class="typcn typcn-device-desktop menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
    <a class="nav-link" data-toggle="collapse" href="#files" aria-expanded="false" aria-controls="files">
        <i class="typcn typcn-folder menu-icon"></i>
        <span class="menu-title">Files</span>
        <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="files">
        <ul class="nav flex-column sub-menu">
        <li class="nav-item"><a class="nav-link" href="District.php">District</a></li>
        <li class="nav-item"><a class="nav-link" href="Place.php">Place</a></li>
        <li class="nav-item"><a class="nav-link" href="Category.php">Category</a></li>
        <li class="nav-item"><a class="nav-link" href="SubCategory.php">SubCategory</a></li>
            <li class="nav-item"><a class="nav-link" href="Brand.php">Brand</a></li>
           
            <li class="nav-item"><a class="nav-link" href="CategorySalesPieChart.php">Category Sales Pie Chart</a></li>
            <li class="nav-item"><a class="nav-link" href="DeliveryAgentRegistration.php">Delivery Agent Registration</a></li>
            
           
            
            <li class="nav-item"><a class="nav-link" href="NewSellerList.php">New Seller List</a></li>
            <li class="nav-item"><a class="nav-link" href="AcceptedSellerList.php">Accepted Seller List</a></li>
            <li class="nav-item"><a class="nav-link" href="RejectedSellerList.php">Rejected Seller List</a></li>
        
         
            <li class="nav-item"><a class="nav-link" href="UserList.php">User List</a></li>
        </ul>
    </div>
</li>

          
          <li class="nav-item">
            <!-- <a class="nav-link" href="https://bootstrapdash.com/demo/polluxui-free/docs/documentation.html">
              <i class="typcn typcn-mortar-board menu-icon"></i>
              <span class="menu-title">Documentation</span>
            </a> -->
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
  
