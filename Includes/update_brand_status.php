<?php
include 'db.php';

if (isset($_GET['action']) && isset($_GET['brand_id'])) {
    $action = $_GET['action'];
    $brand_id = $_GET['brand_id'];

    // Database connection check
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $new_status = '';

    // Set the new status based on the action
    if ($action == 'approve') {
        $new_status = 'Approved';
    } elseif ($action == 'decline') {
        $new_status = 'Declined';
    } else {
        echo "<script>alert('Invalid action'); window.location.href='../index.php';</script>";
        exit;
    }

    // Update the motorcycle status in the database
    $query = "UPDATE brand SET status = '$new_status' WHERE brand_id = $brand_id";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Brand status updated successfully to $new_status'); window.location.href='../status_brand.php';</script>";
    } else {
        echo "<script>alert('Failed to update motorcycle status'); window.location.href='../index.php';</script>";
    }
} else {
    echo "<script>alert('Missing parameters'); window.location.href='../index.php';</script>";
}
?>
