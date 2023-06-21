
<?php
session_start();
include ('config.php');
if(isset($_SESSION['logined'])){
    header('location:display.php');
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

    $sql="SELECT * FROM `register` WHERE `email`='$email' &&  `password`='$password'";

    $result = mysqli_query($conn,$sql);
    $res=mysqli_num_rows($result);
    if($res>0)
    {
    $_SESSION['logined']=$email;
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Logined Successfully');
    window.location.href='display.php';
    </script>");

    }
    else{
        $passwordErr= "please enter a valid email and password";
    }
  }
}
}
?>

<!doctype html>
<html lang="en">
  <head>
 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    .custom-margin
{
    margin-top: 20vh;
}
    </style>
    <title>Login Form</title>
  </head>
  <body>
    <div class="container">
    <div class="row justify-content-center custom-margin">
        <div class="col-md-4 col-sm-6 col-lg-6">

            <form action="" method="POST" class="shadow-lg p-4">
                <div class="form-group">
                <i class="fa-regular fa-user"></i>
                <label for="email" class="font-weight-bold">Email</label>
                <input type="email"  name ="email" id ="email" class="form-control" value="<?php echo $email; ?> " placeholder="Email">  
                <span class="error"><?php echo $emailErr; ?></span> 
                </div>

                <div class="form-group">
                <i class="fa-regular fa-key"></i>
                <label for="password" class="font-weight-bold">Password</label>
                <input type="password" name ="password" id ="password" class="form-control" placeholder="password">
                <span class="error"><?php echo $passwordErr; ?></span>   
                </div>
              <button type="submit" name="submit" class="btn btn-success btn-lg btn-block shadow-sm">Login</button>
            </form>
            <p class="text-center text-muted mt-5 mb-0">Don't Have Account Register? <a href="register-form.php"
                    class="fw-bold text-body"><u>Register here</u></a></p>

        </div>
    </div>
</div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
  </body>
</html>