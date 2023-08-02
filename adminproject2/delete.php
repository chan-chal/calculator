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
    $sql1="UPDATE `register` set `status`='1' WHERE `id`='$id'";
    $data=mysqli_query($conn,$sql1);
    if($data){
        $text="Deleted Successfully!";
        $title="Success";
        $redirection='all_user_page.php';
    include('success-swal.php');
    }
    else
    {
        $text="Unable to delete!";
        $title="Error";
        $redirection='all_user_page.php';
    include('failed-swal.php');    
    }
}
  ?> 
       </div>
        <!-- content-wrapper ends -->
 <?php include('include/footer.php');?>