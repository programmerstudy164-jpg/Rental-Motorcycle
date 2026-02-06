<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Brand = $_POST['Brand'];

  
    $user_id = $_SESSION['user_id'];
    $query = "SELECT role FROM user WHERE user_id = $user_id";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
    $status = ($user['role'] === 'staff') ? 'Pending' : 'Approved';


    $query = "INSERT INTO brand (Vehicle_brand, added_by, status)
              VALUES ('$Brand', '$user_id', '$status')";

              

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Brand added successfully!'); window.location.href='../view_brands.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
