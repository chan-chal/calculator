

<?php 
$conn = mysqli_connect('localhost','root','','p1');
include('include/header.php');
include('include/sidebar.php'); 
?>


<?php 
if(!isset($_SESSION))
{
  header('location:login-form.php');
}
else
{
  $id = $_SESSION['logined'];
}

$sql = "SELECT `password` FROM `register` WHERE `id`= '$id'";
$query = mysqli_query($conn,$sql);
if(!$query)
{
  echo "not working ";
}
else
{
  while($data=mysqli_fetch_array($query)){
    $dbpass = $data['password'];
    echo $dbpass;
    
    // exit();
  }
 

}

if(isset($_POST['submit']))
{
  $password = $_POST['password'];
 $hash= md5($password);
 echo $hash;
  if($hash == $dbpass)
  {
    $update_pass ="UPDATE `register` SET `password` = md5('$hash') WHERE `id` ='$id'" ;
    $query= mysqli_query($conn,$update_pass);
    if(!$query)
    {
      echo "query not working";
    }
    else{
      echo "password updated successfully";
    }
  }
  else
  {
    echo "not matched";
  }

}
?>


      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          
          <form action="" method="post">
            <input type="password" name="password" id="">
        
            <button type="submit" name="submit">submit</button>
          </form>

          
       </div>
        <!-- content-wrapper ends -->
 <?php include('include/footer.php');?> 