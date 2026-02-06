<?php
session_start();
include 'db.php'; // Database connection

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    die("User not logged in.");
}

$curpass = $_POST['curpass'];
$newpass = $_POST['newpass'];
$confirm = $_POST['enter'];

if ($newpass !== $confirm) {
    echo "<script>alert('New passwords do not match.'); window.history.back();</script>";
    exit;
}

// Kunin ang current password sa database
$stmt = $conn->prepare("SELECT password, role FROM user WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($db_pass, $role);
$stmt->fetch();
$stmt->close();

// I-check kung tama ang current password (no hashing, plain comparison)
if ($curpass !== $db_pass) {
    echo "<script>alert('Current password is incorrect.'); window.history.back();</script>";
    exit;
}

// I-update ang password
$stmt = $conn->prepare("UPDATE user SET password = ? WHERE user_id = ? AND role IN ('admin', 'staff')");
$stmt->bind_param("si", $newpass, $user_id);

if ($stmt->execute()) {
    echo "<script>alert('Password updated successfully.'); window.location.href='../update_password_staff_admin.php';</script>";
} else {
    echo "<script>alert('Failed to update password: " . $stmt->error . "'); window.history.back();</script>";
}
$stmt->close();
?>
