<?php
include 'db.php';  // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get POST data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $phoneNum = $_POST['phoneNum'];
    $email = $_POST['email'];
    $password = $_POST['password']; // not hashed
    $confirm_password = $_POST['confirm_password']; // confirm password
    $role = 'staff';

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match.'); window.history.back();</script>";
        exit;
    }

    // Handle image upload
    $profile_image = $_FILES['profile_image'];
    $image_name = $profile_image['name'];
    $image_tmp_name = $profile_image['tmp_name'];
    $image_error = $profile_image['error'];
    $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
    
    // Default image if no upload
    $image_to_save = 'default.png';  // This will be used if no image is uploaded

    if ($image_error === 0) {
        // Check file extension
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array(strtolower($image_ext), $allowed_extensions)) {
            $new_image_name = uniqid('', true) . '.' . $image_ext;
            $target_dir = "../Pictures/" . $new_image_name;
            
            // Move the uploaded file
            if (move_uploaded_file($image_tmp_name, $target_dir)) {
                $image_to_save = $new_image_name; // Save image name to DB
            } else {
                echo "<script>alert('Error uploading image.'); window.history.back();</script>";
                exit;
            }
        } else {
            echo "<script>alert('Invalid image format. Only JPG, JPEG, PNG, GIF are allowed.'); window.history.back();</script>";
            exit;
        }
    }
    
    // ✅ Check if email is already used
    $check_email = $conn->prepare("SELECT COUNT(*) FROM user WHERE email = ?");
    $check_email->bind_param("s", $email);
    $check_email->execute();
    $check_email->bind_result($email_count);
    $check_email->fetch();
    $check_email->close();

    if ($email_count > 0) {
        echo "<script>alert('Email already exists. Please use another email.'); window.history.back();</script>";
        exit;
    }

    // Insert user into database
    $stmt = $conn->prepare("INSERT INTO user (fname, lname, username, phoneNum, email, password, image, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $fname, $lname, $username, $phoneNum, $email, $password, $image_to_save, $role);

    if ($stmt->execute()) {
        echo "<script>alert('Staff added successfully!'); window.location.href='../view_staff.php';</script>";
    } else {
        echo "Database Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
<?php
include 'db.php';  // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get POST data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $phoneNum = $_POST['phoneNum'];
    $email = $_POST['email'];
    $password = $_POST['password']; // not hashed
    $confirm_password = $_POST['confirm_password']; // confirm password
    $role = 'staff';

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match.'); window.history.back();</script>";
        exit;
    }

    // Handle image upload
    $profile_image = $_FILES['profile_image'];
    $image_name = $profile_image['name'];
    $image_tmp_name = $profile_image['tmp_name'];
    $image_error = $profile_image['error'];
    $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
    
    // Default image if no upload
    $image_to_save = 'default.png';  // This will be used if no image is uploaded

    if ($image_error === 0) {
        // Check file extension
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array(strtolower($image_ext), $allowed_extensions)) {
            $new_image_name = uniqid('', true) . '.' . $image_ext;
            $target_dir = "../Pictures/" . $new_image_name;
            
            // Move the uploaded file
            if (move_uploaded_file($image_tmp_name, $target_dir)) {
                $image_to_save = $new_image_name; // Save image name to DB
            } else {
                echo "<script>alert('Error uploading image.'); window.history.back();</script>";
                exit;
            }
        } else {
            echo "<script>alert('Invalid image format. Only JPG, JPEG, PNG, GIF are allowed.'); window.history.back();</script>";
            exit;
        }
    }
    
    // ✅ Check if email is already used
    $check_email = $conn->prepare("SELECT COUNT(*) FROM user WHERE email = ?");
    $check_email->bind_param("s", $email);
    $check_email->execute();
    $check_email->bind_result($email_count);
    $check_email->fetch();
    $check_email->close();

    if ($email_count > 0) {
        echo "<script>alert('Email already exists. Please use another email.'); window.history.back();</script>";
        exit;
    }

    // Insert user into database
    $stmt = $conn->prepare("INSERT INTO user (fname, lname, username, phoneNum, email, password, image, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $fname, $lname, $username, $phoneNum, $email, $password, $image_to_save, $role);

    if ($stmt->execute()) {
        echo "<script>alert('Staff added successfully!'); window.location.href='../view_staff.php';</script>";
    } else {
        echo "Database Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
