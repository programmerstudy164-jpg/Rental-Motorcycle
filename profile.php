<?php
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
  <title>Profile Setting</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
  <link rel="stylesheet" href="css/admin.css">
  <link rel="stylesheet" href="css/style.css">
    
     
</head>
<style>
body {
  margin: 0;
  padding: 0;
  font-family: Arial, sans-serif;
}

.row_center {
  background-image: url("Pictures/road-7525091.jpg");
  background-size: cover;
  background-position: center;
}

.banner {
  position: relative;
  width: 100%;
  height: 200px;
  background-color: #3b5d50;
  margin-top: 25px;
  padding-top: 70px;
}

.overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
}

.content {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: white;
  text-align: center;
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
<body>
    <?php include 'Includes/header.php';?>
 <div class="sidebar-overlay" id="sidebarOverlay"></div>
<div class="dashboard">
   
  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <div class="sidebar-header">
     
    
    </div>

    <div class="sidebar-menu">

      <ul>
       <li class="menu-item">
          <a class="menu-toggle" data-toggle="collapse" href="#brandsMenu" role="button" aria-expanded="false">
            <div><i class="fas fa-user-cog"></i>
Profile Setting</div>

            <span class="caret"><i class="fas fa-angle-right"></i></span>
          </a>
          
          <div class="sub-menu collapse" id="brandsMenu">
            <a href="edit_profile.php" class="sub-item">Edit Profile</a>
         
          </div>
        </li>

         <li class="menu-item">
          <a href="Update_Pass.php">
           <i class="fas fa-key"></i>

           Update Password
          </a>
        </li>

          <li class="menu-item">
          <a href="my_booking.php">
           <i class="fas fa-calendar-check"></i>

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
            <h1 class="hero-title" data-aos="fade-up">Profile</h1>
        </div>
  </div>
<?php
$email = $_SESSION['email'];
  
   include 'Includes/db.php';
   
    $sql = "SELECT * FROM user WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $guest_name = $row['username'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    $email = $row['email'];
    $phone = $row['phoneNum'];
    $image = $row['image']; 
} else {
    echo "Profile not found.";
}
?>

  <!-- Main Content -->
<div class="main-content">
    <div class="dashboard-content">
       
   
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

           
            if (!empty($city)) $addressParts[] = htmlspecialchars($city);
            if (!empty($province)) $addressParts[] = htmlspecialchars($province);
           

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