<?php

session_start();
if(isset($_SESSION['logined'])){
  include('config.php');
  $email = $_SESSION['logined'];
  $sql1="SELECT * FROM `register` WHERE `email`='$email'";
  $data=mysqli_query($conn,$sql1);
  $result=mysqli_num_rows($data);
//   $details=mysqli_fetch_assoc($data);
  // echo $details;
  // print_r ($details);
//   if($result>0)
//   {
//     echo "data avalible";
//   }
//   else
//   {
//     echo "data not found";
//   }  
  ?>
<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Welcome</title>
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


  <h1 style="text-align:center">Welcome</h1>
  <table class="table">
    <thead>
      <tr>
      <th scope="col">Id</th>
      <th scope="col">Profile Image</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Address</th>
      <th scope="col">Phone</th>
      <th scope="col">Action</th>
      </tr>
    </thead>

<!-- while loop to fetch data from database  -->
<?php while($details=mysqli_fetch_array($data)) { ?>
    <tr>
    <td><?php echo $details['id'];?></td>
    <td><img src='<?php echo $details['profile_image'];?>' height='100px' width='100px'></td>
    <td><?php echo $details['name'];?></td>
    <td><?php echo $details['email'];?></td>
    <td><?php echo $details['address'];?></td>
    <td><?php echo $details['phone'];?></td>
    
    <td><button class='btn btn-success btn-lg shadow-sm'>
    <a style='color:white;text-align:center;' href='update.php?id=<?php echo $details['id'] ?>'>Update</a></button></td>
    </tr>
<?php } }?>

  </table>
  </body>
  </html>