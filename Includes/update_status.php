<?php
include 'db.php'; 

if (isset($_GET['action']) && isset($_GET['rental_id'])) {
    $action = $_GET['action'];
    $rental_id = intval($_GET['rental_id']);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($action == 'approve') {
        // 1. Get rental details
        $query = "SELECT user_id, id_moto, pickup_datetime, return_datetime FROM rentals WHERE rental_id = $rental_id";
        $result = mysqli_query($conn, $query);

        if ($row = mysqli_fetch_assoc($result)) {
            $user_id = $row['user_id'];
            $id_moto = $row['id_moto'];
            $pickup = $row['pickup_datetime'];
            $return = $row['return_datetime'];

            // 2. Approve selected booking
            $update = "UPDATE rentals SET status = 'Approved' WHERE rental_id = $rental_id";
            mysqli_query($conn, $update);

            // 3. Decline conflicting bookings for same motorcycle and overlapping time
            $decline = "
                UPDATE rentals SET status = 'Declined'
                WHERE id_moto = $id_moto
                AND rental_id != $rental_id
                AND status = 'Pending'
                AND (
                    ('$pickup' BETWEEN pickup_datetime AND return_datetime) OR
                    ('$return' BETWEEN pickup_datetime AND return_datetime) OR
                    (pickup_datetime BETWEEN '$pickup' AND '$return') OR
                    (return_datetime BETWEEN '$pickup' AND '$return')
                )
            ";
            mysqli_query($conn, $decline);

            echo "<script>alert('Booking approved. Conflicting bookings declined.'); window.location.href='../view_booking.php';</script>";
        } else {
            echo "<script>alert('Rental not found.'); window.location.href='../view_booking.php';</script>";
        }

    } elseif ($action == 'decline') {
        $update = "UPDATE rentals SET status = 'Declined' WHERE rental_id = $rental_id";
        mysqli_query($conn, $update);
        echo "<script>alert('Booking declined.'); window.location.href='../view_booking.php';</script>";

    } elseif ($action == 'cancel') {
        $update = "UPDATE rentals SET status = 'Cancelled' WHERE rental_id = $rental_id";
        mysqli_query($conn, $update);
        echo "<script>alert('Booking cancelled.'); window.location.href='../view_booking.php';</script>";

    } else {
        echo "<script>alert('Invalid action'); window.location.href='../index.php';</script>";
    }

} else {
    echo "<script>alert('Missing parameters'); window.location.href='../index.php';</script>";
}
?>
