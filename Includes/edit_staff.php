<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id    = $_POST['user_id'];
    $fname      = $_POST['fname'];
    $lname      = $_POST['lname'];
    $email      = $_POST['email'];
    $phoneNum   = $_POST['phoneNum'];
    $curpass    = $_POST['curpass'];  // current password input
    $newpass    = $_POST['newpass']; // new password (optional)

    if (empty($user_id) || empty($email) || empty($curpass)) {
        echo "<script>alert('Missing required fields.'); window.history.back();</script>";
        exit;
    }

    // Check if the current password is correct
    $stmt = $conn->prepare("SELECT password FROM user WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($existing_password);
    $stmt->fetch();
    $stmt->close();

    if ($existing_password !== $curpass) {
        echo "<script>alert('Incorrect current password.'); window.history.back();</script>";
        exit;
    }

    // Check for duplicate email (other than self)
    $check = $conn->prepare("SELECT user_id FROM user WHERE email = ? AND user_id != ?");
    $check->bind_param("si", $email, $user_id);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<script>alert('Email is already in use by another account.'); window.history.back();</script>";
        $check->close();
        exit;
    }
    $check->close();

    // Update statement (with or without password)
    if (!empty($newpass)) {
        $update = $conn->prepare("UPDATE user SET fname = ?, lname = ?, email = ?, phoneNum = ?, password = ? WHERE user_id = ?");
        $update->bind_param("sssssi", $fname, $lname, $email, $phoneNum, $newpass, $user_id);
    } else {
        $update = $conn->prepare("UPDATE user SET fname = ?, lname = ?, email = ?, phoneNum = ? WHERE user_id = ?");
        $update->bind_param("ssssi", $fname, $lname, $email, $phoneNum, $user_id);
    }

    if ($update->execute()) {
        echo "<script>alert('User information updated successfully.'); window.location.href = '../view_staff.php';</script>";
    } else {
        echo "<script>alert('Error updating record: " . addslashes($update->error) . "'); window.history.back();</script>";
    }

    $update->close();
    $conn->close();
} else {
    echo "<script>alert('Invalid request method.'); window.history.back();</script>";
}
?>
