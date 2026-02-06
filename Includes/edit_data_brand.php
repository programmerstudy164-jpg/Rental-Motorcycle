<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['brand_id'], $_POST['Brand'], $_SESSION['user_id'])) {
        $id = intval($_POST['brand_id']);
        $brand = trim($_POST['Brand']);
        $user_id = intval($_SESSION['user_id']);

        // Get user role
        $query = "SELECT role FROM user WHERE user_id = ?";
        $stmtRole = $conn->prepare($query);
        $stmtRole->bind_param("i", $user_id);
        $stmtRole->execute();
        $result = $stmtRole->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $status = ($user['role'] === 'staff') ? 'Pending' : 'Approved';

            // Update brand
            $updateQuery = "UPDATE brand SET Vehicle_brand = ?, updation_date = NOW(), status = ? WHERE brand_id = ?";
            $stmt = $conn->prepare($updateQuery);
            $stmt->bind_param("ssi", $brand, $status, $id);

            if ($stmt->execute()) {
                echo "<script>alert('Brand updated successfully.'); window.location.href = '../view_brands.php';</script>";
            } else {
                echo "<script>alert('Error updating brand.'); window.history.back();</script>";
            }

            $stmt->close();
        } else {
            echo "<script>alert('User not found.'); window.history.back();</script>";
        }

        $stmtRole->close();
    } else {
        echo "<script>alert('Invalid request.'); window.history.back();</script>";
    }

    $conn->close();
}
?>
