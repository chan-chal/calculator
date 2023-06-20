
<?php
session_start();
include ('config.php');
if(isset($_SESSION['logined'])){
    header('location:display2.php');
}
if(isset($_POST['submit']))
{
$password=$_POST['password'];
$email=$_POST['email'];

$sql="SELECT * FROM `register` WHERE `email`='$email' &&  `password`='$password'";

$result = mysqli_query($conn,$sql);
 $res=mysqli_num_rows($result);
if($res>0)
{
    $_SESSION['logined']=$email;
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Login Successfull');
    window.location.href='display2.php';
    </script>");

}
else{
    echo "please enter a valid email and password";
}
}
?>

