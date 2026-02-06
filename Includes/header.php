<?php

 
include "data_display.php";

?>

  

<nav class="custom-navbar navbar navbar-expand-lg navbar-light fixed-top">

    <div class="container">
        <a class="navbar-brand" data-aos="fade-down" href="index.php">RM Rental<span>.</span></a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMenu" 
        aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>


        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="custom-navbar-nav navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Our_rental.php">Our Rental</a>
                </li>
               
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact Us</a>
                </li>
            </ul>

                                                     

    <?php if (!isset($_SESSION['email'])):  ?>
        
    
           
     <div class="navbar text-center">
    <button class="login-btn" onclick="window.location.href='login.php'">Sign in</button>
</div>
     

   <?php else: ?>
   
      <div class="user-actions-container">
  <div class="dropdown ml-2">
    <button class="btn btn-outline-light btn-sm dropdown-toggle w-100 d-flex align-items-center justify-content-start" id="userDropdown" data-toggle="dropdown">
      <i class="fas fa-user mr-2"></i>
      <span class="mr-1">Hi!</span>
      <strong> <?php echo htmlspecialchars($username); ?></strong>
    </button>

    <div class="dropdown-menu dropdown-menu-right w-100" aria-labelledby="userDropdown">
      <a class="dropdown-item" href="profile.php">Profile Setting</a>
      <a class="dropdown-item" href="Update_Pass.php">Update Password</a>
      <a class="dropdown-item" href="my_booking.php">My Booking</a>
      
      <div class="dropdown-divider"></div>
      <a class="dropdown-item text-danger" href="Includes/signout.php">Sign Out</a>
    </div>
  </div>
</div>

   


  <?php endif; ?>

        </div>
    </div>
</nav>





  

