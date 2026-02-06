<?php
include 'db.php';
// make sure session is started

$email = $_SESSION['email'] ?? null;

if ($email) {
    $sql = "SELECT * FROM user WHERE email = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        $user = $result->fetch_assoc();

        if ($user) {
            $phoneNum = $user['phoneNum'] ?? ''; 
            $fname = $user['fname'] ?? ''; 
            $username = $user['username'] ?? '';
            $lname = $user['lname'] ?? '';
            $street = $user['street'] ?? ''; 
            $city = $user['city'] ?? '';
            $province = $user['province'] ?? ''; 
            $code = $user['code'] ?? ''; 
            $apt = $user['apt'] ?? '';
           
        } else {
            $phoneNum = $fname = $username = $lname = '';
            $street = $city = $province = $code = $apt = '';
          
        }

        $stmt->close();
    }
}
$conn->close();
?>