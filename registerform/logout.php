<?php

session_start();
if(isset($_SESSION['logined'])){
  session_unset();
}
header('location:login-form.php');
?>