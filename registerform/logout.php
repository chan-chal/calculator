<?php
session_start();
if(isset($_SESSION['logined'])){
  session_unset();
  echo "<a href='login-form.php'>Login page</a>";

}
else{
  header('location:login.form.php');
}
?>