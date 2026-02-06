<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_moto = isset($_POST['id_moto']) ? intval($_POST['id_moto']) : 0;
    $pickupLocation = mysqli_real_escape_string($conn, $_POST['pickuplocation']);
    $returnLocation = mysqli_real_escape_string($conn, $_POST['returnlocation']);
    $startDate = date('Y-m-d H:i:s', strtotime($_POST['startDate']));
    $endDate = date('Y-m-d H:i:s', strtotime($_POST['endDate']));
    $custompickup = mysqli_real_escape_string($conn, $_POST['custompickup']);
    $customreturn = mysqli_real_escape_string($conn, $_POST['customreturn']);
    $duration = isset($_POST['duration']) ? $_POST['duration'] : '1d';
    $totalCost = isset($_POST['totalCostDisplay']) ? $_POST['totalCostDisplay'] : 0;

    $startDateTime = new DateTime($_POST['startDate']);
    $endDateTime = new DateTime($_POST['endDate']);
    $durationDays = $startDateTime->diff($endDateTime)->days;

    if (!isset($_POST['pickuplocation']) || $_POST['pickuplocation'] === '') {
     echo "<script>alert('Pickup location is required'); window.location.href='../booking_bike.php?id=" . $id_moto . "';</script>";
     exit;
}elseif (!isset($_POST['returnlocation']) || $_POST['returnlocation'] === '') {
     echo "<script>alert('Return location is required'); window.location.href='../booking_bike.php?id=" . $id_moto . "';</script>";
     exit;


}
    
    $checkApprovedQuery = "
        SELECT * FROM rentals
        WHERE id_moto = ?
        AND status = 'Approved'
        AND (
            (? BETWEEN pickup_datetime AND return_datetime) OR
            (? BETWEEN pickup_datetime AND return_datetime) OR
            (pickup_datetime BETWEEN ? AND ?) OR
            (return_datetime BETWEEN ? AND ?)
        )
    ";

    if ($stmt = mysqli_prepare($conn, $checkApprovedQuery)) {
        mysqli_stmt_bind_param($stmt, 'issssss', $id_moto, $startDate, $endDate, $startDate, $endDate, $startDate, $endDate);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('⚠️ This motorcycle is already APPROVED for booking in this date range. Please select another motorcycle or date.'); window.location.href='../booking_bike.php?id=" . $id_moto . "';</script>";
            exit;
        }
        mysqli_stmt_close($stmt);
    }

  
    $checkUserBookingQuery = "
        SELECT * FROM rentals
        WHERE user_id = ?
        AND id_moto = ?
        AND status IN ('Pending', 'Approved')
        AND (
            (? BETWEEN pickup_datetime AND return_datetime) OR
            (? BETWEEN pickup_datetime AND return_datetime) OR
            (pickup_datetime BETWEEN ? AND ?) OR
            (return_datetime BETWEEN ? AND ?)
        )
    ";

    if ($stmt = mysqli_prepare($conn, $checkUserBookingQuery)) {
        mysqli_stmt_bind_param($stmt, 'iissssss', $user_id, $id_moto, $startDate, $endDate, $startDate, $endDate, $startDate, $endDate);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('⚠️ You already have a booking for this motorcycle in that date range.'); window.location.href='../booking_bike.php?id=" . $id_moto . "';</script>";
            exit;
        }
        mysqli_stmt_close($stmt);
    }

 
    $status = 'Pending';
    $insertRentalQuery = "INSERT INTO rentals (
        user_id, id_moto, pickup_location, custom_pickup_location,
        return_location, custom_return_location, pickup_datetime, return_datetime, status
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($conn, $insertRentalQuery)) {
        mysqli_stmt_bind_param($stmt, 'iisssssss', $user_id, $id_moto, $pickupLocation, $custompickup,
            $returnLocation, $customreturn, $startDate, $endDate, $status);

        if (mysqli_stmt_execute($stmt)) {
            $rental_id = mysqli_insert_id($conn);
            mysqli_stmt_close($stmt);

          
            $insertSumQuery = "INSERT INTO summary (rental_id, duration_days, total_cost) VALUES (?, ?, ?)";
            if ($stmt = mysqli_prepare($conn, $insertSumQuery)) {
                mysqli_stmt_bind_param($stmt, 'iii', $rental_id, $durationDays, $totalCost);
                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_close($stmt);

                  
                    $Fname = mysqli_real_escape_string($conn, $_POST['fn']);
                    $Lname = mysqli_real_escape_string($conn, $_POST['ln']);
                    $Driver_License = mysqli_real_escape_string($conn, $_POST['dl']);
                    $email = mysqli_real_escape_string($conn, $_POST['email']);
                    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
                    $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);

                    $insertContactQuery = "INSERT INTO contact (fname, lname, Driver_license, email, phone, rental_id, remarks) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";

                    if ($stmt = mysqli_prepare($conn, $insertContactQuery)) {
                        mysqli_stmt_bind_param($stmt, 'sssssis', $Fname, $Lname, $Driver_License, $email, $phone, $rental_id, $remarks);

                        if (mysqli_stmt_execute($stmt)) {
                            echo "<script>alert('✅ Booking successful!'); window.location.href='../my_booking.php';</script>";
                        } else {
                            echo "<script>alert('❌ Error saving contact info: " . mysqli_error($conn) . "');</script>";
                        }
                        mysqli_stmt_close($stmt);
                    }
                } else {
                    echo "<script>alert('❌ Error saving rental summary: " . mysqli_error($conn) . "');</script>";
                }
            }
        } else {
            echo "<script>alert('❌ Error saving rental info: " . mysqli_error($conn) . "');</script>";
        }
    }
}
?>
