
<?php
session_start();
if(isset($_SESSION['logined'])){
include ('config.php');
$id=$_GET['id'];
$sql="SELECT * FROM `register` where id='$id'";
$data=mysqli_query($conn,$sql);
$result=mysqli_num_rows($data);
$details=mysqli_fetch_assoc($data);

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
      if(!preg_match('/^[0-9]{10}+$/', $phone)) {
          $phoneErr="Mobile must have 10 digits";
        }
    }


  // Validate email
  if (empty($_POST['email'])) {
    $emailErr = 'Email is required';
  } else {
    $email = sanitizeInput($_POST['email']);
    // Check if email is valid
    // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

      if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",$email)){ 
      $emailErr = 'Invalid email format';
    }
  }

  // Validate address
  if (empty($_POST['address'])) {
    $addressErr = 'Address is required';
  } else {
    $address = sanitizeInput($_POST['address']);
  }

  if (empty($nameErr)&& empty($phoneErr) && empty($emailErr) && empty($addressErr)) {
// $password=$_POST['pass'];
// $confirmpass=$_POST['cpass'];
$image=$_FILES['uploadfile'];
if(!empty($_FILES['uploadfile']['name'])){
  $names=$_FILES['uploadfile']['name'];
  $tempname=$_FILES['uploadfile']['tmp_name'];
  $folder="images/".$names;

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

              <div class="form-outline text-center">
                <img src="<?php echo $details['profile_image'] ?>" height="200px" width="170px" class="update-image" >
                <!-- <label class="form-label" for="form3Example1cg" value="<?php echo $details['profile_image'] ?>" >Profile Image</label> -->
                <div></div>
                <input type="file" name="uploadfile"id="form3Example1cg" class="form-control form-control-lg ms-4" style="
    width: 8%;
    height: 1%;
    border: 1px solid red;
    display: inline-block;
    visibility: hidden;
" >
                <!-- -->
                <span style="position: relative;left: -40px;">
                  <i class="fa-solid fa-camera fa-2x"></i>
                </span>
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example1cg">Your Name</label>
                  <input type="text" id="form3Example1cg" class="form-control form-control-lg" name="name" value="<?php echo $details['name'] ?>"/>
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example1cg" value="<?php echo $details['profile_image'] ?>" >Profile Image</label>
                <input type="file" name="uploadfile"id="form3Example1cg" class="form-control form-control-lg" >
                <img src="<?php echo $details['profile_image'] ?>" height="120px" width="120px" >
                <!-- -->
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example3cg">Your Email</label>
                  <input type="email" id="form3Example3cg" class="form-control form-control-lg" name="email" value="<?php echo $details['email'] ?>"/>
                  <span class="error"><?php echo $emailErr; ?></span>
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4cdg">Address</label>
                  <input type="text" id="form3Example4cdg" class="form-control form-control-lg" name="address" value="<?php echo $details['address'] ?>" required maxlength=10/>
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

<?php }?>