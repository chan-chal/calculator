<?php
  session_start();
  if(isset($_SESSION['logined'])){
      include('include/header.php');
      include('include/sidebar.php');
      ?>     
      
      <!-- partial -->
    <div class="main-panel">
    <div class="content-wrapper">
    
  <?php
  if(isset($_POST['addadmin'])){
      $id=$_POST['addadmin'];
      include('include/config.php');
    $add_admin_query="UPDATE `register` set `role`='1' WHERE `id`='$id'";
    $add_admin=mysqli_query($conn,$add_admin_query);
    if($add_admin)
    {
        echo "<script>";
        echo " Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Added successfully!',
            showConfirmButton: false,
            timer: 2500
        }).then(() => {
            window.location.href = 'admin_data.php';
        })";
        echo "</script>";
    }
    else
    {
        echo "<script>";
        echo " Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Unable to delete!',
            showConfirmButton: false,
            timer: 2500
        }).then(() => {
            window.location.href = 'home_page.php';
        })";
        
        echo "</script>";
    }
}
  ?>    
       </div>
        <!-- content-wrapper ends -->
 <?php include('include/footer.php'); } ?>