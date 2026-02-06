<?php
 include 'Includes/db.php'; 
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit;
}

$email = mysqli_real_escape_string($conn, $_SESSION['email']);
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


/* Main Content Styles */
.content-area {
    padding: 40px;
    flex: 1;
    background-color: #f8f9fa;
    min-height: 100vh;
    margin-top: 150px; 
}
.content-header {
    margin-bottom: 30px;
}

.content-header h1 {
    font-size: 28px;
    color: #2d3142;
    font-weight: 700;
    border-left: 5px solid #00adb5;
    padding-left: 15px;
}

:root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --accent-color: #3b82f6;
            --text-color: #1f2937;
            --light-text: #6b7280;
            --bg-color: #f9fafb;
            --sidebar-bg: #ffffff;
            --card-bg: #ffffff;
            --border-color: #e5e7eb;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --pending-color: #f59e0b;
            --cancelled-color:rgb(248, 23, 23);
            --confirmed-color:rgb(31, 232, 34);
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
        }

      

        /* Main Content Styles */
        .main-content {
            margin-left: 250px;
            min-height: 100vh;
        }

        /* Top Bar Styles */
        .top-bar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Card Badges */
        .card-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            color: white;
            text-transform: capitalize;
        }

        .card-badge[data-status="pending"] {
            background-color: var(--pending-color);
        }

        .card-badge[data-status="approved"] {
            background-color: var(--confirmed-color);
        }

        .card-badge[data-status="cancelled"] {
            background-color: var( --text-color);
        }
        .card-badge[data-status="declined"] {
            background-color: var(--cancelled-color);
        }

        /* Motorcycle Card Styles */
        .motorcycle-card {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .motorcycle-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .card-image {
            height: 200px;
            overflow: hidden;
        }

        .card-image img {
            transition: transform 0.5s;
        }

        .motorcycle-card:hover .card-image img {
            transform: scale(1.05);
        }

        .brand-model h3 {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .brand-model p {
            font-size: 0.9rem;
            color: var(--light-text);
        }

        .price {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--primary-color);
        }

        .detail-label {
            font-size: 0.8rem;
            color: var(--light-text);
        }

        .detail-value {
            font-size: 0.9rem;
            font-weight: 500;
        }

        .total-label {
            font-size: 1rem;
            font-weight: 600;
        }

        .total-value {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primary-color);
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
          <a href="profile.php">
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

          <li class="menu-item" class="active">
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
            <h1 class="hero-title" data-aos="fade-up">My Booking</h1>
        </div>
  </div>

   <!-- Main Content -->
   <div class="main-content w-100">
            <!-- Top Bar -->
          
            <!-- Content Area -->
            <div class="container-fluid">
           
                
                <div class="dashboard-content">
                    <div class="row motorcycle-cards">
                    <?php
                    include 'Includes/db.php';
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    if (!isset($_SESSION['email'])) {
                        die("Email session is not set.");
                    }

                    $email = mysqli_real_escape_string($conn, $_SESSION['email']);

                    $userQuery = "SELECT user_id FROM user WHERE email = '$email'";
                    $userResult = mysqli_query($conn, $userQuery);

                    $rentalFound = false;

                    if ($userResult && mysqli_num_rows($userResult) > 0) {
                        $userData = mysqli_fetch_assoc($userResult);
                        $user_id = $userData['user_id'];

                        $rentalQuery = "SELECT * FROM rentals WHERE user_id = '$user_id'";
                        $rentalResult = mysqli_query($conn, $rentalQuery);

                        if ($rentalResult && mysqli_num_rows($rentalResult) > 0) {
                            $rentalFound = true;
                            
                            while ($rental = mysqli_fetch_assoc($rentalResult)) {
                                $rental_id = $rental['rental_id'];
                                $id_moto = $rental['id_moto'];
                                $status = strtolower($rental['status']);

                                // Handle cancellation if submitted
                                if (isset($_POST['cancel_rental']) && $_POST['rental_id'] == $rental_id) {
                                    $cancelQuery = "UPDATE rentals SET status = 'cancelled' WHERE rental_id = '$rental_id' AND user_id = '$user_id'";
                                    
                                    if (mysqli_query($conn, $cancelQuery)) {
                                        echo "<script>alert('Rental has been successfully cancelled.');</script>";
                                        $status = 'cancelled';
                                    } else {
                                        $error = mysqli_error($conn);
                                        echo "<script>alert('Error cancelling rental: $error');</script>";
                                    }
                                }

                                $motoQuery = "SELECT * FROM motorcycle WHERE id_moto = '$id_moto'";
                                $motoResult = mysqli_query($conn, $motoQuery);
                                $motoData = mysqli_fetch_assoc($motoResult);

                                $motoImage = $motoData['image'];
                                $vehicle = $motoData['Vehicle'];
                                $transmission = $motoData['Transmission'];
                                $model = $motoData['Model_Year'];
                                $displacement = $motoData['Displacement'];
                                $brand_id = $motoData['brand_id'];
                                $price = $motoData['Price_Per_Day'];

                                $brandQuery = "SELECT Vehicle_brand FROM brand WHERE brand_id = '$brand_id'";
                                $brandResult = mysqli_query($conn, $brandQuery);
                                $brandData = mysqli_fetch_assoc($brandResult);
                                $motoBrand = $brandData['Vehicle_brand'];

                                $summaryQuery = "SELECT * FROM summary WHERE rental_id = '$rental_id'";
                                $summaryResult = mysqli_query($conn, $summaryQuery);
                                $summary = mysqli_fetch_assoc($summaryResult);
                    ?>
                    
                    <!-- Motorcycle Card -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card motorcycle-card h-100">
                            <div class="card-image position-relative">
                                <?php if ($motoImage): ?>
                                    <img src="<?= $motoImage ?>" class="card-img-top w-100 h-100" alt="<?= $motoBrand ?> <?= $vehicle ?>" style="object-fit: cover;">
                                <?php else: ?>
                                    <img src="images/default-motorcycle.jpg" class="card-img-top w-100 h-100" alt="Motorcycle" style="object-fit: cover;">
                                <?php endif; ?>
                                <div class="card-badge" data-status="<?= $status ?>"><?= ucfirst($status) ?></div>
                            </div>

                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div class="brand-model">
                                        <h5 class="card-title mb-1 text-capitalize"><?= $motoBrand ?> <?= $vehicle ?></h5>
                                        <p class="card-text text-muted small"><?= $model ?> • <?= $displacement ?></p>
                                    </div>
                                    <div class="price">₱<?= $price ?>/day</div>
                                </div>

                                <div class="row card-details">
                                    <div class="col-6 mb-2">
                                        <small class="text-muted d-block detail-label">Transmission</small>
                                        <span class="detail-value"><?= $transmission ?></span>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <small class="text-muted d-block detail-label">Pickup</small>
                                        <span class="detail-value"><?= $rental['pickup_location'] ?></span>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <small class="text-muted d-block detail-label">Return</small>
                                        <span class="detail-value"><?= $rental['return_location'] ?></span>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <small class="text-muted d-block detail-label">Pickup Date</small>
                                        <span class="detail-value"><?= date('M d, Y', strtotime($rental['pickup_datetime'])) ?></span>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <small class="text-muted d-block detail-label">Return Date</small>
                                        <span class="detail-value"><?= date('M d, Y', strtotime($rental['return_datetime'])) ?></span>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <small class="text-muted d-block detail-label">Pickup Time</small>
                                        <span class="detail-value"><?= date('h:i A', strtotime($rental['pickup_datetime'])) ?></span>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <small class="text-muted d-block detail-label">Return Time</small>
                                        <span class="detail-value"><?= date('h:i A', strtotime($rental['return_datetime'])) ?></span>
                                    </div>
                                    <?php if ($summary): ?>
                                        <div class="col-6 mb-2">
                                            <small class="text-muted d-block detail-label">Duration</small>
                                            <span class="detail-value"><?= $summary['duration_days'] ?> days</span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <?php if ($summary): ?>
                                <div class="d-flex justify-content-between align-items-center py-2 border-top border-bottom my-3">
                                    <div class="total-label">Total Cost</div>
                                    <div class="total-value">PHP <?= number_format($summary['total_cost'], 2) ?></div>
                                </div>
                                <?php endif; ?>

                                <?php if ($status == 'pending'): ?>
                                    <form method="POST" action="">
                                        <input type="hidden" name="rental_id" value="<?= $rental_id ?>">
                                        <button type="submit" name="cancel_rental" class="btn btn-danger btn-block" onclick="return confirm('Are you sure you want to cancel this rental?');">
                                            Cancel Rental
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <?php
                            } // end while
                        } 
                    }
                    
                    if (!$rentalFound) {
                    ?>
                        <div class="col-12">
                            <div class="card text-center py-5">
                                <div class="card-body">
                                    <h3 class="card-title">No rentals found</h3>
                                    <p class="card-text text-muted mb-4">You haven't made any motorcycle rentals yet. Explore our collection and book your ride today!</p>
                                    <a href="Our_rental.php" class="btn btn-primary">Browse Motorcycles</a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
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