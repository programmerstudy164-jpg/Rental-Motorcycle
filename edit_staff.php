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

$query = "SELECT COUNT(*) as total FROM user WHERE role = 'customer'";

$result = $conn->query($query);
$row = $result->fetch_assoc();
$totaluser = $row['total'];


$query1 = "SELECT COUNT(*) as total FROM brand";
$result = $conn->query($query1);
$row2 = $result->fetch_assoc();
$totalbrand = $row2['total'];

$query2 = "SELECT COUNT(*) as total FROM motorcycle";
$result = $conn->query($query2);
$row2 = $result->fetch_assoc();
$totalmotor = $row2['total'];

$query2 = "SELECT COUNT(*) as total FROM rentals ";
$result = $conn->query($query2);
$row2 = $result->fetch_assoc();
$totalrental = $row2['total'];


if (isset($_SESSION['login_success'])) {
    $message = $_SESSION['login_success'];
    echo "
    <script>
        toastr.options = {
            positionClass: 'toast-top-center',
            timeOut: 3000
        };
        toastr.success('$message');
    </script>";
    unset($_SESSION['login_success']);
}

if (isset($_SESSION['login_error'])) {
    $message = $_SESSION['login_error'];
    echo "
    <script>
        toastr.options = {
            positionClass: 'toast-top-center',
            timeOut: 3000
        };
        toastr.error('$message');
    </script>";
    unset($_SESSION['login_error']);
}


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

}
    .sidebar-header p {
  color: #bdc3c7;
  font-size: 0.9rem;
}
    .sidebar-menu {
     
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
  margin-right: 20px;
  width: 3px;
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
 
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}
.sub-menu.show {
  max-height: 500px;
}
.sub-item {
  
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
    .dashboard-stats {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
  gap: 1.5rem;
}

/* Stat Card Styles */
.stat-card {
  background: linear-gradient(
    0deg,
    rgba(34, 193, 195, 1) 0%,
    rgba(253, 187, 45, 1) 100%
  );
  border-radius: 12px;
  padding: 1.5rem;
  box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px,
    rgba(0, 0, 0, 0.22) 0px 10px 10px;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  position: relative;
  overflow: hidden;
}

.stat-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
    0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

.stat-icon {
  width: 48px;
  height: 48px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 1rem;
  color: white;
}

.stat-icon svg {
  width: 24px;
  height: 24px;
}

.stat-info h3 {
  font-size: 2rem;
  font-weight: 700;
  color: #1e293b;
  margin: 0 0 0.25rem;
}

.stat-info p {
  color: #64748b;
  font-size: 0.9rem;
  margin: 0;
  font-weight: 500;
}

.stat-link {
  display: inline-flex;
  align-items: center;
  margin-top: 1.5rem;
  color: #3b82f6;
  font-size: 0.85rem;
  font-weight: 600;
  text-decoration: none;
  transition: color 0.2s ease;
}

.stat-link span {
  margin-left: 0.25rem;
  transition: transform 0.2s ease;
}

.stat-link:hover {
  color: #2563eb;
}

.stat-link:hover span {
  transform: translateX(3px);
}

/* Individual Card Colors */
.card-1 .stat-icon {
  background-color: #6366f1;
}
.card-2 .stat-icon {
  background-color: #10b981;
}
.card-3 .stat-icon {
  background-color: #f59e0b;
}
.card-4 .stat-icon {
  background-color: #ec4899;
}
.card-5 .stat-icon {
  background-color: #3b82f6;
}
.card-6 .stat-icon {
  background-color: #8b5cf6;
}
.card-7 .stat-icon {
  background-color: #14b8a6;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
  .dashboard-stats {
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
  }
}

@media (max-width: 480px) {
  .dashboard-stats {
    grid-template-columns: 1fr;
  }

  .main-content {
    padding: 1rem;
  }
}
.dashboard-stats {
  display: flex;
  flex-wrap: wrap;
  justify-content: center; 
  align-items: flex-start;
  gap: 20px; /* spacing between cards */
}

.stat-card {
  flex: 0 0 auto; /* prevents shrinking */
  width: 250px;   /* or use your original width */
}

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
.image{
    height: 600px;
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
    


 


  

  </style>
</head>
<body>
  <!-- Top Bar -->
  <?php

$user_id = $_SESSION['user_id'] ?? null;

if ($user_id) {
    $query = "SELECT image, role, email FROM user WHERE user_id = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    $stmt->bind_result($image, $role, $email);
    if ($stmt->fetch()) {

        $image_path = !empty($image) ? "Pictures/" . $image : "Pictures/default.jpg";

    
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
          <a href="dashboard.php" class="active"
          >
            <i class="fas fa-tachometer-alt"></i>
            Dashboard
          </a>
        </li>
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
          <a class="menu-toggle" data-toggle="collapse" href="#brandsMenu" role="button" aria-expanded="false">
            <div><i class="fas fa-tags"></i> Brands<i class="fas fa-angle-right"></i></div>
           
          </a>
          <div class="sub-menu collapse" id="brandsMenu">
          <a href="add_brands.php" class="sub-item">Create Brands</a>
           <a href="view_brands.php" class="sub-item">View Brands</a>
          </div>
        </li>
       </li>
        <li class="menu-item">
          <a   class="menu-toggle"  data-toggle="collapse" href="#vehiclesMenu" role="button" aria-expanded="false" >
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
       
        <li class="menu-item">
          <a class="menu-toggle " data-toggle="collapse" href="#vehiclesMenus1" role="button" aria-expanded="false">
            <div><i class="fas fa-users"></i> User  <i class="fas fa-angle-right"></i></div>
           
          </a>
          <div class="sub-menu collapse" id="vehiclesMenus1">
            <a href="view_admin.php"  class="sub-item">view Admin</a>
             <a href="view_staff.php" class="sub-item">view Staff</a>
             <a href="reg_user.php" class="sub-item">View user</a>
          </div>
     
     

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
  
  <?php
// Assuming you've connected to the database and prepared the query
include 'Includes/db.php'; 

// Debugging: Check if user_id is passed via URL
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];


    // Query to fetch user data by user_id
    $query = "SELECT * FROM user WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);  // 'i' for integer
    $stmt->execute();
    $result = $stmt->get_result();

    // Debugging: Check if the query returned any results
    if ($result->num_rows > 0) {
       
        $user = $result->fetch_assoc();
    } else {
      
        exit; // Exit if no data is found
    }
} else {
    echo "User ID not passed in URL.<br>";
    exit; // Exit if user_id is not in URL
}



// Debugging: Check the value of fname specifically
if (isset($user['fname'])) {
    echo "First Name from DB: " . htmlspecialchars($user['fname']) . "<br>"; // Debugging output
} else {
    echo "No First Name found in the database.<br>";
}
?>
  
  <!-- Main Content -->
  <div class="main-content" id="mainContent">
    
  <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-9">

                <div class="card registration-card ">
                <div class="card-header" style="background:linear-gradient(130deg,rgba(34, 193, 195, 1) 0%, rgba(253, 187, 45, 1) 100%);">
                        <h3>Edit Staff</h3>
                    </div>

                    <div class="card-body ">

                        <form method="POST" action="Includes/edit_staff.php" enctype="multipart/form-data">
                        <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                           
                            <h5 class="section-title " style="color: #3b5d50;">Personal Information</h5>

                              <div class="row">

                                 <div class="col-md-6">
                                    <div class="floating-label">
                                    <input type="text" name="fname" class="form-control" id="FirstName" placeholder=" " value="<?= htmlspecialchars($user['fname']) ?>">

                                        <label for="FirstName">First Name</label>
                                    </div>
                                </div>
                                
                                 <div class="col-md-6">
                                    <div class="floating-label">
                                    <input type="text" name="lname" class="form-control" id="FirstName" placeholder=" " value="<?= htmlspecialchars($user['lname']) ?>">

                                        <label for="lastName">Last Name</label>
                                    </div>
                                </div>
                                  </div>
                            
                            <div class="row">

                                  <div class="col-md-6">
                                    <div class="floating-label">
                                    <input type="text" name="username" class="form-control" id="FirstName" placeholder=" " value="<?= htmlspecialchars($user['username']) ?>">

                                        <label for="Name">Guest Name</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="floating-label">
                                    <input type="text" name="phoneNum" class="form-control" id="FirstName" placeholder=" " value="<?= htmlspecialchars($user['phoneNum']) ?>">

                                        <label for="EmailAddress">Phone Numbers</label>
                                    </div>
                                </div>
                            </div>

                            
                           <div class="row">
                              <div class="col-md-6 ">
                                    <div class="custom-file">
                                        <input type="file" name="profile_image" class="custom-file-input image" id="vehicleImage" accept="image/*">
                                        <label class="custom-file-label" for="vehicleImage">Choose Profile image...</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="floating-label">
                                    <input type="text" name="email" class="form-control" id="FirstName" placeholder=" " value="<?= htmlspecialchars($user['email']) ?>">

                                        <label for="Name">email</label>
                                    </div>
                                </div>
                                
                               </div> 

                              
                            
                             
                            
                            
                            <h5 class="section-title mt-4" style="color: #3b5d50;">Password</h5>

                            <div class="row justify-content-center">
  <div class="col-md-9">
    <!-- Current Password -->
    <div class="floating-label mb-3" style="position: relative;">
      <input type="password" name="curpass" class="form-control" id="curpass" placeholder=" " required>
      <label for="curpass">Current Password</label>
      <i class="fas fa-eye-slash toggle-password"
         style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;"
         onclick="togglePassword('curpass', this)">
      </i>
    </div>

    <!-- New Password -->
    <div class="floating-label" style="position: relative;">
      <input type="password" name="newpass" class="form-control" id="newpass" placeholder=" " required>
      <label for="newpass">New Password</label>
      <i class="fas fa-eye-slash toggle-password"
         style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;"
         onclick="togglePassword('newpass', this)">
      </i>
    </div>
  </div>
</div>

</div>
                           

                              
                            
                            <div class="text-center mt-4 mb-4">
                                <button type="submit" class="btn btn-primary px-5" style="background-color: #3b5d50;">
                                    <i class="fas fa-paper-plane mr-2"></i> Submit Registration
                                </button>
                            </div>
                            
                        </form>
                    </div>
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

  

  function togglePassword(inputId, icon) {
    const input = document.getElementById(inputId);
    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    } else {
        input.type = "password";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    }
  }

  </script>
</body>
</html>