<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['email'];

    // Fetch existing data
    $sql_fetch = "SELECT * FROM user WHERE email = ?";
    $stmt_fetch = $conn->prepare($sql_fetch);
    $stmt_fetch->bind_param("s", $email);
    $stmt_fetch->execute();
    $result = $stmt_fetch->get_result();
    $existing = $result->fetch_assoc();
    $stmt_fetch->close();

    // Handle form data
    $username = $_POST['name'] ?? $existing['username'];
    $fname = $_POST['fname'] ?? $existing['fname'];
    $lname = $_POST['lname'] ?? $existing['lname'];
    $phoneNum = $_POST['Pnumbers'] ?? $existing['phoneNum'];
   
    $city = $_POST['city'] ?? $existing['city'];
    $province = $_POST['province'] ?? $existing['province'];
   
 

    // Handle image upload
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $image = 'Pictures/' . preg_replace("/[^a-zA-Z0-9\._-]/", "_", basename($_FILES['profile_image']['name']));
        $target_dir = "../Pictures/";

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        $target_file = $target_dir . basename($image);

        // File validation
        $allowed_extensions = ['jpg', 'jpeg', 'png'];
        $file_extension = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        $max_size = 5 * 1024 * 1024; // 5MB

        if (!in_array($file_extension, $allowed_extensions)) {
            echo "<script>alert('Invalid file type. Only JPG, JPEG, and PNG are allowed.'); window.history.back();</script>";
            exit();
        }

        if ($_FILES['profile_image']['size'] > $max_size) {
            echo "<script>alert('File size exceeds the 5MB limit.'); window.history.back();</script>";
            exit();
        }

        if (!move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file)) {
            echo "<script>alert('Error uploading your file.'); window.history.back();</script>";
            exit();
        }
    } else {
        // No image uploaded, keep existing
        $image = $existing['profile_image'];
    }

    // Update user data
    $sql_update = "UPDATE user SET 
        username = ?, 
        fname = ?, 
        lname = ?, 
        phoneNum = ?, 
       
        city = ?, 
        province = ?, 
       
       
        image = ? 
        WHERE email = ?";

    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ssssssss", $username, $fname, $lname, $phoneNum, $city, $province, $image, $email);

    if ($stmt_update->execute()) {
        echo "<script>alert('Profile updated successfully.'); window.location.href='../profile.php';</script>";
        exit();
    } else {
        error_log($stmt_update->error, 3, 'error_log.txt');
        echo "<script>alert('Error updating profile: " . addslashes($stmt_update->error) . "'); window.history.back();</script>";
    }

    $stmt_update->close();
    $conn->close();
}
?>
