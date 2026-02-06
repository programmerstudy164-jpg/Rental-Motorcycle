<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $brand_id = $_POST['brand_id']; 
  

    $check_stmt = $conn->prepare("SELECT COUNT(*) FROM motorcycle WHERE brand_id = ?");
    $check_stmt->bind_param("i", $brand_id);
    $check_stmt->execute();
    $check_stmt->bind_result($count);
    $check_stmt->fetch();
    $check_stmt->close();

    if ($count > 0) {
        echo "<script>alert('Cannot delete. Brand is still in use by a motorcycle.'); window.location.href='../view_brands.php';</script>";
        exit();
    }

    $stmt = $conn->prepare("DELETE FROM brand WHERE brand_id = ?");
    $stmt->bind_param("i", $brand_id);

    if ($stmt->execute()) {
        echo "<script>alert('Brand deleted successfully.'); window.location.href='../view_brands.php';</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $stmt->close();
}
?>
