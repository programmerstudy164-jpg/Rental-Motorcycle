<?php

include "Includes/data_display.php";

session_start();


if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Complete Dashboard with Profile Dropdown</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
  <link rel="stylesheet" href="css/admin.css">
  <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
      <link rel="stylesheet" href="css/banner.css">
</head>
<body>
    <?php include 'Includes/header.php';?>
 <div class="sidebar-overlay" id="sidebarOverlay"></div>
<div class="dashboard">
   
  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <div class="sidebar-header">
      <h1>RM Rental</h1>
      <p class="text-capitalize"><?php echo $_SESSION['role'] ?></p>
    </div>

    <div class="sidebar-menu">

      <ul>
        <li class="menu-item">
          <a href="profile.php" class="active">
            <i class="fas fa-tachometer-alt"></i>
           Profile Setting
          </a>
        </li>

         <li class="menu-item">
          <a href="Update_pass.php" class="active">
            <i class="fas fa-tachometer-alt"></i>
           Update Password
          </a>
        </li>

          <li class="menu-item">
          <a href="my_booking.php" class="active">
            <i class="fas fa-tachometer-alt"></i>
          My Booking
          </a>
        </li>
       
       
      
      
      </ul>
    </div>
  </div>

  <!-- Topbar -->
    <div class="topbar" id="topbar" style="">
    <button class="btn" id="toggleSidebar">
      <i class="fas fa-bars"></i>
       
    </button>
  <div class="container text-center">
            <h1 class="hero-title" data-aos="fade-up">Our Rental Fleet</h1>
        </div>
  </div>

  <!-- Main Content -->
<div class="main-content">
    <div class="dashboard-content">
       
   
            <div class="container">
                <div class="profile-card">
                    <div class="profile-header ">
                        <div class="d-flex align-items-center">
                            <div class="profile-icon">R</div>
                            <div class="profile-info">
                                <div class="profile-name"> <?php echo htmlspecialchars($username); ?></div>
                                <div class="profile-email"><?php echo htmlspecialchars($email); ?></div>
                            </div>
                        </div>
                        <button class="btn btn-outline-light edit-btn" onclick="location.href='edit_profile.php';">
                            <i class="fas fa-edit"></i> Edit Profile
                        </button>
                    </div>
                    
                    <div class="profile-body">

                    

                        <div class="profile-detail">
                            <div class="detail-label">Guest Name</div>
                            <div class="detail-value"><?php echo htmlspecialchars($username); ?></div>
                        </div>
                        
                        <div class="profile-detail">
                            <div class="detail-label">Legal Name</div>
                              <div class="detail-value"><?php echo htmlspecialchars($fname); ?> <?php echo htmlspecialchars($lname); ?></div>
                        </div>
                        
                        <div class="profile-detail">
                            <div class="detail-label">Email Address</div>
                            <div class="detail-value">
                                <?php echo htmlspecialchars($email); ?>
                                <span class="verified-badge"><i class="fas fa-check-circle"></i> Verified</span>
                            </div>
                        </div>
                        
                        <div class="profile-detail">
                            <div class="detail-label">Phone Number</div>
                            <div class="detail-value">
                                <?php echo htmlspecialchars($phoneNum); ?>
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
</div>

<!-- Required JavaScript files for Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
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