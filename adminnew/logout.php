<?php
session_start();
include('include/header.php');
if(isset($_SESSION['logined'])){
  session_unset();
}
echo "<script>";
echo " Swal.fire({
    icon: 'success',
    title: 'Logout!',
    text: 'Logged out Successfully!',
    showConfirmButton: false,
    timer: 2500
  }).then(() => {
    window.location.href='login-form.php';
  })";
  echo "</script>";
?>




