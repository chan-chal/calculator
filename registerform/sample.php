<?php
session_start();
if(isset($_SESSION['logined'])){
include ('config.php');
$id=$_GET['id'];
$sql="SELECT * FROM `register` where id='$id'";
$data=mysqli_query($conn,$sql);
$result=mysqli_num_rows($data);
$details=mysqli_fetch_assoc($data);

$name = $phone = $email = $address = '';
$nameErr = $phoneErr = $emailErr = $addressErr = '';

// Function to sanitize and validate input data
function sanitizeInput($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}

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
// if (empty($_FILES['uploadfile']['name'])) {
//   $fileErr = 'File upload is required';
// } else {
  // Perform file upload validations as per your requirements
  // ...
// }

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

if (empty($nameErr) && empty($phoneErr) && empty($emailErr) && empty($addressErr)) {
// $password=$_POST['pass'];
// $confirmpass=$_POST['cpass'];
$image=$_FILES['uploadfile'];
if(!empty($_FILES['uploadfile']['name'])){
$names=$_FILES['uploadfile']['name'];
$tempname=$_FILES['uploadfile']['tmp_name'];
$folder="images/".$names;
// echo $folder;
move_uploaded_file($tempname,$folder);
$sql="UPDATE register SET name='$name',profile_image='$folder',email='$email',address='$address',phone='$phone' WHERE id='$id'";
$res=mysqli_query($conn,$sql);
if($res>0)
              {
        
                echo ("<script LANGUAGE='JavaScript'>
                window.alert('Data and image updated successfully');
                window.location.href='display.php';
                </script>");
              }
            
else 
          {
  echo "Unable to Update";
          }
  }


else
{
  $sql="UPDATE register SET name='$name',email='$email',address='$address',phone='$phone'WHERE id='$id'";
  $res=mysqli_query($conn,$sql);
  header('location:login-form.php');
  if($res>0)
              {
        
                echo ("<script LANGUAGE='JavaScript'>
                window.alert('Data Succesfully Updated');
                window.location.href='display.php';
                </script>");
              }
else 
          {
  echo "Unable to Update";
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
    <link rel="stylesheet" href="style.css">
    <title>update Form</title>
  </head>
  <body>       
<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">my weB</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="display.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      <li>
      <a class="nav-link" href="logout.php">Logout</a>
      </li>
  </div>
</nav>
  <!-- update form -->
<section class="vh-100 bg-image"
  style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Update your account</h2>

              <form action="" method="POST" enctype="multipart/form-data">

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example1cg">Your Name</label>
                  <input type="text" id="form3Example1cg" class="form-control form-control-lg" name="name" value="<?php echo $details['name'] ?>"/>
                  <span class="error"><?php echo $nameErr; ?></span>
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example1cg" value="<?php echo $details['profile_image'] ?>" >Profile Image</label>
                <input type="file" name="uploadfile"id="form3Example1cg"class="form-control form-control-lg" />
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example3cg">Your Email</label>
                  <input type="email" id="form3Example3cg" class="form-control form-control-lg" name="email" value="<?php echo $details['email'] ?>"/>
                  <span class="error"><?php echo $emailErr; ?></span>
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4cdg">Address</label>
                  <input type="text" id="form3Example4cdg" class="form-control form-control-lg" name="address" value="<?php echo $details['address'] ?>"/>
                  <span class="error"><?php echo $addressErr; ?></span>
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4cdg">Phone Number</label>
                  <input type="text" id="form3Example4cdg" class="form-control form-control-lg" name="phone" value="<?php echo $details['phone'] ?>"/>
                  <span class="error"><?php echo $phoneErr; ?></span>
                </div>

                <div class="d-flex justify-content-center">
                  <button type="submit" name="update"class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Update</button>
                </div>
                <script src="JavaScript/jquery-1.6.1.min.js" type="text/javascript"></script>
                <!-- <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="#!"
                    class="fw-bold text-body"><u>Login here</u></a></p> -->

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>






<?php

session_start();
if(!isset($_SESSION['logined'])){
header('location:display.php');
}
include ('config.php');
// Define variables to store form data and error messages
// $name = $phone = $email = $address = $password = $confirmPassword = '';
// $nameErr = $phoneErr = $fileErr= $emailErr = $addressErr = $passwordErr = $confirmPasswordErr = '';
// Function to sanitize and validate input data




if(isset($_POST['update']))
{
$id=$_GET['id'];
$sql="SELECT * FROM `register` where id='$id'";
$data=mysqli_query($conn,$sql);
$result=mysqli_num_rows($data);
$details=mysqli_fetch_assoc($data);
print_r($details);
exit;
}

function sanitizeInput($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;}


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
    $passwordErr = 'Please fill the password';
  } else {
    $password = sanitizeInput($_POST['pass']);
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);
    
    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
      $passwordErr='Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
    }
  }

  // Validate confirm password
  if (empty($_POST['cpass'])) {
    $confirmPasswordErr = 'Confirm password is required';
  } else {
    $confirmPassword = sanitizeInput($_POST['cpass']);
    // Check if confirm password matches the password
    if ($confirmPassword !== $password) {
      $confirmPasswordErr = 'Password an confirm password do not match';
    }
  }
  if($_POST['email'])
  {
      $email_sql = "SELECT * FROM `register` WHERE `email`='$email'"; 
      $run = mysqli_query($conn,$email_sql);
      $count = mysqli_num_rows($run);

      if($count>0)
      {
      $emailErr="Email already exists";
      }
      else
      {
     // If there are no errors, you can proceed with further processing
  if (empty($nameErr) && empty($fileErr) && empty($phoneErr) && empty($emailErr) && empty($addressErr) && empty($passwordErr) && empty($confirmPasswordErr)) {
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
          echo ("<script LANGUAGE='JavaScript'>
          window.alert('Registered Successfully');
          window.location.href='login-form.php';
          </script>");
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
    <link rel="stylesheet" href="style.css">
    <title>Registeration Form</title>
  </head>
  <body>       
<section class="vh-100 bg-image">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card formmargin" style="border-radius: 15px;">
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
                <input type="file" name="uploadfile"id="form3Example1cg"class="form-control form-control-lg" value="<?php echo $_FILES['uploadfile']['name']; ?>" required/>
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
                
                <!-- <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4cg">Password</label> <br>
                  <input type="password" id="password" class="form-control form-control-lg" name="pass" value="" required />
                  <span id="password-error" style="color:red;"></span>
                  <span class="error"></span>
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4cdg">Confirm password</label>
                  <input type="password" id="form3Example4cdg" value="" class="form-control form-control-lg" name="cpass" required/>
                  <span class="error"></span>
                </div> -->
              
                 <div class="d-flex justify-content-center">
                  <button type="submit" name="update"
                    class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Update</button>
                </div>

                <!-- <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="login-form.php"
                    class="fw-bold text-body"><u>Login here</u></a></p> -->

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="JavaScript/jquery-1.6.1.min.js" type="text/javascript"></script>
</body>
</html>



<?php
session_start();
if(isset($_SESSION['logined'])){
include ('config.php');
$id=$_GET['id'];
$sql="SELECT * FROM `register` where id='$id'";
$data=mysqli_query($conn,$sql);
$result=mysqli_num_rows($data);
$details=mysqli_fetch_assoc($data);

if(isset($_POST['update']))
{
$name=$_POST['name'];
$email=$_POST['email'];
$address=$_POST['address'];
$phone=$_POST['phone'];
// $password=$_POST['pass'];
// $confirmpass=$_POST['cpass'];
$image=$_FILES['uploadfile'];
if(!empty($_FILES['uploadfile']['name'])){
  $names=$_FILES['uploadfile']['name'];
  $tempname=$_FILES['uploadfile']['tmp_name'];
  $folder="images/".$names;
  // echo $folder;
  move_uploaded_file($tempname,$folder);
$sql="UPDATE register SET name='$name',profile_image='$folder',email='$email',address='$address',phone='$phone' WHERE id='$id'";
$res=mysqli_query($conn,$sql);
if($res>0)
                {
          
                  echo ("<script LANGUAGE='JavaScript'>
                  window.alert('Data and image Succesfully Updated');
                  window.location.href='display.php';
                  </script>");
                }
else 
            {
    echo "Unable to Update";
            }
    }


else
{
    $sql="UPDATE register SET name='$name',email='$email',address='$address',phone='$phone'WHERE id='$id'";
    $res=mysqli_query($conn,$sql);
    header('location:login-form.php');
    if($res>0)
                {
          
                  echo ("<script LANGUAGE='JavaScript'>
                  window.alert('Data Succesfully Updated');
                  window.location.href='display.php';
                  </script>");
                }
else 
            {
    echo "Unable to Update";
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
    <link rel="stylesheet" href="style.css">
    <title>update Form</title>
  </head>
  <body>       
<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">my weB</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="display2.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      <li>
      <a class="nav-link" href="logout.php">Logout</a>
      </li>
  </div>
</nav>
  <!-- update form -->
<section class="vh-100 bg-image"
  style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Update your account</h2>

              <form action="" method="POST" enctype="multipart/form-data">

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example1cg">Your Name</label>
                  <input type="text" id="form3Example1cg" class="form-control form-control-lg" name="name" value="<?php echo $details['name'] ?>"/>
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example1cg" value="<?php echo $details['profile_image'] ?>" >Profile Image</label>
                <input type="file" name="uploadfile"id="form3Example1cg"class="form-control form-control-lg" />
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example3cg">Your Email</label>
                  <input type="email" id="form3Example3cg" class="form-control form-control-lg" name="email" value="<?php echo $details['email'] ?>"/>
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4cdg">Address</label>
                  <input type="text" id="form3Example4cdg" class="form-control form-control-lg" name="address" value="<?php echo $details['address'] ?>"/>
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4cdg">Phone Number</label>
                  <input type="text" id="form3Example4cdg" class="form-control form-control-lg" name="phone" value="<?php echo $details['phone'] ?>"/>
                </div>

                <div class="d-flex justify-content-center">
                  <button type="submit" name="update"class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Update</button>
                </div>

                <!-- <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="#!"
                    class="fw-bold text-body"><u>Login here</u></a></p> -->

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="JavaScript/jquery-1.6.1.min.js" type="text/javascript"></script>
</body>
</html>

<?php


?>

<!-- Simple without validations
<?php
session_start();
if(isset($_SESSION['logined'])){
include ('config.php');
$id=$_GET['id'];
$sql="SELECT * FROM `register` where id='$id'";
$data=mysqli_query($conn,$sql);
$result=mysqli_num_rows($data);
$details=mysqli_fetch_assoc($data);

if(isset($_POST['update']))
{
$name=$_POST['name'];
$email=$_POST['email'];
$address=$_POST['address'];
$phone=$_POST['phone'];
// $password=$_POST['pass'];
// $confirmpass=$_POST['cpass'];
$image=$_FILES['uploadfile'];
if(!empty($_FILES['uploadfile']['name'])){
  $names=$_FILES['uploadfile']['name'];
  $tempname=$_FILES['uploadfile']['tmp_name'];
  $folder="images/".$names;
  // echo $folder;
  move_uploaded_file($tempname,$folder);
$sql="UPDATE register SET name='$name',profile_image='$folder',email='$email',address='$address',phone='$phone' WHERE id='$id'";
$res=mysqli_query($conn,$sql);
if($res>0)
                {
          
                  echo ("<script LANGUAGE='JavaScript'>
                  window.alert('Data and image Succesfully Updated');
                  window.location.href='display.php';
                  </script>");
                }
else 
            {
    echo "Unable to Update";
            }
    }


else
{
    $sql="UPDATE register SET name='$name',email='$email',address='$address',phone='$phone'WHERE id='$id'";
    $res=mysqli_query($conn,$sql);
    header('location:login-form.php');
    if($res>0)
                {
          
                  echo ("<script LANGUAGE='JavaScript'>
                  window.alert('Data Succesfully Updated');
                  window.location.href='display.php';
                  </script>");
                }
else 
            {
    echo "Unable to Update";
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
    <link rel="stylesheet" href="style.css">
    <title>update Form</title>
  </head>
  <body>       
<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">my weB</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="display2.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      <li>
      <a class="nav-link" href="logout.php">Logout</a>
      </li>
  </div>
</nav>
  <!-- update form -->
<section class="vh-100 bg-image"
  style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Update your account</h2>

              <form action="" method="POST" enctype="multipart/form-data">

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example1cg">Your Name</label>
                  <input type="text" id="form3Example1cg" class="form-control form-control-lg" name="name" value="<?php echo $details['name'] ?>"/>
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example1cg" value="<?php echo $details['profile_image'] ?>" >Profile Image</label>
                <input type="file" name="uploadfile"id="form3Example1cg"class="form-control form-control-lg" />
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example3cg">Your Email</label>
                  <input type="email" id="form3Example3cg" class="form-control form-control-lg" name="email" value="<?php echo $details['email'] ?>"/>
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4cdg">Address</label>
                  <input type="text" id="form3Example4cdg" class="form-control form-control-lg" name="address" value="<?php echo $details['address'] ?>"/>
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4cdg">Phone Number</label>
                  <input type="text" id="form3Example4cdg" class="form-control form-control-lg" name="phone" value="<?php echo $details['phone'] ?>"/>
                </div>

                <div class="d-flex justify-content-center">
                  <button type="submit" name="update"class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Update</button>
                </div>

                <!-- <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="#!"
                    class="fw-bold text-body"><u>Login here</u></a></p> -->

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="JavaScript/jquery-1.6.1.min.js" type="text/javascript"></script>
</body>
</html>
 -->