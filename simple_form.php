<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
</head>
    <style>
      
          .step-nav {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            position: relative;
              margin-top: 150px;
        }
        .step-nav:before {
            content: '';
            position: absolute;
            top: 27px;
            left: 0;
            right: 0;
            height: 2px;
            background-color:rgb(22, 53, 84);
            z-index: 1;
        }
        .step-item {
            text-align: center;
            position: relative;
            z-index: 2;
            flex: 1;
            max-width: 16%;
        }
        .step-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #dee2e6;
            color: #6c757d;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 5px;
            font-weight: bold;
            font-size: 14px;
        }
        .step-label {
            font-size: 12px;
            color: #6c757d;
        }
        .active-step .step-circle {
            background-color: #007bff;
            color: white;
        }
        .active-step .step-label {
            color: #007bff;
            font-weight: bold;
        }
        
        .info-card {
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 12px;
            margin-bottom: 15px;
        }
        .info-title {
            font-weight: bold;
            margin-bottom: 12px;
            font-size: 16px;
        }
        .info-item {
            margin-bottom: 8px;
            font-size: 14px;
        }
        .info-label {
            font-weight: bold;
            color: #6c757d;
            font-size: 13px;
        }
        .time-option {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
            font-size: 14px;
        }
        .btn-next {
            background-color: #007bff;
            color: white;
            padding: 8px 25px;
            font-weight: bold;
            margin-top: 15px;
            font-size: 14px;
        }

       /*table*/
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
.floating-labels label{
  position: absolute;
  top: 15px;
  left: 25px;
  background-color: white;
  transition: all 0.3s ease;
  pointer-events: none;
    top: -12px;
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

    </style>
<body>
     <?php
 include "Includes/header.php";
 ?>
     <div class="container py-3" style="max-width: 1000px;">
        <div class="row">
            <div class="col-12">
                <!-- Step Navigation -->
                <div class="step-nav">
                    <div class="step-item active-step">
                        <div class="step-circle">1</div>
                        <div class="step-label">Dates</div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-circle">2</div>
                        <div class="step-label">Extras</div>
                    </div>
                    <div class="step-item">
                        <div class="step-circle">3</div>
                        <div class="step-label">Customer</div>
                    </div>
                    <div class="step-item">
                        <div class="step-circle">4</div>
                        <div class="step-label">Confirm</div>
                    </div>
                    <div class="step-item">
                        <div class="step-circle">5</div>
                        <div class="step-label">Payments</div>
                    </div>
                </div>

             
            
                <div class="info-card">
                      <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-9">

                <div class="card registration-card ">
                    

                    <div class="card-body ">

                        <form method="POST" action="">
                           
                            <h5 class="section-title " style="color: #3b5d50;">Reservation Dates & Time:</h5>

                              <div class="row">

                                 <div class="col-md-6">
                                    <div class="floating-labels">
                                       <label for="startDate" class="fw-bold" >Pickup Date & Time</label>
                            <input type="datetime-local" id="startDate" class="form-control">
                                    </div>
                                </div>
                                
                                 <div class="col-md-6">
                                    <div class="floating-labels">
                                     <label for="startDate" class="fw-bold">Return Date & Time</label>
                            <input type="datetime-local" id="startDate" class="form-control">
                                    </div>
                                </div>
                                  </div>

                              <h5 class="section-title mt-3" style="color: #3b5d50;">Reservation Location:</h5>

                            <div class="row">

                                  <div class="col-md-6">
                                    <div class="floating-labels">
                                       <select class="form-control" name="province" id="Location" placeholder=" ">
                                          <option value=""></option>
                                            </select>
                                        <label for="Location">Pickup Location</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="floating-labels">
                                       <select class="form-control" name="province" id="Location" placeholder=" ">
                                          <option value=""></option>
                                            </select>
                                        <label for="Location">Return Location</label>
                                    </div>
                                </div>
                            </div>

         
                         <div class="text-center mt-4">
  <a href="booking_bike.php" class="btn btn-primary px-5" style="background-color: #3b5d50;">
    <i class="fas fa-paper-plane mr-2"></i> Next Step
  </a>
</div>

                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

                </div>

             
</body>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="Js/script.js"></script>
</html>