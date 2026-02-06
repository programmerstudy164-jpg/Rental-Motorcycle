<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user_id from the form (POST)
    if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
        $user_id = $_POST['user_id'];

        // Debugging: Output received user_id
        echo "Debug: Received User ID = " . $user_id . "<br>";

        // Check if the user exists in the database
        $check_stmt = $conn->prepare("SELECT COUNT(*) FROM user WHERE user_id = ?");
        $check_stmt->bind_param("i", $user_id);
        $check_stmt->execute();
        $check_stmt->bind_result($count);
        $check_stmt->fetch();
        $check_stmt->close();

        // Debugging: Check how many users were found
        echo "Debug: User Count = " . $count . "<br>";

        if ($count > 0) {
            // Proceed to delete the user if they exist
            $stmt = $conn->prepare("DELETE FROM user WHERE user_id = ?");
            $stmt->bind_param("i", $user_id); 

            if ($stmt->execute()) {
                echo "<script>alert('User deleted successfully.'); window.location.href='../view_staff.php';</script>";
            } else {
                echo "Error deleting user: " . $conn->error;
            }

            $stmt->close();
        } else {
            echo "<script>alert('User not found or invalid ID.'); window.location.href='../view_staff.php';</script>";
        }
    } else {
        echo "Debug: User ID is missing or invalid.<br>";
    }
}
?>
