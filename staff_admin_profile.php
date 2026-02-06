<?php
session_start();

include "Includes/data_display.php";
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit;
}
$role = $_SESSION['role'] ?? null;

if (!$role) {
   
    header("Location: login.php");
    exit();
}
include 'Includes/db.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>RM Rental Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 <link rel="stylesheet" href="css/notification.css">
   <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
    /><link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }
    .menu-toggle {
    background: none;
    border: none;
    font-size: 1.25rem;
    color: #d1d3e2;
    cursor: pointer;
    padding: 0.5rem;
  }
  
  .menu-toggle:hover {
    color: #b7b9cc;
  }
  
  .profile-wrapper {
    display: flex;
    align-items: center;
    cursor: pointer;
  }
  
  .avatar-sm {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    margin-right: 0.5rem;
  }
  
  .dropdown-menu {
    border: none;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.3);
    border-radius: 0.35rem;
    padding: 0;
    min-width: 14rem;
  }
  
  .avatar-lg {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    border: 3px solid #fff;
    box-shadow: 0 0.15rem 0.5rem 0 rgba(0, 0, 0, 0.1);
  }
  
  .dropdown-item {
    padding: 0.5rem 1.5rem;
    font-size: 0.85rem;
  }
  
  .dropdown-item:hover {
    background-color: #f8f9fc;
    color: #4e73df;
  }
  
  .dropdown-divider {
    margin: 0;
    border-color: #eaecf4;
  }
  
  .user-box {
    background: linear-gradient(130deg, rgba(34, 193, 195, 0.1) 0%, rgba(253, 187, 45, 0.1) 100%);
  }
  
  .topbar-right {
    display: flex;
    align-items: center;
  }
    .pagination {
  float: right;
  margin: 0 0 5px;
}
.pagination li a {
  border: none;
  font-size: 13px;
  min-width: 30px;
  min-height: 30px;
  color: #999;
  margin: 0 2px;
  line-height: 30px;
  border-radius: 2px !important;
  text-align: center;
  padding: 0 6px;
}
.pagination li a:hover {
  color: #666;
}
.pagination li.active a,
.pagination li.active a.page-link {
  background: #03a9f4;
}
.pagination li.active a:hover {
  background: #0397d6;
}
.hint-text {
  float: left;
  margin-top: 10px;
  font-size: 13px;
}
.content-header {
  margin-top: 50px;
}
.search-container {
  margin-left: 450px;
}

.search-container {
  position: relative;
  display: flex;
  align-items: center;
}

.search-icon {
  background: none;
  border: none;
  font-size: 20px;
  cursor: pointer;
  z-index: 2;
}

