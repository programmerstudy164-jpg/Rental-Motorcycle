<?php
session_start();


if (isset($_SESSION['role']) && ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'staff')) {
    header("Location: dashboard.php");
    exit();
}

if (!isset($_SESSION['email']) && isset($row['id_moto'])) {
    $_SESSION['redirect_to'] = "booking_bike.php?id=" . $row['id_moto'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motorcycle Rental</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    
      <link rel="stylesheet" href="css/card-layout.css">
       <link rel="stylesheet" href="css/footer.css">
   
</head>
<body>
    <?php include 'Includes/header.php';?>

    <!-- Hero Section -->
    <section class="hero-section"> 
    <div class="container text-center">
        <h1 class="hero-title" data-aos="fade-up">Our Rental Fleet</h1>
    </div>
</section>

<!-- SEARCH SECTION -->
<section class="search-section" data-aos="fade-up" data-aos-delay="200">
    <div class="search-container">
        <div class="search-box">
            <input type="text" id="searchInput" class="search-input" placeholder="Search motorcycles by brand, model, or type...">
          
        </div>
        <div class="filter-options">
            <button class="filter-btn active">All</button>
            <button class="filter-btn">Honda</button>
            <button class="filter-btn">Yamaha</button>
            <button class="filter-btn">Suzuki</button>
            <button class="filter-btn">Kawasaki</button>
            <button class="filter-btn">Automatic</button>
            <button class="filter-btn">Manual</button>
           
        </div>
    </div>
</section>

<!-- MOTORCYCLE GRID SECTION -->
<section class="motorcycle-grid">
    <div class="grid-container">

        <?php
        include 'Includes/db.php';
        date_default_timezone_set('Asia/Manila'); // optional but recommended

        // Only select motorcycles with status = 'Approved'
        $query = "SELECT * FROM motorcycle WHERE status = 'Approved'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $brand_id = $row['brand_id'];
                $brand_query = "SELECT Vehicle_brand FROM brand WHERE brand_id = '$brand_id'";
                $brand_result = mysqli_query($conn, $brand_query);
                $brand = mysqli_fetch_assoc($brand_result);
                $brand_name = $brand ? $brand['Vehicle_brand'] : 'Unknown';

                $id_moto = $row['id_moto'];
                $now = date('Y-m-d H:i:s');

              
                $availability_query = "
                    SELECT * FROM rentals 
                    WHERE id_moto = $id_moto 
                    AND status = 'Approved' 
                    AND (
                        ('$now' BETWEEN pickup_datetime AND return_datetime)
                        OR pickup_datetime > '$now'
                    )
                    LIMIT 1
                ";
                $availability_result = mysqli_query($conn, $availability_query);
                $is_available = mysqli_num_rows($availability_result) == 0;
        ?>

        <div class="motorcycle-card text-capitalize" brand="<?= htmlspecialchars($brand_name) ?>" data-aos="fade-up">
            <div class="img-container">
                <?php if (!empty($row['image'])): ?>
                    <img src="<?= htmlspecialchars($row['image']) ?>" alt="Motor Image">
                <?php else: ?>
                    <img src="Pictures/default_vehicle.png.jpg" alt="No Image">
                <?php endif; ?>
            </div>
            <div class="content">
                <h2><?= htmlspecialchars($brand_name) ?></h2>
                <div class="model"><?= htmlspecialchars($row['Vehicle']) ?></div>
                <div class="transmition">
                    <?= htmlspecialchars($row['Transmission']) ?>
                    <span style="margin: 0 5px;">| <?= htmlspecialchars($row['Displacement']) ?> CC</span>
                    <span>| <?= htmlspecialchars($row['Model_Year']) ?></span>
                </div>
                <div class="price">₱ <?= htmlspecialchars($row['Price_Per_Day']) ?></div>

                <?php if ($is_available): ?>
                    <?php if (!isset($_SESSION['email'])): ?>
                        <a href="login.php?redirect_to=booking_bike.php?id=<?= $id_moto ?>">
                            <button class="btn">Book Now</button>
                        </a>
                    <?php else: ?>
                        <a href="booking_bike.php?id=<?= $id_moto ?>">
                            <button class="btn">Book Now</button>
                        </a>
                    <?php endif; ?>
                <?php else: ?>
                    <button class="btn" disabled style="background-color: gray; cursor: not-allowed;">Not Available</button>
                <?php endif; ?>
            </div>
        </div>

        <?php
            }
        } else {
            echo '<div class="text-center text-muted py-5">No motorcycles found in database.</div>';
        }
        ?>

    
    </div>
        <div id="noResults" class="text-center text-muted py-4" style="display: none; margin:auto;">
            <i class="fas fa-motorcycle fa-3x mb-2"></i>
            <h5>No motorcycles found</h5>
            <p>Try adjusting your search or filter options.</p>
        </div>
</section>



    <?php include "Includes/footer.php";?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="Js/script.js"></script>
    
    <script>
        // Initialize AOS animation
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });

        // Search functionality
        $(document).ready(function() {
            // Filter buttons
            $('.filter-btn').click(function() {
                $('.filter-btn').removeClass('active');
                $(this).addClass('active');
                
            });
            
            // Search functionality
            $('.search-btn').click(function() {
                performSearch();
            });
            
            $('.search-input').keypress(function(e) {
                if(e.which == 13) { // Enter key
                    performSearch();
                }
            });
            
            function performSearch() {
                const searchTerm = $('.search-input').val().toLowerCase();
                // Here you would implement the actual search logic
                console.log("Searching for:", searchTerm);
            }
        });

        document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById("searchInput");
    const filterButtons = document.querySelectorAll(".filter-btn");
    const cards = document.querySelectorAll(".motorcycle-card");
    const noResults = document.getElementById("noResults");

    const normalize = str => str.toLowerCase().replace(/[^\w\s]/gi, "");

    function filterCards() {
        const keyword = normalize(searchInput.value);
        const activeFilter = document.querySelector(".filter-btn.active")?.textContent.toLowerCase();

        let anyVisible = false;

        cards.forEach(card => {
            const brand = normalize(card.getAttribute("brand"));
            const model = normalize(card.querySelector(".model")?.textContent || '');
            const transmission = normalize(card.querySelector(".transmition")?.textContent || '');
            const priceText = normalize(card.querySelector(".price")?.textContent || '0');
            const price = parseFloat(priceText.replace(/[^\d.]/g, ""));

            const matchesKeyword = brand.includes(keyword) || model.includes(keyword) || transmission.includes(keyword);

            let matchesFilter = true;

            if (activeFilter && activeFilter !== "all") {
                if (activeFilter.includes("under")) {
                    matchesFilter = price < 20000;
                } else {
                    matchesFilter = brand.includes(activeFilter) || transmission.includes(activeFilter);
                }
            }

            const showCard = matchesKeyword && matchesFilter;
            card.style.display = showCard ? "" : "none";

            if (showCard) anyVisible = true;
        });

        noResults.style.display = anyVisible ? "none" : "block";
    }

    searchInput.addEventListener("input", filterCards);

    filterButtons.forEach(btn => {
        btn.addEventListener("click", () => {
            filterButtons.forEach(b => b.classList.remove("active"));
            btn.classList.add("active");
            filterCards();
        });
    });
});
    </script>
</body>
</html>