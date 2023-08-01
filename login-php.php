<?php
// include 'include/header-links.php';
include 'include/config.php';
session_start();

if (isset($_SESSION['logined']) && isset($_SESSION['roleid'])) {
    header('location:home_page.php');
}

// Define variables to store form data and error messages
$email = $password = '';
$emailErr = $passwordErr = '';

// Function to sanitize and validate input data
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate email
    if (empty($_POST['email'])) {
        $emailErr = 'Email is required';
    } else {
        $email = sanitizeInput($_POST['email']);
        // Check if email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = 'Invalid email format';
        }
    }

    if (empty($_POST['password'])) {
        $passwordErr = 'Password is required';
    } else {
        $password = sanitizeInput($_POST['password']);
    }

    if (empty($emailErr) && empty($passwordErr)) {
        $sql = "SELECT * FROM `register` WHERE `role` IN(1,2,3,4) && `email`='$email' && `password`= md5('$password') && `status`='0'";
        $result = mysqli_query($conn, $sql);
        $session_id = "";
        foreach ($result as $value) {
            $session_id = $value['id'];
            $role = $value['role'];
        }
        $res = mysqli_num_rows($result);
        if ($res > 0) {
            $_SESSION['logined'] = $session_id;
            $role_query = "SELECT role_id FROM `roles` where `role_id`='$role'";
            $role = mysqli_query($conn, $role_query);
            $dat = mysqli_fetch_assoc($role);
            $_SESSION['roleid'] = $dat['role_id'];

            // success swal
                    $title='Success';
                    $text='Login successful!';
                    $redirection='home_page.php';
                    include('success-swal.php');
        } else {
            // failure swal
                    $title='Login';
                    $text='Login Failed!';
                    $redirection='login-form.php';
                    include('failed-swal.php');

        }
    }
}
?>
