<!-- 

if((isset($_POST['name']) && (isset($_POST['email']) && (isset($_POST['address']) && (isset($_POST['phone']) &&
     (isset($_POST['pass']) && (isset($_POST['pass']) && $password==$confirmpass)

    if(isset($name,$email,$address,$phone,$password,$confirmpass,$name,$tempname)) --> 





    <?php
session_start();
include ('config.php');

if(isset($_SESSION['logined'])){
    header('location:display.php');
}

if(isset($_POST['submit']))
{
    $error = 0 ;
    if(isset($_POST['name']) && empty($_POST['name'])){
        $error = 1;
        echo "";
    }


        if($password==$confirmpass)
        {
            if($error == 0){
                $name=$_POST['name'];
                $email =$_POST["email"];
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
        }
        
        else{
            echo "Please enter confirm password same as password";
        }
    }
}
    else
    {
        // echo "Please complete registration process!";
        echo header('location:register-form.php');
        
        
    }
    ?>