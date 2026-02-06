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
  <title>Edit Profile</title>
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
          <a href="profile.php" class="active">
           <i class="fas fa-user-cog"></i>
           Profile Setting
          </a>
        </li>

         <li class="menu-item">
          <a href="Update_pass.php">
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
            <h1 class="hero-title" data-aos="fade-up">Edit Profile</h1>
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
        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-9">

                <div class="card registration-card ">
                    

                    <div class="card-body ">

                        <form method="POST" action="Includes/edit_information.php" enctype="multipart/form-data">
                           
                            <h5 class="section-title " style="color: #3b5d50;">Personal Information</h5>

                              <div class="row">

                                 <div class="col-md-6">
                                    <div class="floating-label">
                                        <input type="text" name="fname" class="form-control" id="FirstName" placeholder=" " value="<?php echo htmlspecialchars($fname); ?>">
                                        <label for="FirstName">First Name</label>
                                    </div>
                                </div>
                                
                                 <div class="col-md-6">
                                    <div class="floating-label">
                                        <input type="text" name="lname" class="form-control" id="lastName" placeholder=" " value="<?php echo htmlspecialchars($lname); ?>">
                                        <label for="lastName">Last Name</label>
                                    </div>
                                </div>
                                  </div>
                            
                            <div class="row">

                                  <div class="col-md-6">
                                    <div class="floating-label">
                                        <input type="tel" name="name" class="form-control" id="Name" placeholder=" "value="<?php echo htmlspecialchars($guest_name); ?>">
                                        <label for="Name">Guest Name</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="floating-label">
                                        <input type="tel" name="Pnumbers"  class="form-control" id="EmailAddress" placeholder=" " value="<?php echo htmlspecialchars($phone); ?>">
                                        <label for="EmailAddress">Phone Numbers</label>
                                    </div>
                                </div>
                            </div>

                            
                           <div class="row">
                              <div class="col-md-5 ml-4 mt-3">
                                    <div class="custom-file">
                                        <input type="file" name="profile_image" class="custom-file-input" id="vehicleImage" accept="image/*">
                                        <label class="custom-file-label" for="vehicleImage">Choose Profile image...</label>
                                    </div>
                                </div>

                                
                               </div> 

                              
                            
                             
                            
                            
                            <h5 class="section-title mt-4" style="color: #3b5d50;">Address Information</h5>
                          
                                
                              
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="floating-label">
                                        <input type="text" name="city" class="form-control" id="city" placeholder=" ">
                                        <label for="city">City</label>
                                    </div>
                                </div>
                            
<?php
$selectedProvince = $province ?? '';
?>
<div class="col-md-6">
    <div class="floating-select">
        <select class="custom-select" name="province" id="province">
            <option value="" <?= $selectedProvince == '' ? 'selected' : '' ?>></option>
            <?php
            $provinces = [
                "Abra", "Agusan del Norte", "Agusan del Sur", "Aklan", "Albay", "Antique", "Apayao", "Aurora", "Basilan",
                "Bataan", "Batanes", "Batangas", "Benguet", "Biliran", "Bohol", "Bukidnon", "Bulacan", "Cagayan",
                "Camarines Norte", "Camarines Sur", "Camiguin", "Capiz", "Catanduanes", "Cavite", "Cebu", "Cotabato",
                "Davao de Oro", "Davao del Norte", "Davao del Sur", "Davao Occidental", "Davao Oriental", "Dinagat Islands",
                "Eastern Samar", "Guimaras", "Ifugao", "Ilocos Norte", "Ilocos Sur", "Iloilo", "Isabela", "Kalinga",
                "La Union", "Laguna", "Lanao del Norte", "Lanao del Sur", "Leyte", "Maguindanao", "Marinduque", "Masbate",
                "Metro Manila", "Misamis Occidental", "Misamis Oriental", "Mountain Province", "Negros Occidental",
                "Negros Oriental", "Northern Samar", "Nueva Ecija", "Nueva Vizcaya", "Occidental Mindoro",
                "Oriental Mindoro", "Palawan", "Pampanga", "Pangasinan", "Quezon", "Quirino", "Rizal", "Romblon", "Samar",
                "Sarangani", "Siquijor", "Sorsogon", "South Cotabato", "Southern Leyte", "Sultan Kudarat", "Sulu",
                "Surigao del Norte", "Surigao del Sur", "Tarlac", "Tawi-Tawi", "Zambales", "Zamboanga del Norte",
                "Zamboanga del Sur", "Zamboanga Sibugay"
            ];

            foreach ($provinces as $prov) {
                $isSelected = ($selectedProvince == $prov) ? 'selected' : '';
                echo "<option value=\"$prov\" $isSelected>$prov</option>";
            }
            ?>
        </select>
        <label for="province">Province</label>
    </div>
    </div>
    </div>


                             
                            
                            
                            <div class="text-center mt-4">
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