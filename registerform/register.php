<?php
// session_start();
// include ('config.php');

// if(isset($_SESSION['logined'])){
//     header('location:display.php');
// }
// if(isset($_POST['submit']))
// {
//         $address=$_POST['address'];
//         $phone=$_POST['phone'];
//         $name=$_POST['name'];
//         $email=$_POST['email'];
//         $password=$_POST['pass'];
//         $confirmpass=$_POST['cpass'];
//         $names=$_FILES['uploadfile']['name'];
//         $tempname=$_FILES['uploadfile']['tmp_name'];
//         $folder="images/".$names;
//         move_uploaded_file($tempname,$folder);

//         $email_sql = "SELECT * FROM `register` WHERE `email`='$email'"; 
//         $run = mysqli_query($conn,$email_sql);
//         $count = mysqli_num_rows($run);
//         $hashed_password = password_hash($password,PASSWORD_DEFAULT);
//         // echo $hashed_password ;
//             if(password_verify($confirmpass,$hashed_password))
//             { 
//                 // echo $password ;
//                 if(strlen($phone)==10)
//                 {
//                     if($count>0)
//                     {
//                     echo "<script>alert('The email alreay exists');</script>";
//                     $sql = "INSERT INTO 'register' (name,profile_image,email,address,phone,password) VALUES ('$name','$folder','$email','$address','$phone','$hashed_password')";
//                      echo $sql;   
//                     $result=mysqli_query($conn,$sql);
//                     if($result>0)
//                             {
//                         // echo "Registered Successfully";
//                     echo header('location:login-form.php');
//                             }
//                 else
//                 {
//                     // echo "Please complete registration process!";
//                 echo header('location:register-form.php');
//                 }
//                     }
//                 }
//                 else
//                 {
//                     echo "re enter the num";
//                 }
//             }else{
//             echo "password not matched";
//             }
            
        
//         }

session_start();
include ('config.php');

if(isset($_SESSION['logined'])){
    header('location:display.php');
}
if(isset($_POST['submit']))
{
        $address=$_POST['address'];
        $phone=$_POST['phone'];
        $name=$_POST['name'];
        $email=$_POST['email'];
        $password=$_POST['pass'];
        $confirmpass=$_POST['cpass'];
        $names=$_FILES['uploadfile']['name'];
        $tempname=$_FILES['uploadfile']['tmp_name'];
        $folder="images/".$names;
        move_uploaded_file($tempname,$folder);
        $email_sql = "SELECT * FROM `register` WHERE `email`='$email'"; 
        $run = mysqli_query($conn,$email_sql);
        $count = mysqli_num_rows($run);
        // $hashed_password = password_hash($password,PASSWORD_DEFAULT);

        // echo $hashed_password ;
            // if(password_verify($confirmpass,$hashed_password))
            if($password==$confirmpass)
            { 
                // echo $password ;
                if(strlen($phone)==10)
                {
                    if($count>0)
                    {
                        echo "<script>alert('The email alreay exists');</script>";
                    }
                    else
                    {
                    $sql_inst ="INSERT INTO `register` (`profile_image`,`name`,`email`,`address`,`phone`,`password`)VALUES ('$folder','$name','$email','$address','$phone','$password')";
                    $run = mysqli_query($conn,$sql_inst);

                    if(!$run)
                    {
                        echo ("<script LANGUAGE='JavaScript'>
                            window.alert('Regisration Failed');
                            window.location.href='register-form.php';
                            </script>");
                    }
                    else{
                        header('location:login-form.php');
                    }
                    }
                }
                else
                {
                    echo "re enter the num";
                }
            }
            else{
            echo "password not matched";
            }       
}  

?>




<!-- 
$sql = "INSERT INTO 'register' (name,profile_image,email,address,phone,password) VALUES ('$name','$folder','$email','$address','$phone','$hashed_password')";
                        echo $sql;   
                        $result=mysqli_query($conn,$sql);
                        if(!$result)
                        {
                        // echo "Registered Successfully";
                        echo header('location:register-form.php');
                        // echo header('location:login-form.php');
                        }
                        else
                        {
                        // echo "Please complete registration process!";
                        // echo header('location:register-form.php');ssss
                        echo header('location:login-form.php');
                        } -->