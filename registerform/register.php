<?php
session_start();
include ('config.php');

if(isset($_SESSION['logined'])){
    header('location:display.php');
}
if(isset($_POST['submit']))
{
$name=$_POST['name'];
$email =$_POST["email"];

$emailErr='';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $emailErr = "Invalid email format";
  echo header('location:register-form.php');
}
// $email=$_POST['email'];
$address=$_POST['address'];
$phone=$_POST['phone'];
$password=$_POST['pass'];
$confirmpass=$_POST['cpass'];
if($password==$confirmpass)
    {
$sql = "Insert INTO register (name,email,address,phone,password,confirmpassword) VALUES ('$name','$email','$address','$phone','$password','$confirmpass')";
$result=$conn->query($sql);
if($result==true)
        {
    // echo "Registered Successfully";
   echo header('location:login-form.php');
        }
else 
            {
    echo "Unable to Register";
            }
    }

else{
    echo "Please enter confirm password same as password";
    }
}
else
{
    // echo "Please complete registration process!";
   echo header('location:register-form.php');

   
}
?>