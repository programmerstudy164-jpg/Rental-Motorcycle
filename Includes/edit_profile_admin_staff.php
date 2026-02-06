<?php
session_start();
include 'db.php'; // Your actual DB connection file

// Get user data from form
$user_id = $_POST['user_id'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$username = $_POST['username'];
$phoneNum = $_POST['phoneNum'];
$province = $_POST['province'] ?? '';
$city = $_POST['city'] ?? '';
$role = $_POST['role'];

// Handle image upload
$image = '';
if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
    $targetDir = "../Pictures/";
    $image = basename($_FILES["profile_image"]["name"]);
    $targetFilePath = $targetDir . $image;
    move_uploaded_file($_FILES["profile_image"]["tmp_name"], $targetFilePath);
} else {
    // Keep current image if none uploaded
    $stmt = $conn->prepare("SELECT image FROM user WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($existingImage);
    $stmt->fetch();
    $stmt->close();
    $image = $existingImage;
}

// Update query (walang email)
$query = "UPDATE user SET fname = ?, lname = ?, username = ?, phoneNum = ?, province = ?, city = ?, image = ? WHERE user_id = ? AND role IN ('admin', 'staff')";
$stmt = $conn->prepare($query);
$stmt->bind_param("sssssssi", $fname, $lname, $username, $phoneNum, $province, $city, $image, $user_id);

if ($stmt->execute()) {
    echo "<script>
        alert('Profile updated successfully.');
        window.location.href = '../staff_admin_profile.php';
    </script>";
    exit;
} else {
    echo "<script>
        alert('Update failed: " . addslashes($stmt->error) . "');
        window.location.href = '../staff_admin_edit.php';
    </script>";
}
$stmt->close();
$conn->close();
?>
