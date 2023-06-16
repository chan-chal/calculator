<?php
session_start();
include ('config.php');

if(isset($_SESSION['logined'])){
    header('location:display.php');
}
if(isset($_POST['submit']))
{
        $address=$_POST['address'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        $password=$_POST['pass'];
        $confirmpass=$_POST['cpass'];
        $name=$_FILES['uploadfile']['name'];
        $tempname=$_FILES['uploadfile']['tmp_name'];
        $folder="images/".$name;
        move_uploaded_file($tempname,$folder);

        $email_sql = "SELECT * FROM `register` WHERE `email`='$email'"; 
        $run = mysqli_query($conn,$email_sql);
        $count = mysqli_num_rows($run);

            if($password == $confirmpass)
            { 
                if(strlen($phone)==10)
                {
                    if($count>0)
                    {
                    echo "<script>alert('The email alreay exists');</script>";
                    }
                }
                else
                {
                    echo "re enter the num";
                }
            }else{
            echo "password not matched";
            }


      
   
}
?>
























if($password==$confirmpass)
    {
    $name=$_POST['name'];
    if(!preg_match("/^[a-zA-Z ]*$/",$name))
    {
        echo "Please enter alphabets only";
    }
    else
    {

    }
    $email =$_POST["email"];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "Please enter valid email";
    }
    else
    {

    }
    $address=$_POST['address'];
    $phone=$_POST['phone'];
    $password=$_POST['pass'];
    $confirmpass=$_POST['cpass'];
    $name=$_FILES['uploadfile']['name'];
    $tempname=$_FILES['uploadfile']['tmp_name'];
    $folder="images/".$name;
    move_uploaded_file($tempname,$folder);
$sql = "Insert INTO register (name,profile_image,email,address,phone,password,confirmpassword) VALUES ('$name','$folder','$email','$address','$phone','$password','$confirmpass')";
$result=$conn->query($sql);
if($result>0)
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