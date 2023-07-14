  <?php
  session_start();
  if(isset($_SESSION['logined'])){
      include('include/header.php');
      include('include/sidebar.php');
      include('include/config.php');
  ?>     
      
      <!-- partial -->
    <div class="main-panel">
    <div class="content-wrapper">
    
  <?php
  if(isset($_POST['yes'])){
      $id=$_POST['yes'];
    }
    // $sql1="DELETE FROM `register` WHERE `id`='$id'";
    $sql1="UPDATE `register` set `status`='1' WHERE `id`='$id'";
    $data=mysqli_query($conn,$sql1);
    if($data){
        echo "<script>";
        echo " Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Deleted successfully!',
            showConfirmButton: false,
            timer: 2500
        }).then(() => {
            window.location.href = 'home_page.php';
        })";
        echo "</script>";
    }
    else
    {
        // echo "failed";
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
 <?php include('include/footer.php');?>