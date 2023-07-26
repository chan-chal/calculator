<!-- #4B49AC -->
<!-- <!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="include/style.css">
    <title>Login Form</title>
</head>

<body> -->
<?php
include 'include/header-links.php';
include 'include/config.php';
session_start();
if(isset($_SESSION['logined'])&& isset($_SESSION['roleid'])){
header('location:home_page.php');
}
// Define variables to store form data and error messages
$email = $password ='';
$emailErr =$passwordErr= '';
// Function to sanitize and validate input data
    function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validate email
    if (empty($_POST['email'])) {
    $emailErr = 'Email is required';
    } else {
    $email = sanitizeInput($_POST['email']);
    // Check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = 'Invalid email format';
    }
    }

    if (empty($_POST['password'])) {
    $passwordErr = 'Password is required';
    } else {
    $password = sanitizeInput($_POST['password']);
    }
 
    if(empty($emailErr)&&empty($passwordErr)){
    $sql="SELECT * FROM `register` WHERE `role` IN(1,2,3,4) && `email`='$email' &&  `password`= md5('$password') && `status`='0'";
    $result = mysqli_query($conn,$sql);
    $session_id="";
    foreach($result as $value){
      $session_id=$value['id'];
      $role=$value['role'];
    }
    $res=mysqli_num_rows($result);    
    if($res>0)
    {
    $_SESSION['logined']=$session_id;
    $role_query="SELECT role_id FROM `roles` where `role_id`='$role'";
    $role = mysqli_query($conn,$role_query);
    $dat=mysqli_fetch_assoc($role);
    $_SESSION['roleid']=$dat['role_id'];
    echo "<script>";
    echo " Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Login successful!',
        showConfirmButton: false,
        timer: 2500
      }).then(() => {
        window.location.href = 'home_page.php';
      })";

      echo "</script>";

    }
    else{
        // $passwordErr= "please enter a valid email and password";
        echo "<script>";
        echo " Swal.fire({
            icon: 'error',
            title: 'Login',
            text: 'Login Failed!',
            showConfirmButton: false,
            timer: 2500
          }).then(() => {
            window.location.href = 'login-form.php';
          })";
          echo "</script>";
    }
  }
}
?>

<div class="container-fluid p-5">
    <div class="row justify-content-center custom-margin">
        <div class="col-6">
            <form action="" method="POST" class="m-5 pl-5">
                <div class="form-group">
                    <i class="fa-regular fa-user"></i>

                    <label for="email" class="font-weight-bold" style="font-size:1.2rem;">Email</label>
                    <input type="email" name="email" id="email" class="form-control mb-4" style="width:75%;"
                        value="<?php echo $email; ?> " placeholder="Email">
                    <div>
                        <span class="error"><?php echo $emailErr; ?></span>
                    </div>
                    <i class="fa-regular fa fa-key"></i>

                    <label class="font-weight-bold " style="font-size:1.2rem;">Password</label>
                    <!-- <div class="input-group mb-4">
                            <input type="password" class="" style="width:75%;" name="password" id="myInput"
                            placeholder="password" value="<?php echo $password ;?>" required maxlength="32">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" style="margin-left:-43px" type="button"
                                onclick="myFunction()"><i class="fa fa-eye" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <div class="row">
                            </div>
                        </div> -->
                    <div class="input-group mb-4" style="width: 75%;">
                        <input type="password" name="password" id="myInput" class="form-control"
                            value="<?php echo $password; ?>" placeholder="password">
                        <div class="input-group-append">
                            <span class="input-group-text bg-secondary" style="height: 38px;"><i class="fas fa-eye"
                                    onclick="myFunction()"></i></span>
                        </div>
                    </div>
                    <div class="row">
                        <span class="error"><?php  echo $passwordErr; ?></span>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary btn-md btn-block shadow-sm"
                        style="width:75%;">Login</button>
            </form>

            <!-- <p class="text-center text-muted mt-5 mb-0" style="font-size:1.2rem;width:75%;">Don't Have Account? <a href="register-form.php">Register here</a></p> -->
            <p class="text-center text-muted mt-5 mb-0" style="font-size:1.2rem;width:75%;">Forgot password? <a
                    href="recover_email.php">Click here</a></p>
        </div>
    </div>
    <div class="col-6">
        <img src="https://i.imgur.com/uNGdWHi.png" class="img-fluid" style="height:500px;" alt="">
    </div>
</div>
</div>
<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
</script>
</body>

</html>


<script>
function myFunction() {
    var x = document.getElementById("myInput");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
</script>