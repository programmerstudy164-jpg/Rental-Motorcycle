<?php
session_start();


header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");


if (isset($_SESSION['role']) && ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'staff')) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RM Rental</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
    <body>
        <?php
        include "Includes/header.php";
        ?>


<section class="container-fluid box-con" style="display: flex; align-items: center; justify-content: space-between; padding: 100px;">
    <!-- Image sa kaliwa -->
    <div style="flex: 1; margin-right: 50px;">
        <img src="Pictures/image (3).png" alt="Shop Image" style="width: 100%; max-width: 600px; height: auto; ">
    </div>

    <!-- Shop details sa kanan -->
    <div style="flex: 1;">
        <h2 style="font-size: 3.5rem; color:rgb(37, 204, 87); margin-bottom: 15px; font-weight: 700;">RM Rental</h2>
        <p style="font-size: 1.2rem; color: #7f8c8d; margin-bottom: 25px; font-style: italic;">
            "Your One-Stop Shop for Quality and Style"
        </p>
        <a href="Our_rental.php" style="text-decoration: none;">
    <button style="padding: 12px 30px; background-color: #e74c3c; color: white; border: none; border-radius: 5px; font-size: 1.1rem; cursor: pointer; transition: all 0.3s ease;">
        Book Now
    </button>
</a>

   
    </div>
</section>





<section class="container-fluid mt-5">
    
    <div class="container text-center p-5  reasons ">
        <h2 class="text-success">Why Customers Trust RM-Rental</h2>
        <p class="text-muted">Discover why so many riders choose us!</p>

        <div class="row mt-5">
            <div class="col-md-4 mb-4" data-aos="zoom-in">
                <div class="icon-circle" >
                    <i class="fas fa-tags"></i>
                </div>
                <h4 class="mt-3">Best Price Guarantee</h4>
                <p>Found a lower price elsewhere? Show us, and we’ll help you get the best deal!</p>
            </div>

            <div class="col-md-4 mb-4" data-aos="zoom-in">
                <div class="icon-circle" >
                    <i class="fas fa-handshake"></i>
                </div>
                <h4 class="mt-3">Reliable Service</h4>
                <p>Our motorcycles are always well-maintained, and our team is ready to assist you anytime.</p>
            </div>

            <div class="col-md-4 mb-4" data-aos="zoom-in">
                <div class="icon-circle">
                    <i class="fas fa-thumbs-up"></i>
                </div>
                <h4 class="mt-3">Satisfaction Guaranteed</h4>
                <p>Not happy with your ride? Switch to another unit during your rental period at no extra cost.</p>
            </div>

            <div class="col-md-4 mb-4" data-aos="zoom-in" data-aos-delay="200">
                <div class="icon-circle">
                    <i class="fas fa-calendar-times"></i>
                </div>
                <h4 class="mt-3">Easy Cancellations</h4>
                <p>Plans changed? Cancel your booking hassle-free!</p>
            </div>

            <div class="col-md-4 mb-4" data-aos="zoom-in" data-aos-delay="200">
                <div class="icon-circle">
                    <i class="fas fa-motorcycle"></i>
                </div>
                <h4 class="mt-3">Wide Selection of Motorcycles</h4>
                <p>Choose the perfect motorcycle for your adventure, from city rides to off-road explorations.</p>
            </div>

            <div class="col-md-4 mb-4" data-aos="zoom-in" data-aos-delay="200">
                <div class="icon-circle">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h4 class="mt-3">Safety First</h4>
                <p>All rentals come with free helmets and safety checks for your protection.</p>
            </div>
        </div>

    </div>
</section>

 
<?php include "Includes/footer.php";?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="Js/script.js"></script>

 

</body>

</html>
