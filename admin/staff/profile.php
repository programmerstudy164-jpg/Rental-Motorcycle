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
<?php
include 'Includes/db.php';

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
        // Check if image exists or default to a placeholder
        $image_path = !empty($image) ? "Pictures/" . $image : "Pictures/default.jpg";

    
    } else {
        echo "No user found with user_id = " . $user_id;
    }

    $stmt->close();
} else {
    echo "User not logged in.";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>RM Rental Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 <link rel="stylesheet" href="Css/notification.css">
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


    


 


  

  </style>
</head>
<body>
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
                        <!-- Display the large profile image in the dropdown -->
                        <img src="Pictures/<?php echo !empty($image) ? $image : 'default.jpg'; ?>" alt="Profile Image" class="avatar-lg mb-3">


                        
                        <div class="u-text">
                            <h4 class="mb-1"><?php echo htmlspecialchars($role); ?></h4>
                            <p class="text-muted mb-2"><?php echo htmlspecialchars($email); ?></p>
                            <a href="#" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-primary" href="#"><i class="fas fa-user mr-2"></i> My Profile</a>
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
  <?php      }
?>
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
     <?php }?>

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
  
  
  <!-- Main Content -->
  <div class="main-content" id="mainContent">
    
      <div class="container">
                <div class="profile-card">
                    <div class="profile-header ">
                        <div class="d-flex align-items-center">

                         <div class="profile-icon image" style="width: 100px; height: 100px; overflow: hidden; border-radius: 50%;">
  <?php if (!empty($image)): ?>
    <img src="<?php echo $image; ?>" alt="Profile Image"
         style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;" />
  <?php else: ?>
    <img src="Pictures/default.jpg" alt="Default Profile Image"
         style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;" />
  <?php endif; ?>
</div>



                            <div class="profile-info">
                                <div class="profile-name"><?php echo $guest_name; ?></div>
                                <div class="profile-email"><?php echo $email; ?></div>
                            </div>
                        </div>
                        <button class="btn btn-outline-light edit-btn" onclick="location.href='edit_profile.php';">
                            <i class="fas fa-edit"></i> Edit Profile
                        </button>
                    </div>
                    
                    <div class="profile-body">

                    

                        <div class="profile-detail">
                            <div class="detail-label">Guest Name</div>
                            <div class="detail-value"><?php echo $guest_name; ?></div>
                        </div>
                        
                        <div class="profile-detail">
                            <div class="detail-label">Legal Name</div>
                              <div class="detail-value"><?php echo $fname; ?> <?php echo $lname; ?></div>
                        </div>
                        
                        <div class="profile-detail">
                            <div class="detail-label">Email Address</div>
                            <div class="detail-value">
                                <?php echo $email; ?>
                                <span class="verified-badge"><i class="fas fa-check-circle"></i> Verified</span>
                            </div>
                        </div>
                        
                        <div class="profile-detail">
                            <div class="detail-label">Phone Number</div>
                            <div class="detail-value">
                               <?php echo $phone; ?>
                                <span class="verify-badge"><i class="fas fa-shield-alt"></i> Verify Now</span>
                            </div>
                        </div>
                        
                      <div class="profile-detail">
    <div class="detail-label">Address</div>
    <div class="detail-value"> 
        <?php
            $addressParts = [];

            if (!empty($apt)) $addressParts[] = htmlspecialchars($apt);
            if (!empty($street)) $addressParts[] = htmlspecialchars($street);
            if (!empty($city)) $addressParts[] = htmlspecialchars($city);
            if (!empty($province)) $addressParts[] = htmlspecialchars($province);
            if (!empty($code)) $addressParts[] = htmlspecialchars($code);

            echo implode(', ', $addressParts);
        ?>
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


  </script>
</body>
</html>