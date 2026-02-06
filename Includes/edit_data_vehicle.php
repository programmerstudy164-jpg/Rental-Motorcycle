<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id_moto'];
    $vehicle = $_POST['vehicle_title'];
    $brand = $_POST['brand'];
    $day = $_POST['price_per_day'];
    $transmission = $_POST['transmission'];
    $model = $_POST['model_year'];
    $displacement = $_POST['displacement'];
    $default_image = "Pictures/default_vehicle.png.jpg";

    // Get user role for status
    $user_id = $_SESSION['user_id'];
    $query = "SELECT role FROM user WHERE user_id = ?";
    $stmtRole = $conn->prepare($query);
    $stmtRole->bind_param("i", $user_id);
    $stmtRole->execute();
    $result = $stmtRole->get_result();
    $user = $result->fetch_assoc();
    $stmtRole->close();

    $status = ($user['role'] === 'staff') ? 'Pending' : 'Approved';

    // Image processing
    $image = $_FILES['vehicle_image'];
    if (isset($image) && $image["error"] === 0) {
        $target_dir = "../Pictures/";
        $target_file = $target_dir . basename($image["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
            echo "Invalid image file.";
            exit;
        }

        if (move_uploaded_file($image["tmp_name"], $target_file)) {
            $image_path = "Pictures/" . basename($image["name"]);
        } else {
            echo "Error uploading image.";
            exit;
        }
    } else {
        $select = $conn->prepare("SELECT image FROM motorcycle WHERE id_moto = ?");
        $select->bind_param("i", $id);
        $select->execute();
        $result = $select->get_result();
        $row = $result->fetch_assoc();
        $image_path = $row['image'] ?? $default_image;
        $select->close();
    }

    // Update with status
    $stmt = $conn->prepare("UPDATE motorcycle SET Vehicle = ?, Price_Per_Day = ?, Transmission = ?, Model_Year = ?, Displacement = ?, image = ?, brand_id = ?, status = ? WHERE id_moto = ?");
    $stmt->bind_param("ssssssssi", $vehicle, $day, $transmission, $model, $displacement, $image_path, $brand, $status, $id);


    if ($stmt->execute()) {
        header("Location: ../view_vehicle.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
}
?>
