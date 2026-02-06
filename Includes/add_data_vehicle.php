<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $vehicle_title = $_POST['vehicle_title'];
    $brand = $_POST['brand'];
    $price_per_day = $_POST['price_per_day'];
    $transmission = $_POST['transmission'];
    $model_year = $_POST['model_year'];
    $displacement = $_POST['displacement'];

    $image = $_FILES['vehicle_image'];
    $default_image = "Pictures/default_vehicle.png.jpg";

    if (isset($image) && $image["error"] == 0) {
        
        $upload_folder = "../Pictures/"; 
        $image_name = basename($image["name"]);
        $target_file = $upload_folder . $image_name;

        $image_path = "Pictures/" . $image_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($image["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            exit;
        }

        if ($image["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            exit;
        }

        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
            echo "Sorry, only JPG, JPEG, PNG files are allowed.";
            exit;
        }

        if (move_uploaded_file($image["tmp_name"], $target_file)) {
           
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit;
        }
    } else {
        $image_path = $default_image;
    }

    // Check user role
    $user_id = $_SESSION['user_id'];
    $query = "SELECT role FROM user WHERE user_id = $user_id";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
    $status = ($user['role'] === 'staff') ? 'Pending' : 'Approved'; // Staff = Pending, Admin = Approved

    // Insert motorcycle data
    $query = "INSERT INTO motorcycle (Vehicle, Price_Per_Day, Transmission, Model_Year, Displacement, image, brand_id, user_id, status)
              VALUES ('$vehicle_title','$price_per_day', '$transmission', '$model_year', '$displacement', '$image_path','$brand', '$user_id', '$status')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Motorcycle added successfully!.'); window.location.href='../view_vehicle.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
