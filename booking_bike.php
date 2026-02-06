
<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit;
}


if (isset($_SESSION['role']) && ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'staff')) {
    header("Location: dashboard.php");
    exit();
}

include 'Includes/db.php'; 

if (!isset($_SESSION['user_id'])) {
    $_SESSION['redirect_to'] = "booking_bike.php?id=" . $_GET['id'];
    header("Location: login.php");
    exit;
}

$id_moto = isset($_GET['id']) ? intval($_GET['id']) : 0;


$result = $conn->query("SHOW COLUMNS FROM rentals WHERE Field = 'pickup_location'");
$row = $result->fetch_assoc();
preg_match("/^enum\('(.*)'\)$/", $row['Type'], $matches);
$enum_values = explode("','", $matches[1]);

$result1 = $conn->query("SHOW COLUMNS FROM rentals WHERE Field = 'return_location'");
$row1 = $result1->fetch_assoc();
preg_match("/^enum\('(.*)'\)$/", $row1['Type'], $matches1);
$enum_values1 = explode("','", $matches1[1]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motorcycle Rental Booking Form</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">

    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Poppins', sans-serif;
            color: #343a40;
        }
        .header-container {
            background: linear-gradient(135deg, #4CAF50 0%, #2E7D32 100%);
            color: white;
            padding: 20px 0;
            margin-bottom: 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .header-text {
            font-weight: 600;
            text-shadow: 0 1px 2px rgba(0,0,0,0.2);
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            margin-bottom: 25px;
            overflow: hidden;
        }
        .card-header {
            background: linear-gradient(135deg, #4CAF50 0%, #2E7D32 100%);
            color: white;
            border-bottom: none;
            font-weight: 600;
            padding: 15px 20px;
        }
        .card-body {
            padding: 20px;
        }
        .model,.price{
            margin: auto;
        }


        .brand-color {
            color: #2E7D32;
            font-weight: 600;
        }
        .span_text{
             font-size: 16px;
            font-weight: 500;
        }
        .section-title {
            font-weight: 600;
            margin-bottom: 20px;
            color: #2E7D32;
            border-bottom: 2px solid #e0e0e0;
            padding-bottom: 10px;
        }
        .btn-success {
            background: linear-gradient(135deg, #4CAF50 0%, #2E7D32 100%);
            border: none;
            box-shadow: 0 4px 8px rgba(46,125,50,0.3);
            font-weight: 500;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }
        .btn-success:hover {
            background: linear-gradient(135deg, #2E7D32 0%, #1B5E20 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(46,125,50,0.4);
        }
        .icon-circle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 20px;
            width: 20px;
            border-radius: 50%;
            background-color: #2E7D32;
            color: white;
            font-size: 11px;
            margin-left: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        .pricing-badge {
            position: absolute;
            top: 15px;
            left: 0;
            background: linear-gradient(135deg, #f44336 0%, #d32f2f 100%);
            color: white;
            padding: 5px 15px;
            font-size: 13px;
            font-weight: 500;
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .rates-badge {
            position: relative;
            top: -2px;
            margin-left: 5px;
            background-color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #2E7D32;
            font-size: 12px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        .specs-icon {
            width: 36px;
            height: 36px;
            background-color: #f0f2f5;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 5px auto;
            color: #2E7D32;
            font-size: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .specs-text {
            font-size: 14px;
            font-weight: 500;
        }
        .main-container {
            max-width: 1200px;
            padding-bottom: 40px;
        }
        .form-control {
            border-radius: 8px;
            border: 1px solid #d1d9e6;
            padding: 10px 15px;
            height: auto;
            box-shadow: 0 2px 4px rgba(0,0,0,0.03);
        }
        .form-control:focus {
            border-color: #2E7D32;
            box-shadow: 0 0 0 0.2rem rgba(46,125,50,0.25);
        }
        .input-group-text {
            border-radius: 8px;
            background-color: #f8f9fa;
            border: 1px solid #d1d9e6;
        }
        .custom-control-label::before {
            border-radius: 4px;
            border: 1px solid #adb5bd;
        }
        .custom-checkbox .custom-control-input:checked ~ .custom-control-label::before {
            background-color: #2E7D32;
            border-color: #2E7D32;
        }
        .custom-radio .custom-control-input:checked ~ .custom-control-label::before {
            background-color: #2E7D32;
            border-color: #2E7D32;
        }
        .calendar-icon {
            background-color: #e9ecef;
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
        }
        .flag-icon {
            width: 24px;
            height: 16px;
            margin-right: 5px;
        }
        .motorcycle-image {
            transition: transform 0.3s ease;
            max-height: 200px;
        }
        .motorcycle-image:hover {
            transform: scale(1.05);
        }
        .price-tag {
            font-weight: 600;
            font-size: 18px;
            color: #d32f2f;
        }
        .discount-badge {
            background-color: #2E7D32;
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
            margin-left: 10px;
        }
        .summary-row {
            padding: 8px 0;
            border-bottom: 1px solid #e9ecef;
        }
        .summary-row:last-child {
            border-bottom: none;
        }
        .summary-total {
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 8px;
            font-weight: 600;
            margin-top: 10px;
        }
        .custom-control {
            padding-left: 2rem;
        }
        .addon-item {
            border-bottom: 1px solid #f0f0f0;
            padding: 8px 0;
        }
        .addon-item:last-child {
            border-bottom: none;
        }
        .terms-link {
            color: #2E7D32;
            text-decoration: underline;
            font-weight: 500;
        }
        .terms-link:hover {
            color: #1B5E20;
        }
        .section-divider {
            position: relative;
            text-align: center;
            margin: 20px 0;
        }
        .section-divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background-color: #e0e0e0;
            z-index: 1;
        }
        .section-divider span {
            position: relative;
            background-color: white;
            padding: 0 15px;
            z-index: 2;
            color: #6c757d;
            font-size: 14px;
        }
        .contact-method-icon {
            font-size: 18px;
            margin-right: 5px;
            color: #2E7D32;
        }
        @media (max-width: 991.98px) {
            .card {
                margin-bottom: 20px;
            }
        }
 
        
    </style>
</head>
<body>

<?php

 include "Includes/header.php";
 ?>
    <div class="container-fluid header-container">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h4 class="header-text">Start your booking now. Enjoy the uniqueness of our services tailored just for you!</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container main-container">
        <div class="row">
           
            <div class="col-lg-6">
                <h4 class="section-title"><i class="fas fa-motorcycle"></i>
Bike</h4>
                
              <?php
include 'Includes/db.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = "SELECT * FROM motorcycle WHERE id_moto = $id";
$result = $conn->query($query);
?>

<div class="card">
    <div class="card-body text-center position-relative">
        <?php 
        if ($result && $row = $result->fetch_assoc()) {
            $brand_id = $row['brand_id'];
            $brand_query = "SELECT Vehicle_brand FROM brand WHERE brand_id = $brand_id";
            $brand_result = mysqli_query($conn, $brand_query);
            $brand = mysqli_fetch_assoc($brand_result);
        ?>

            <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Motor Image" class="img-fluid mb-4 motorcycle-image">

            <h3 class="brand-color mb-4 text-capitalize">
                <?php echo htmlspecialchars($brand['Vehicle_brand']); ?> 
                <span class="span_text"><?php echo htmlspecialchars($row['Vehicle']); ?></span>
            </h3>

            <div class="row text-center mt-3 mb-3 col-12 model">
                <div class="col-4">
                    <p class="specs-text mb-0"><?php echo htmlspecialchars($row['Transmission']); ?></p>
                </div>
                <div class="col-4">
                    <p class="specs-text mb-0"><?php echo htmlspecialchars($row['Displacement']); ?>CC</p>
                </div>
                <div class="col-4">
                    <p class="specs-text mb-0"><?php echo htmlspecialchars($row['Model_Year']); ?></p>
                </div>
            </div>

           <div class="mt-4 text-center mb-4">
    <div class="price-tag">
        <i class="fas fa-tag mr-2"></i>
        <span id="pricePerDay" data-price="<?php echo htmlspecialchars($row['Price_Per_Day']); ?>">
            <?php echo htmlspecialchars($row['Price_Per_Day']); ?>
        </span><small>/day</small>
    </div>
</div>


        <?php 
        } else {
            echo "<p>Motorcycle not found.</p>";
        }
        ?>
    </div>
</div>
 

<!-- open-->

<!-- close-->
<h4 class="section-title"><i class="fas fa-clipboard-list"></i> Summary</h4>

 <div class="card mt-4">
     <form method="POST" action="Includes/add_booking.php" id="bookingForm">

                                 <input type="hidden" name="id_moto" value="<?= $_GET['id'] ?>">

                  
                                 <div class="card-body">
    <div class="summary-row d-flex justify-content-between">
        <div>
            <i class="fas fa-motorcycle mr-2"></i>Rent (<span id="displayDuration">1d</span>):
            <input type="hidden" name="duration" id="durationInput">
        </div>
        <!-- Make sure this element has data-price -->
        <div id="pricePerDay" data-price="<?php echo htmlspecialchars($row['Price_Per_Day']); ?>">
            ₱<?php echo htmlspecialchars($row['Price_Per_Day']); ?>
        </div>
    </div>

    <div class="summary-total d-flex justify-content-between">
        <div><i class="fas fa-money-bill-wave mr-2"></i>Total Cost (approx.):</div>
        <div class="brand-color">₱<span id="totalCost">0</span></div>
        <input type="hidden" name="totalCostDisplay" id="totalCostInput">
    </div>

<div class="alert alert-light mt-3 mb-0 p-2" role="alert">
    <small><i class="fas fa-info-circle mr-1"></i> Note: Payment is only accepted upon pickup. No online payment available.</small>
</div>

</div>






                </div>


              
            </div>

  <?php
$email = $_SESSION['email'];
include 'Includes/db.php';

$sql = "SELECT * FROM user WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email); 
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $fname = $row['fname'];
    $lname = $row['lname'];
    $email = $row['email'];
    $phone = $row['phoneNum'];
    $city = $row['city'];
} else {
    echo "Profile not found.";
}
?>


            
            <!-- Middle Column - Addons -->
        <div class="col-lg-6">
    <h4 class="section-title"><i class="far fa-calendar-alt mr-2"></i>Schedule</h4>
    <div class="card mt-4 ">
        <div class="card-body">
            <div class="row">
                <!-- Pickup Location -->
                <div class="form-group col-6">
                    <label for="pickupLocation"><i class="fas fa-motorcycle mr-2"></i>Pickup Location</label>
                    <div class="input-group">
                        <input type="hidden" name="id_moto" value="<?= $_GET['id'] ?>">
                        <select required class="form-control" name="pickuplocation" id="pickupLocation" onchange="checkIfCustomPickupSelected()">
                              <option value="">-- Select Pickup Location --</option>
                       
                            <?php
                            foreach ($enum_values as $value) {
                                echo "<option value='$value'>$value</option>";
                            }
                            ?>
                            <option value="custom">Custom Address</option>  
                        </select>
                        <input type="text" id="custompickupLocation" name="custompickup" class="form-control" style="display:none;" placeholder="Enter custom Pickup location" value="<?php echo htmlspecialchars($city); ?>">
                    </div>

                    <div class="custom-control custom-checkbox mb-3 mt-2">
                        <input type="checkbox" class="custom-control-input" id="custompickup" onclick="toggleCustomPickupInput()">
                        <label class="custom-control-label" for="custompickup">
                            Pickup - Custom Address
                        </label>
                    </div>
                </div>


    <div class="form-group col-6">
                    <label for="returnLocation"><i class="fas fa-undo-alt mr-2"></i>Return Location</label>
                    <div class="input-group mb-2">
                        <select class="form-control" name="returnlocation" id="returnLocation" onchange="checkIfCustomReturnSelected()">
                                <option value="">-- Select Return Location --</option>
                            <?php
                            foreach ($enum_values as $value) {
                                echo "<option value='$value'>$value</option>";
                            }
                            ?>
                            <option value="custom">Custom Address</option>  <!-- Added custom option -->
                        </select>
                        <input type="text" id="customReturnLocation" name="customreturn" class="form-control" style="display:none;" placeholder="Enter custom return location" value="<?php echo htmlspecialchars($city); ?>">
                    </div>

                    <div class="custom-control custom-checkbox mb-3 mt-2">
                        <input type="checkbox" class="custom-control-input" id="customReturn" onclick="toggleCustomReturnInput()">
                        <label class="custom-control-label" for="customReturn">
                            Return - Custom Address
                        </label>
                    </div>
                </div>
    
   

                        
<div class="form-group col-6">
    <label for="startDate"><i class="far fa-calendar-plus mr-2"></i>Pickup Date & Time</label>
    <div class="input-group">
        <input type="datetime-local" id="startDate" name="startDate" class="form-control"  onchange="updateReturnDate()">
    </div>
</div>

<div class="form-group col-6">
    <label for="endDate"><i class="far fa-calendar-minus mr-2"></i>Return Date & Time</label>
    <div class="input-group">
        <input type="datetime-local" id="endDate" name="endDate" class="form-control" onchange="calculateDuration()">
    </div>
</div>
<div class="section-divider col-12">
    <span>Duration</span>
</div>
<div class="form-group col-12">
    <label><i class="fas fa-hourglass-half mr-2 mb-3"></i>Actual</label>
    <input type="text" id="duration" name="duration" class="form-control text-center font-weight-bold" readonly>
</div>
</div>
                    </div>
                </div>
                
               <?php
$email = $_SESSION['email'];
  
   include 'Includes/db.php';
   
    $sql = "SELECT * FROM user WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
   
    $fname = $row['fname'];
    $lname = $row['lname'];
    $email = $row['email'];
    $phone = $row['phoneNum'];
    $city = $row['city'];
    
} else {
    echo "Profile not found.";
}
?>
                
<!--open-->
  <h4 class="section-title"><i class="fas fa-user-circle mr-2"></i>Contact Details</h4>
                
                <div class="card">
                     
                    <div class="card-body">
                        <div class="row">
                        <div class="form-group col-6 mt-4">
                            <label for="firstName"><i class="fas fa-user mr-2"></i>First Name</label>
                            <input type="text" class="form-control" name="fn" id="firstName" placeholder=" " required value="<?php echo htmlspecialchars($fname); ?>">
                        </div>
                        
                        <div class="form-group col-6 mt-4">
                            <label for="lastName"><i class="fas fa-user mr-2"></i>Last Name</label>
                            <input type="text" class="form-control" name="ln" id="lastName" placeholder=" "required value="<?php echo htmlspecialchars($lname); ?>">
                        </div>
                        
                        <div class="form-group col-6 mt-4">
                            <label for="licenseType"><i class="fas fa-id-card mr-2"></i>Driver License</label>
                            <div class="input-group">
                                <select class="form-control" id="licenseType" name="dl" required>
                                    <option></option>
                                    <option>Student License</option>
                                    <option>Non-Professional</option>
                                    <option>Professional</option>
                                </select>
                             
                            </div>
                        </div>
                        
                        <div class="form-group col-6 mt-4">
                            <label for="email"><i class="fas fa-envelope mr-2"></i>Email Address</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required value="<?php echo htmlspecialchars($email); ?>">
                        </div>
                        
                        <div class="form-group col-6 mt-4">
                            <label for="phone"><i class="fas fa-phone-alt mr-2"></i>Contact Number</label >
                           
                               
                                 <input type="tel" class="form-control" name="phone" id="phone" placeholder="Contact Number" required value="<?php echo htmlspecialchars($phone); ?>">
                          
                        </div>
                        
                        <div class="section-divider col-12">
                            <span>Contact Preferences</span>
                        </div>
                        
                     
                        
                       <div class="form-group col-11 mx-auto">
    <label for="remarks"><i class="fas fa-sticky-note mr-2"></i>Any remarks or notes?</label>
    <textarea class="form-control" id="remarks" name="remarks" rows="4" placeholder="Add any special requests or questions here..."></textarea>
</div>

                        
                      
                        
<button type="button" class="btn btn-success btn-block btn-lg col-10 mx-auto" onclick="showPaymentAlert(event)">
            <i class="fas fa-check-circle mr-2"></i> Submit Request
        </button>
                          </form>
                        </div>

            </div>

            <!-- Modal Alert for Payment Information -->

            <!-- Right Column - Contact Details -->
            <div class="col-lg-6">
              
                    </div>
                     <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
     <script src="Js/script.js"></script>

</body>
<script>


    function showPaymentAlert(event) {
        event.preventDefault(); // Prevent form from submitting immediately

        // Create the alert message
        var alertMessage = "Kindly note: Payment is only accepted upon pickup. Online payment is not available. We recommend inspecting the unit thoroughly to ensure its condition of the unit before completing the payment.";

        // Show the alert in a modal or simple alert box
        alert(alertMessage);

        // Submit the form after showing the alert
        document.getElementById("bookingForm").submit(); // Replace 'bookingForm' with your form's ID
    }



//custom 

// Function to toggle between the dropdown and custom input for Return Location
// Toggle custom input for Pickup Location based on checkbox
function toggleCustomPickupInput() {
    var checkbox = document.getElementById('custompickup');
    var dropdown = document.getElementById('pickupLocation');
    var customInput = document.getElementById('custompickupLocation');
    
    if (checkbox.checked) {
        dropdown.style.display = 'none';  // Hide the dropdown when the checkbox is checked
        customInput.style.display = 'block';  // Show the custom input
    } else {
        dropdown.style.display = 'block';  // Show the dropdown when the checkbox is unchecked
        customInput.style.display = 'none';  // Hide the custom input
    }
}

// Check if 'custom' is selected in Pickup Location dropdown
function checkIfCustomPickupSelected() {
    var dropdown = document.getElementById('pickupLocation');
    var customInput = document.getElementById('custompickupLocation');

    if (dropdown.value === 'custom') {
        dropdown.style.display = 'none';  // Hide the dropdown if 'custom' is selected
        customInput.style.display = 'block';  // Show the custom input field
    } else {
        dropdown.style.display = 'block';  // Show the dropdown if any other option is selected
        customInput.style.display = 'none';  // Hide the custom input field
    }
}

// Toggle custom input for Return Location based on checkbox
function toggleCustomReturnInput() {
    var checkbox = document.getElementById('customReturn');
    var dropdown = document.getElementById('returnLocation');
    var customInput = document.getElementById('customReturnLocation');
    
    if (checkbox.checked) {
        dropdown.style.display = 'none';  // Hide the dropdown when the checkbox is checked
        customInput.style.display = 'block';  // Show the custom input
    } else {
        dropdown.style.display = 'block';  // Show the dropdown when the checkbox is unchecked
        customInput.style.display = 'none';  // Hide the custom input
    }
}

// Check if 'custom' is selected in Return Location dropdown
function checkIfCustomReturnSelected() {
    var dropdown = document.getElementById('returnLocation');
    var customInput = document.getElementById('customReturnLocation');

    if (dropdown.value === 'custom') {
        dropdown.style.display = 'none';  // Hide the dropdown if 'custom' is selected
        customInput.style.display = 'block';  // Show the custom input field
    } else {
        dropdown.style.display = 'block';  // Show the dropdown if any other option is selected
        customInput.style.display = 'none';  // Hide the custom input field
    }
}


window.onload = function () {
    const pickupInput = document.getElementById("startDate");
    const returnInput = document.getElementById("endDate");

    const currentDate = new Date();
    currentDate.setHours(12, 0, 0, 0); // Set to 12:00 PM

    // Add 1 day to the current date for the pickup date
    currentDate.setDate(currentDate.getDate() + 1); // Add 1 day

    const formattedCurrentDate = formatLocalDateTime(currentDate);
    pickupInput.min = formattedCurrentDate;

    if (!pickupInput.value || new Date(pickupInput.value) < currentDate) {
        pickupInput.value = formattedCurrentDate; 
    }

    const initialPickup = new Date(pickupInput.value);
    const nextValidReturn = getNextValidDate(initialPickup);
    returnInput.min = formatLocalDateTime(nextValidReturn);

    if (!returnInput.value || new Date(returnInput.value) < nextValidReturn) {
        returnInput.value = formatLocalDateTime(nextValidReturn); // Set return date if empty
    }

    function enforceWorkingHours(input) {
        const date = new Date(input.value);
        const hour = date.getHours();
        if (hour < 8 || hour > 18) {
            alert("Time must be between 8:00 AM and 6:00 PM.");
            date.setHours(8, 0, 0, 0);
            input.value = formatLocalDateTime(date);
        }
    }

    pickupInput.addEventListener("change", function () {
        const pickupDate = new Date(pickupInput.value);
        const now = new Date();
        now.setSeconds(0, 0);

        if (pickupDate < now) {
            alert("Pickup must be now or later.");
            pickupInput.value = formattedCurrentDate;
            return;
        }

        enforceWorkingHours(pickupInput);

        let newReturn = getNextValidDate(pickupDate);
        returnInput.min = formatLocalDateTime(newReturn);

        const currentReturn = new Date(returnInput.value);
        if (!isValidDate(currentReturn) || currentReturn <= pickupDate) {
            returnInput.value = formatLocalDateTime(newReturn);
        }

        calculateDurationAndCost();
    });

    returnInput.addEventListener("change", function () {
        const returnDate = new Date(returnInput.value);
        const minDate = new Date(returnInput.min);

        if (returnDate < minDate) {
            alert("Return date must be after pickup.");
            returnInput.value = formatLocalDateTime(minDate);
            return;
        }

        enforceWorkingHours(returnInput);
        calculateDurationAndCost();
    });

    calculateDurationAndCost();

    function getNextValidDate(fromDate) {
        let testDate = new Date(fromDate);
        testDate.setDate(testDate.getDate() + 1);  // Move to the next day after pickup (add 1 day)
        testDate.setHours(12, 0, 0, 0);  // Set to 12:00 PM
        return testDate;
    }

    function isValidDate(date) {
        return true;
    }

    function calculateDurationAndCost() {
        const pickupInput = document.getElementById("startDate");
        const returnInput = document.getElementById("endDate");
        const durationInput = document.getElementById("duration");
        const displayDuration = document.getElementById("displayDuration");
        const totalCost = document.getElementById("totalCost");
        const totalCostInput = document.getElementById("totalCostInput");
        const priceElement = document.getElementById("pricePerDay");
        const pricePerDay = priceElement ? parseFloat(priceElement.dataset.price) : 0;

        const start = new Date(pickupInput.value);
        const end = new Date(returnInput.value);

        if (!isNaN(start) && !isNaN(end)) {
            let days = Math.ceil((end - start) / (1000 * 60 * 60 * 24));
            if (days <= 0) {
                days = 1;
            }

            if (durationInput) durationInput.value = days + " day(s)";
            if (displayDuration) displayDuration.innerText = days + "d";

            const total = days * pricePerDay;
            if (totalCost) totalCost.innerText = total.toFixed(2);
            if (totalCostInput) totalCostInput.value = total.toFixed(2);
        }
    }

    function formatLocalDateTime(date) {
        const year = date.getFullYear();
        const month = (date.getMonth() + 1).toString().padStart(2, "0");
        const day = date.getDate().toString().padStart(2, "0");
        const hours = date.getHours().toString().padStart(2, "0");
        const minutes = date.getMinutes().toString().padStart(2, "0");
        return `${year}-${month}-${day}T${hours}:${minutes}`;
    }
};


document.addEventListener('DOMContentLoaded', function() {
    // Function to update the form values based on selections
    function updateFormValues() {
        // Get the displayed values
        const displayDuration = document.getElementById('displayDuration').textContent;
        const totalCostDisplay = document.getElementById('totalCost').textContent;
        
        // Parse the duration value (convert "1d" to just "1")
        const durationValue = displayDuration.replace('d', '');
        
        // Update hidden inputs
        document.getElementById('durationInput').value = durationValue;
        document.getElementById('totalCostInput').value = totalCostDisplay;
        
        console.log('Updated values:', {
            duration: durationValue,
            totalCost: totalCostDisplay
        });
    }
    
    // Call this function whenever duration or cost changes
    // You'll need to integrate this with your existing date picker or duration selector
    
    // For example, if you have a date picker that changes duration:
    const datePicker = document.querySelector('.date-picker'); // Replace with your actual selector
    if (datePicker) {
        datePicker.addEventListener('change', updateFormValues);
    }
    
    // Also call it before form submission to ensure latest values
    const form = document.querySelector('form'); // Replace with your actual form selector
    if (form) {
        form.addEventListener('submit', function(e) {
            updateFormValues();
            // Form will submit normally after values are updated
        });
    }
    
    // Initialize values on page load
    updateFormValues();
});











</script>
</html>



