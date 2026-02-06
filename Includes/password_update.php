<?php
session_start();
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentPassword = $_POST['curpass'];
    $newPassword = $_POST['newpass'];
    $confirmPassword = $_POST['enter'];

    $Email = $_SESSION['email'];

    if ($newPassword != $confirmPassword) {
        echo "<script>alert('New passwords do not match.'); window.history.back();</script>";
        exit();
    }

    // Get current password from DB
    $sql = "SELECT password FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $Email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['password'];

        if ($currentPassword === $storedPassword) {
            // Directly update password (no hash)
            $updateSql = "UPDATE user SET password = ? WHERE email = ?";
            $stmt_update = $conn->prepare($updateSql);
            $stmt_update->bind_param("ss", $newPassword, $Email);

            if ($stmt_update->execute()) {
                echo "<script>alert('Password updated successfully.'); window.location.href='../profile.php';</script>";
            } else {
                echo "<script>alert('Error updating password.'); window.history.back();</script>";
            }

            $stmt_update->close();
        } else {
            echo "<script>alert('Current password is incorrect.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('User not found.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
