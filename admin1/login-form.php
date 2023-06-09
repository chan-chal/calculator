<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Login Form</title>
</head>

<body>


    <?php
session_start();
include ('config.php');
if(isset($_SESSION['logined'])){
    header('location:home_page.php');
}
else{
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
    // Perform password validation as per your requirements
    // ...
    }
 
    if(empty($emailErr)&&empty($passwordErr)){

    $sql="SELECT * FROM `register` WHERE `email`='$email' &&  `password`= md5('$password') && `status`='0'";

    $result = mysqli_query($conn,$sql);
    // print_r($result);
    $session_id="";
    foreach($result as $value){
      // print_r($value['id']);
      $session_id=$value['id'];
    }
    $res=mysqli_num_rows($result);
    if($res>0)
    {
    $_SESSION['logined']=$session_id;
    echo "<script>";
    echo " Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Login successful!',
        showConfirmButton: false,
        timer: 2500
      }).then(() => {
        window.location.href = 'profile_page.php';
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
}
?>

    <div class="container-fluid p-5">
        <div class="row justify-content-center custom-margin">

            <div class="col-6">

                <form action="" method="POST" class="m-5 pl-5">
                    <div class="form-group">
                        <i class="fa-regular fa-user"></i>
                        <label for="email" class="font-weight-bold" style="font-size:1.2rem;">Email</label>
                        <input type="email" name="email" id="email" class="form-control mb-4" style="width:75%;" value="<?php echo $email; ?> "
                            placeholder="Email" required>
                        <span class="error"><?php echo $emailErr; ?></span>
                    </div>

                    <i class="fa-regular fa-key"></i>
                    <label class="font-weight-bold " style="font-size:1.2rem;">Password</label>
                    <div class="input-group mb-4">
                        <input type="password" class="" style="width:75%;" name="password" id="myInput" placeholder="password"
                            value="<?php echo $password ;?>" required maxlength="32">
                        <div class="input-group-append">
                            <button class="btn btn-secondary" style="margin-left:-43px"type="button" onclick="myFunction()"><i class="fa fa-eye"
                                    aria-hidden="true"></i></button>
                        </div>
                    </div>
                    <div class="row">
                        <span class="error"><?php echo $passwordErr; ?></span>
                    </div>
                    <br>
                    <button type="submit" name="submit"
                        class="btn btn-primary btn-lg btn-block shadow-sm" style="width:75%;">Login</button>
                </form>

                <p class="text-center text-muted mt-5 mb-0" style="font-size:1.2rem;">Don't Have Account? <a href="register-form.php">Register here</a></p>
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