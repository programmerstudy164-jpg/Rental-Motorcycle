<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $id_moto = $_POST['id_moto'];

    $check_stmt = $conn->prepare("SELECT COUNT(*) FROM motorcycle WHERE id_moto = ?");
    $check_stmt->bind_param("i", $id_moto);
    $check_stmt->execute();
    $check_stmt->bind_result($count);
    $check_stmt->fetch();
    $check_stmt->close();

    
    if ($count > 0) {
       
        $stmt = $conn->prepare("DELETE FROM motorcycle WHERE id_moto = ?");
        $stmt->bind_param("i", $id_moto); 

        if ($stmt->execute()) {
            echo "<script>alert('Motorcycle deleted successfully.'); window.location.href='../view_vehicle.php';</script>";
        } else {
            echo "Error deleting record: " . $conn->error;
        }

        $stmt->close();
    } else {
        echo "<script>alert('Motorcycle not found.'); window.location.href='../view_motorcycles.php';</script>";
    }
}
?>

