
<?php
session_start();
include ('config.php');
if(isset($_SESSION['logined'])){
    header('location:display.php');
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
    $_SESSION['logined']=$password;
    header('location:display.php');

}
else{
    echo "please enter a valid email and password";
}
}
?>

