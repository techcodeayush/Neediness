<?php
session_start();
include '../connection.php'; // Assuming connection.php contains database connection code

$msg = 0;

if (isset($_POST['sign'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sanitize input to prevent SQL injection
    $sanitized_emailid = mysqli_real_escape_string($connection, $email);
    $sanitized_password = mysqli_real_escape_string($connection, $password);

    $sql = "SELECT * FROM admin WHERE email='$sanitized_emailid'";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        $num = mysqli_num_rows($result);
        
        if ($num == 1) {
            $row = mysqli_fetch_assoc($result);
            
            if (password_verify($sanitized_password, $row['password'])) {
                $_SESSION['email'] = $email;
                $_SESSION['name'] = $row['name'];
                $_SESSION['location'] = $row['location'];
                $_SESSION['Aid'] = $row['Aid'];
                header("location: admin.php");
                exit; // Always exit after a header redirect
            } else {
                $msg = 1; // Incorrect password
            }
        } else {
            $msg = 2; // Account does not exist
        }
    } else {
        echo "Error: " . mysqli_error($connection); // Output any SQL errors for debugging
    }
}
?>
