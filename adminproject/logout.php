<?php
session_start();
include('include/header.php');

if (isset($_SESSION['logined']) && isset($_SESSION['roleid'])) {
    session_unset();
}
        $title='Logout!';
        $text='Logged out Successfully!';
        $redirection='login-form.php';
        include('success-swal.php');

?>