#searchInput {
  position: absolute;
  right: 35px;
  opacity: 1;
  transition: transform 0.3s ease, opacity 0.3s ease;
  padding: 5px;
  border: 1px solid #ccc;
}

    
    body {
      background: linear-gradient(90deg, #fdbb2d 0%, #22c1c3 100%);
      min-height: 100vh;
    }
    
    /* Top Bar Styles */
    .topbar {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 90px;
      background: linear-gradient(90deg, #fdbb2d 0%, #22c1c3 100%);
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 20px;
      z-index: 1000;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    .topbar .menu-toggle {
      background: none;
      border: none;
      color: white;
      font-size: 1.5rem;
      cursor: pointer;
    }
    
    .search-container {
      display: flex;
      align-items: center;
    }
    
    .search-container input {
      padding: 5px 10px;
      border-radius: 4px;
      border: 1px solid #ccc;
      margin-right: 10px;
    }
    
    .profile-pic {
      display: flex;
      align-items: center;
      color: white;
      text-decoration: none;
    }
    
    .profile-pic img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      margin-right: 10px;
    }
    
    /* Sidebar Styles */
    .sidebar {
  padding: 100px 0;
  position: fixed;
  top: 40px;
  left: 0;
  width: 250px;
  height: calc(100vh - 50px); /* adjusted to match top offset */
  background: linear-gradient(0deg, rgba(47, 99, 99, 1) 100%, rgba(54, 52, 31, 1) 0%);
  color: white;
  transform: translateX(-100%);
  transition: transform 0.3s ease;
  z-index: 999;
  overflow-y: auto; /* enables scrolling */
}
    
    .sidebar.active {
      transform: translateX(0);
    }
    
    .sidebar-header {
      padding: 20px;
      text-align: center;
      border-bottom: 1px solid rgba(255,255,255,0.1);
    }
    .sidebar-header h1 {
  font-size: 1.5rem;
  font-weight: 600;
  margin-bottom: 5px;
}
    .sidebar-header p {
  color: #bdc3c7;
  font-size: 0.9rem;
}
    .sidebar-menu {
      padding: 20px;
        height: calc(100% - 100px);
    }
    .menu-item {
  margin-bottom: 8px;
  list-style: none;
  
}

.menu-item a {
  color: #ecf0f1;
  text-decoration: none;
  display: flex;
  align-items: center;
  padding: 12px 15px;
  border-radius: 6px;
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
}
.menu-item a:hover,
.menu-item a.active {
  background: linear-gradient(
    177deg,
    rgba(34, 193, 195, 1) 0%,
    rgba(253, 187, 45, 1) 100%
  );
  color: white;
  transform: translateX(5px);
}

.menu-item a::before {
  content: "";
  position: absolute;
  left: 0;
  top: 0;
  height: 100%;
  width: 3px;
  background: #3498db;
  transform: scaleY(0);
  transition: transform 0.2s ease;
}

.menu-item a:hover::before,
.menu-item a.active::before {
  transform: scaleY(1);
}
.menu-item i {
  margin-right: 12px;
  width: 20px;
  text-align: center;
  transition: transform 0.3s ease;
}
    .sidebar-menu a {
      color: white;
      text-decoration: none;
      display: block;
      padding: 20px;
      margin-bottom: 5px;
      border-radius: 4px;
    }
    .menu-item a:hover i {
  transform: scale(1.1);
}
.sub-menu {
  padding-left: 15px;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}
.sub-menu.show {
  max-height: 500px;
}
.sub-item {
  padding: 10px 15px;
  display: block;
  color: #bdc3c7;
  border-radius: 5px;
  margin: 5px 0;
  font-size: 0.9rem;
  transition: all 0.3s ease;
  background: rgba(0, 0, 0, 0.1);
}
.sub-item:hover {
  background-color: rgba(255, 255, 255, 0.1);
  color: white;
  padding-left: 20px;
}
    
    .sidebar-menu a:hover {
      background: rgba(255,255,255,0.1);
    }
    
    /* Main Content Styles */
    .main-content {
      margin-top: 100px;
      padding: 20px;
      transition: margin-left 0.3s ease;
    }
    
    /* Table Styles */
    .table-container {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
    margin-bottom: 20px;
  }
  
  .table-title {
    padding: 1.25rem 1.5rem;
    margin-bottom: 0;
    color: white;
  }
  
  .table-title h2 {
    font-size: 1.5rem;
    font-weight: 600;
  }
  
  .search-box {
    width: 300px;
  }
  
  .table th {
    font-weight: 600;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 12px 15px;
    vertical-align: middle;
    border-bottom: 2px solid #e3e6f0;
  }
  
  .table td {
    padding: 12px 15px;
    vertical-align: middle;
    border-top: 1px solid #e3e6f0;
    font-size: 0.9rem;
  }
  
  .table-footer {
    padding: 1rem 1.5rem;
    background-color: #f8f9fc;
    border-top: 1px solid #e3e6f0;
    border-radius: 0 0 8px 8px;
  }
  
  .hint-text {
    font-size: 0.85rem;
    color: #6c757d;
  }
  
  .pagination {
    margin-bottom: 0;
  }
  
  .page-item.active .page-link {
    background-color: #4e73df;
    border-color: #4e73df;
  }
  
  .page-link {
    color: #4e73df;
    font-size: 0.85rem;
    padding: 0.375rem 0.75rem;
  }
  
  .btn-group .btn {
    padding: 0.25rem 0.5rem;
    font-size: 0.75rem;
  }
  
  @media (max-width: 992px) {
    .table-responsive {
      overflow-x: auto;
    }
    
    .search-box {
      width: 100%;
      margin-top: 10px;
    }
    
    .table-title .d-flex {
      flex-direction: column;
    }
  
}
.main-content {
  margin-left: 250px;
  padding: 40px 20px;
}

.profile-card {
  padding: 25px;
  background: white;
  border-radius: 10px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
  max-width: 600px;
  margin: auto;
}

.profile-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.profile-icon {
  width: 70px;
  height: 70px;
  font-size: 26px;
  background: linear-gradient(135deg, #ff5722, #d32f2f);
  border-radius: 50%;
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-right: 15px;
}

.burger-menu {
  display: none;
}

.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

@media (max-width: 991px) {


  .sidebar.show {
    left: 0;
  }

  .main-content {
    margin-left: 0;
    width: 100%;
  }

  .burger-menu {
    display: block;
    position: fixed;
    top: 15px;
    right: 15px;
    font-size: 28px;
    color: white;
    background-color: #d32f2f;
    padding: 10px 15px;
    border-radius: 5px;
    z-index: 1001;
    cursor: pointer;
  }
}

/* edit profile*/
:root {
  --primary-color: #6c63ff;
  --secondary-color: #f8f9fa;
  --accent-color: #ff6584;
}



.registration-card {
  border: none;
  border-radius: 15px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  overflow: hidden;
  margin-top: 30px;
  margin-bottom: 30px;
}

.card-header {
  background: linear-gradient(135deg, var(--primary-color), #8a84ff);
  color: white;
  padding: 25px;
  border-bottom: none;
}

.card-body {
  padding: 30px;
}

.form-control,
.custom-select {
  height: 50px;
  border-radius: 8px;
  border: 1px solid #e0e0e0;
  padding-left: 15px;
}

.form-control:focus,
.custom-select:focus {
  box-shadow: 0 0 0 0.2rem rgba(108, 99, 255, 0.25);
  border-color: var(--primary-color);
}

.btn-primary {
  background-color: var(--primary-color);
  border: none;
  padding: 12px 30px;
  border-radius: 8px;
  font-weight: 600;
  letter-spacing: 0.5px;
  text-transform: uppercase;
  font-size: 14px;
}

.btn-primary:hover {
  background-color: #5a52e0;
}

.input-group-text {
  background-color: white;
  border-right: none;
}

.input-group .form-control {
  border-left: none;
}

.section-title {
  color: var(--primary-color);
  font-weight: 600;
  margin-bottom: 20px;
  font-size: 18px;
  position: relative;
  padding-left: 15px;
}

.section-title:before {
  content: "";
  position: absolute;
  left: 0;
  top: 5px;
  height: 15px;
  width: 5px;
  background-color: var(--primary-color);
  border-radius: 3px;
}

.floating-label {
  position: relative;
  margin-bottom: 25px;
}

.floating-label label {
  position: absolute;
  top: 15px;
  left: 15px;
  color: #999;
  transition: all 0.3s ease;
  pointer-events: none;
}

.floating-label input:focus + label,
.floating-label input:not(:placeholder-shown) + label,
.floating-select select:focus + label,
.floating-select select:not([value=""]):valid + label {
  top: -10px;
  left: 10px;
  font-size: 12px;
  background-color: white;
  padding: 0 5px;
  color: var(--primary-color);
}

/* Custom styling for select dropdown */
.custom-select {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='4' height='5' viewBox='0 0 4 5'%3e%3cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3e%3c/svg%3e");
  background-repeat: no-repeat;
  background-position: right 0.75rem center;
  background-size: 8px 10px;
}

.row_center {
  background-image: url("Pictures/road-7525091.jpg");
  background-size: cover;
  background-position: center;
  z-index: 1;
  min-height: calc(100vh - 200px); /* Adjust based on banner height */
  padding: 40px 0;
}

.profile-card {
  background: white;
  border-radius: 15px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  overflow: hidden;
  max-width: 800px;
  margin: 0 auto;
}

.profile-header {
  background: linear-gradient(135deg, #3b5d50, #2c3d37);
  padding: 30px;
  color: white;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.profile-icon {
  width: 80px;
  height: 80px;
  font-size: 32px;
  background: linear-gradient(135deg, #ff5722, #d32f2f);
  border-radius: 50%;
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-right: 20px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.profile-info {
  flex: 1;
}

.profile-name {
  font-size: 24px;
  font-weight: 600;
  margin-bottom: 5px;
}

.profile-email {
  font-size: 14px;
  opacity: 0.9;
}

.profile-body {
  padding: 30px;
}

.profile-detail {
  display: flex;
  margin-bottom: 20px;
  padding-bottom: 20px;
  border-bottom: 1px solid #eee;
}

.profile-detail:last-child {
  border-bottom: none;
  margin-bottom: 0;
  padding-bottom: 0;
}

.detail-label {
  font-weight: 600;
  color: #3b5d50;
  width: 150px;
}

.detail-value {
  flex: 1;
}

.verified-badge {
  background: #e3f7ef;
  color: #28a745;
  padding: 3px 10px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: 600;
  margin-left: 10px;
}

.verify-badge {
  background: #fff3cd;
  color: #856404;
  padding: 3px 10px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: 600;
  margin-left: 10px;
  cursor: pointer;
}

.menu-item a:hover,
.menu-item a.active {
background: linear-gradient(
  0deg,
  rgba(20, 40, 40, 1) 100%,
  rgba(30, 28, 16, 1) 0%
);

  color: white;
  transform: translateX(5px);
}
.edit-btn {
  border-radius: 30px;
  padding: 8px 20px;
  font-weight: 600;
  transition: all 0.3s;
}

.edit-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}


@media (max-width: 768px) {
  .profile-header {
    flex-direction: column;
    text-align: center;
    padding: 20px;
  }

  .profile-icon {
    margin-right: 0;
    margin-bottom: 15px;
  }

  .profile-detail {
    flex-direction: column;
  }

  .detail-label {
    width: 100%;
    margin-bottom: 5px;
  }
}

  </style>
</head>
<body>
<?php

include 'Includes/db.php';

$user_id = $_SESSION['user_id'] ?? null;

if ($user_id) {
    $query = "SELECT image, role, email, username FROM user WHERE user_id = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    $stmt->bind_result($image, $role, $email, $username);
    
    if ($stmt->fetch()) {
        $image_path = !empty($image) ? "Pictures/" . htmlspecialchars($image) : "Pictures/default.jpg";
    } else {
        echo "No user found with user_id = " . $user_id;
    }

    $stmt->close();
} else {
    echo "User not logged in.";
}
?>

  <!-- Top Bar -->
  <div class="topbar">
  <button class="menu-toggle" id="menuToggle">
    <i class="fas fa-bars"></i>
  </button>
  
  <div class="topbar-right">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown list-unstyled">
            <a class="nav-link profile-pic" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="profile-wrapper">
                    <!-- Display the profile image dynamically -->
                    <?php 
                    // Check if image exists, else use default
                    $image_path = !empty($image) ? "Pictures/" . $image : "Pictures/default.jpg"; 
                    echo "<img src='" . $image_path . "' alt='Profile Image' style='width: 40px; height: 40px; object-fit: cover; border-radius: 50%;' />";
                    ?>

                    <div class="font-weight-bold"><?php echo htmlspecialchars($role); ?></div>
                    <i class="fas fa-caret-down ml-1"></i>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <div class="dropdown-user-scroll scrollbar-outer">
                    <div class="user-box text-center p-3">
                        
                        <img src="Pictures/<?php echo !empty($image) ? $image : 'default.jpg'; ?>" alt="Profile Image" class="avatar-lg mb-3">
                        <div class="u-text">
                <h4 class="mb-1"><?php echo htmlspecialchars($role); ?></h4>
                <p class="text-muted mb-2"><?php echo htmlspecialchars($email); ?></p>
                      
                            <a class="dropdown-item text-primary" href="staff_admin_profile.php"><i class="fas fa-user mr-2"></i> My Profile</a>
                            <div class="dropdown-divider"></div>

                            <div class="dropdown-divider"></div>
<a class="dropdown-item text-primary" href="update_password_staff_admin.php">
    <i class="fas fa-key mr-2"></i>Update Password
</a>
<div class="dropdown-divider"></div>

              </div>
            </div>
                    <a class="dropdown-item" href="Includes/signout.php"><i class="fas fa-sign-out-alt mr-2"></i> Logout</a>
                </div>
            </div>
        </li>
    </ul>
</div>

</div>
  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <div class="sidebar-header">
      <h3>RM Rental</h3>
      <p><?php echo $_SESSION['role'] ?></p>
    </div>
    
    <div class="sidebar-menu">
      <ul> 
      <li class="menu-item">
          <a href="dashboard.php" 
          >
            <i class="fas fa-tachometer-alt"></i>
            Dashboard
          </a>
        </li>
        <?php if($_SESSION['role'] == "admin"){ ?>
        <li class="menu-item">
  <a href="add_admin.php">
    <i class="fas fa-user-shield"></i> <!-- Icon for Admin -->
    Add Admin
  </a>
</li>

<li class="menu-item">
  <a href="add_staff.php">
    <i class="fas fa-user-plus"></i> <!-- Icon for Staff -->
    Add Staff
  </a>
</li>
<li class="menu-item">
  <a  class="menu-toggle" data-toggle="collapse" href="#status" role="button" aria-expanded="false">
    <div style="white-space: nowrap; font-size: 20px">
      <i class="fas fa-check-circle"></i> Status Products
      <i class="fas fa-angle-right"></i>
    </div>
  </a>
  <div class="sub-menu collapse" id="status">
    <a href="status_brand.php" class="sub-item">Status Brand</a>
    <a href="status_motorcycle.php" class="sub-item">Status Motorcycle</a>
  </div>
</li>
<?php } ?>

      <li class="menu-item">
          <a  class="menu-toggle" data-toggle="collapse" href="#brandsMenu" role="button" aria-expanded="false">
            <div><i class="fas fa-tags"></i> Brands<i class="fas fa-angle-right"></i></div>
           
          </a>
          <div class="sub-menu collapse" id="brandsMenu">
          <a href="add_brands.php" class="sub-item">Create Brands</a>
           <a href="view_brands.php" class="sub-item">View Brands</a>
          </div>
        </li>
       </li>
        <li class="menu-item">
          <a  class="menu-toggle"  data-toggle="collapse" href="#vehiclesMenu" role="button" aria-expanded="false" >
            <div><i class="fas fa-car"></i> Vehicles<i class="fas fa-angle-right"></i></div>
           
          </a>
          <div class="sub-menu collapse" id="vehiclesMenu">
            <a href="add_vehicle.php"  class="sub-item">Post a Vehicle</a>
             <a href="view_vehicle.php "  class="sub-item">View Vehicles</a>
          </div>
        </li>
        <li class="menu-item">
          <a class="menu-toggle " data-toggle="collapse" href="#vehiclesMenus" role="button" aria-expanded="false">
            <div><i class="fas fa-car"></i>Booking<i class="fas fa-angle-right"></i></div>
           
          </a>
          <div class="sub-menu collapse" id="vehiclesMenus">
            <a href="view_booking.php"  class="sub-item">Manage Booking</a>
             <a href="message.php" class="sub-item">Booking Information</a>
          </div>
        </li>
        <?php if($_SESSION['role'] == "admin"){ ?>
        <li class="menu-item">
          <a class="menu-toggle " data-toggle="collapse" href="#vehiclesMenus1" role="button" aria-expanded="false">
            <div><i class="fas fa-users"></i> User  <i class="fas fa-angle-right"></i></div>
           
          </a>
          <div class="sub-menu collapse" id="vehiclesMenus1">
            <a href="view_admin.php"  class="sub-item">view Admin</a>
             <a href="view_staff.php" class="sub-item">view Staff</a>
             <a href="reg_user.php" class="sub-item">Veiw user</a>
          </div>
     
<?php } ?>
<li class="menu-item ">
          <a href="message1.php"
          >
            <i class="fas fa-tachometer-alt"></i>
            Message
          </a>
        </li>
          </ul>
    </div>
  </div>
  
<div class="main-content">
    <div class="dashboard-content">

                   <div class="container row justify-content-center">
                <div class="profile-card col-11">
                    <div class="profile-header ">
                        <div class="d-flex align-items-center">

                        <div class="profile-icon image" style="width: 100px; height: 100px; overflow: hidden; border-radius: 50%;">
  <?php if (!empty($image)): ?>
    <img src="Pictures/<?php echo htmlspecialchars($image); ?>"
         alt="Profile Image"
         style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;" />
  <?php else: ?>
    <img src="Pictures/default.jpg"
         alt="Default Profile Image"
         style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;" />
  <?php endif; ?>
</div>




                            <div class="profile-info">
                                <div class="profile-name"></div>
                                <?php echo htmlspecialchars($username); ?>
                                <div class="profile-email"></div>
                                <?php echo htmlspecialchars($email); ?>
                            </div>
                        </div>
                        <button class="btn btn-outline-light edit-btn" onclick="location.href='staff_admin_edit.php';">
                            <i class="fas fa-edit"></i> Edit Profile
                        </button>
                    </div>
                    
                    <div class="profile-body">

                    

                        <div class="profile-detail">
                            <div class="detail-label">Guest Name</div>
                            <?php echo htmlspecialchars($username); ?>
                            <div class="detail-value"></div>
                        </div>
                        
                        <div class="profile-detail">
                            <div class="detail-label">Legal Name</div>
                            <?php echo htmlspecialchars($fname); ?> <?php echo htmlspecialchars($lname); ?>
                              <div class="detail-value"></div>
                        </div>
                        
                        <div class="profile-detail">
                            <div class="detail-label">Email Address</div>
                            <?php echo htmlspecialchars($email); ?>
                            <div class="detail-value">
                                
                                <span class="verified-badge"><i class="fas fa-check-circle"></i> Verified</span>
                            </div>
                        </div>
                        
                        <div class="profile-detail">
                            <div class="detail-label">Phone Number</div>
                            <?php echo htmlspecialchars($phoneNum); ?>
                            <div class="detail-value">
                              
                                <span class="verify-badge"><i class="fas fa-shield-alt"></i> Verify Now</span>
                            </div>
                        </div>
                        
                      
                        <div class="profile-detail">
    <div class="detail-label">Address</div>
    <div class="detail-value"> 
        <?php
            $addressParts = [];

           
            if (!empty($city)) $addressParts[] = htmlspecialchars($city);
            if (!empty($province)) $addressParts[] = htmlspecialchars($province);
           

            echo implode(', ', $addressParts);
        ?>
    </div>
</div>
            </div>
   
       
    </div>
</div>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
    $(document).ready(function() {
      // Toggle sidebar on mobile
      $('#menuToggle').click(function() {
        $('#sidebar').toggleClass('active');
      });
      
      // Toggle sidebar on desktop for more space
      let sidebarHidden = false;
      
      function toggleSidebar() {
        sidebarHidden = !sidebarHidden;
        if (sidebarHidden) {
          $('body').addClass('sidebar-hidden');
        } else {
          $('body').removeClass('sidebar-hidden');
        }
      }
      
      // Only enable desktop toggle on large screens
      if (window.innerWidth >= 992) {
        $('#menuToggle').click(toggleSidebar);
      }
      
      // Adjust on window resize
      $(window).resize(function() {
        if (window.innerWidth >= 992) {
          $('#menuToggle').off('click').click(toggleSidebar);
          $('#sidebar').removeClass('active');
        } else {
          $('#menuToggle').off('click').click(function() {
            $('#sidebar').toggleClass('active');
          });
        }
      });
    });
    
     $(document).ready(function() {
       
        $('.delete').on('click', function() {
            var id_moto = $(this).data('id');
            $('#delete-id').val(id_moto);
        });
    });

     document.getElementById('searchInput').addEventListener('keyup', function() {
    var filter = this.value.toLowerCase();
    var rows = document.querySelectorAll('#motorcycleTable tbody tr');

    rows.forEach(function(row) {
        var ng = row.cells[1].textContent.toLowerCase(); 
        var fn = row.cells[2].textContent.toLowerCase(); 
        var ln = row.cells[3].textContent.toLowerCase(); 
         var e = row.cells[4].textContent.toLowerCase(); 
        var c = row.cells[5].textContent.toLowerCase(); 
        var apt = row.cells[6].textContent.toLowerCase(); 
         var s = row.cells[7].textContent.toLowerCase(); 
            var city = row.cells[8].textContent.toLowerCase();
               var pro = row.cells[9].textContent.toLowerCase();
                  var code = row.cells[10].textContent.toLowerCase();
                     var cd = row.cells[11].textContent.toLowerCase();
      

      
        if (ng.indexOf(filter) > -1 || fn.indexOf(filter) > -1 || ln.indexOf(filter) > -1 || e.indexOf(filter) > -1 ||  c.indexOf(filter) > -1 ||          
       apt.indexOf(filter) > -1 || s.indexOf(filter) > -1 || city.indexOf(filter) > -1 ||  pro.indexOf(filter) > -1 || code.indexOf(filter) > -1 || cd.indexOf(filter) > -1 ||   filter === "") {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});


document.getElementById('toggleSearch').addEventListener('click', function() {
  document.querySelector('.search-container').classList.toggle('active');
});

 $(document).ready(function() {
    // Toggle sidebar
    $("#toggleSidebar").click(function(e) {
      e.preventDefault();
      $("#sidebar").toggleClass("active");
      $("#sidebarOverlay").toggleClass("active");
      $("body").toggleClass("sidebar-open");
    });
    
    // Close sidebar when clicking overlay
    $("#sidebarOverlay").click(function() {
      $("#sidebar").removeClass("active");
      $(this).removeClass("active");
      $("body").removeClass("sidebar-open");
    });
    
    // Close sidebar when clicking on a menu item (optional)
    $(".sidebar-menu a").click(function() {
      if($(window).width() < 769) {
        $("#sidebar").removeClass("active");
        $("#sidebarOverlay").removeClass("active");
        $("body").removeClass("sidebar-open");
      }
    });
    
    // Initialize Bootstrap collapse for submenus
    $('.menu-toggle').click(function(e) {
      if($(window).width() > 768) {
        e.preventDefault();
        var target = $(this).attr('href');
        $(target).collapse('toggle');
        
        // Rotate caret icon
        $(this).find('.caret i').toggleClass('fa-angle-down fa-angle-right');
      }
    });
  });


  </script>
</body>