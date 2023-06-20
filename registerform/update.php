<?php
session_start();
if(isset($_SESSION['logined'])){
include ('config.php');
$id=$_GET['id'];
$sql="SELECT * FROM `register` where id='$id'";
$data=mysqli_query($conn,$sql);
$result=mysqli_num_rows($data);
$details=mysqli_fetch_assoc($data);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="style.css"> -->
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
</body>
</html>

<?php

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
                  window.location.href='display2.php';
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
                  window.location.href='display2.php';
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
