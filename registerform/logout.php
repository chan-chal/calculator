<?php
session_start();
if(isset($_SESSION['logined'])){
  session_unset();
  echo $_SESSION['logined'];
}
else{
  echo "logined not";
}
?>