<?php
include ('config.php');
// Define variables to store form data and error messages
$name = $phone = $email = $address = $password = $confirmPassword = '';
$nameErr = $phoneErr = $fileErr= $emailErr = $addressErr = $passwordErr = $confirmPasswordErr = '';

// Function to sanitize and validate input data
function sanitizeInput($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Form submission and validation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Validate name
  if (empty($_POST['name'])) {
    $nameErr = 'Name is required';
  } else {
    $name = sanitizeInput($_POST['name']);
    // Check if name contains only letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
      $nameErr = 'Only letters and whitespace allowed';
    }
  }

  // Validate file upload
  if (empty($_FILES['uploadfile']['name'])) {
    $fileErr = 'File upload is required';
  } else {
    // Perform file upload validations as per your requirements
    // ...
  }

  // Validate phone
  if (empty($_POST['phone'])) {
    $phoneErr = 'Phone number is required';
  } else {
    $phone = sanitizeInput($_POST['phone']);
    // Check if phone number contains only digits
    if (!preg_match("/^[0-9]*$/", $phone)) {
      $phoneErr = 'Only digits allowed';
    }
  }

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

  // Validate address
  if (empty($_POST['address'])) {
    $addressErr = 'Address is required';
  } else {
    $address = sanitizeInput($_POST['address']);
  }

  // Validate password
  if (empty($_POST['pass'])) {
    $passwordErr = 'Password is required';
  } else {
    $password = sanitizeInput($_POST['pass']);
    // Perform password validation as per your requirements
    // ...
  }

  // Validate confirm password
  if (empty($_POST['cpass'])) {
    $confirmPasswordErr = 'Confirm password is required';
  } else {
    $confirmPassword = sanitizeInput($_POST['cpass']);
    // Check if confirm password matches the password
    if ($confirmPassword !== $password) {
      $confirmPasswordErr = 'Passwords do not match';
    }
  }
  if($_POST['email'])
  {
      $email_sql = "SELECT * FROM `register` WHERE `email`='$email'"; 
      $run = mysqli_query($conn,$email_sql);
      $count = mysqli_num_rows($run);

      if($count>0)
      {
      // echo "<script>alert('The email alreay exists');</script>";
      // echo ("<script LANGUAGE='JavaScript'>
      // window.alert('Email alreay exits');
      // window.location.href='register-form.php';
      // </script>");
      $emailErr="Email already exists";
      }
      else
      {
     // If there are no errors, you can proceed with further processing
  if (empty($nameErr) && empty($fileErr) && empty($phoneErr) && empty($emailErr) && empty($addressErr) && empty($passwordErr) && empty($confirmPasswordErr)) {
    // Perform further actions, such as storing data in a database or redirecting to another page
    // ...
    // Example: Storing data in a database
    // $conn = mysqli_connect('localhost', 'username', 'password', 'database');
    // $query = "INSERT INTO users (name, phone, email, address, password) VALUES ('$name', '$phone', '$email', '$address', '$password')";
    // mysqli_query($conn, $query);
    // ...

        // move_uploaded_file($tempname,$folder);
        // $email_sql = "SELECT * FROM `register` WHERE `email`='$email'"; 
        // $run = mysqli_query($conn,$email_sql);
        // $count = mysqli_num_rows($run);
        $names=$_FILES['uploadfile']['name'];
        $tempname=$_FILES['uploadfile']['tmp_name'];
        $folder="images/".$names;
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

  }
}
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <title>Registeration Form</title>
  </head>
  <body>       
<section class="vh-100 bg-image">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Create an account</h2>

              <form action="" method="POST" enctype="multipart/form-data">

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example1cg">Your Name</label>
                  <input type="text" id="form3Example1cg"class="form-control form-control-lg" value="<?php echo $name; ?>" name="name" required/>
                  <span class="error"><?php echo $nameErr; ?></span>
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example1cg">Profile Image</label>
                <input type="file" name="uploadfile"id="form3Example1cg"class="form-control form-control-lg" required/>
                <span class="error"><?php echo $fileErr; ?></span>  
              </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example3cg">Your Email</label>
                  <input type="text" id="form3Example3cg" class="form-control form-control-lg"  value="<?php echo $email; ?>" name="email" required/>
                  <span class="error"><?php echo $emailErr; ?></span>
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4cdg">Address</label>
                  <input type="text" id="form3Example4cdg" class="form-control form-control-lg" value="<?php echo $address; ?>" name="address" required/>
                  <span class="error"><?php echo $addressErr; ?></span>
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4cdg">Phone Number</label>
                  <input type="text" id="form3Example4cdg" class="form-control form-control-lg" value="<?php echo $phone; ?>" name="phone" required />
                  <span class="error"><?php echo $phoneErr; ?></span>
                </div>
                
                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4cg">Password</label> <br>
                  <input type="password" id="password" class="form-control form-control-lg" name="pass" value="<?php echo $password; ?>" required />
                  <span id="password-error" style="color:red;"></span>
                  <span class="error"><?php echo $passwordErr; ?></span>
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4cdg">Confirm password</label>
                  <input type="password" id="form3Example4cdg" value="<?php echo $confirmPassword; ?>" class="form-control form-control-lg" name="cpass" required/>
                  <span class="error"><?php echo $confirmPasswordErr; ?></span>
                </div>
              
                <div class="d-flex justify-content-center">
                  <button type="submit" name="submit"
                    class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
                </div>

                <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="login-form.php"
                    class="fw-bold text-body"><u>Login here</u></a></p>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
