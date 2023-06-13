
<?php
include ('config.php');

if(isset($_POST['submit']))
{
$password=$_POST['password'];
$email=$_POST['email'];

$sql="SELECT * FROM `register` WHERE `email`=='$email' &&  `password`=='$password'";
$result = mysqli_query($conn,$sql);


if($result==true)
{
   header('location:index.php');

}
else{
    echo "please enter a valid email and password";
}
}
?>

