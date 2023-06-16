<?php

session_start();
if(isset($_SESSION['logined'])){
  include('config.php');
  $sql="SELECT * FROM register";
  $data=mysqli_query($conn,$sql);
  $result=mysqli_num_rows($data);
  $details=mysqli_fetch_assoc($data);
  $id = $_SESSION['logined'];
  if($result>0)
  {
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

<?php

    while($details=mysqli_fetch_assoc($data)){
    echo "<tr>
    <td>".$details['id']."</td>
    <td><img src='".$details['profile_image']."'height='100px' width='100px'></td>
    <td>".$details['name']."</td>
    <td>".$details['email']."</td>
    <td>".$details['address']."</td>
    <td>".$details['phone']."</td>
    <td><button class='btn btn-success btn-lg shadow-sm'>
    <a style='color:white;text-align:center;'href='update.php?id=$details[id]'>Update</a></button></td>
    </tr>";
    }
  }
  echo "<a href='logout.php'>Logout</a>";
}
else{
  header('location:login-form.php');
}
?>
  </table>
  </body>
  </html>


