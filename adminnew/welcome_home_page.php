
          
<?php
session_start();
if(isset($_SESSION['logined'])){
    include('include/header.php');
    include('include/sidebar.php');
    include('include/config.php');
    $id = $_SESSION['logined'];
    $sql1="SELECT * FROM `register` WHERE `id`='$id'";
    $data=mysqli_query($conn,$sql1);
    $result=mysqli_num_rows($data);
    ?>
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">

    <?php while($details=mysqli_fetch_array($data)) { ?>
      <div class="container bor rounded bg-white mt-5">
        <div class="row">
            <div class="col-md-4 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5"
                        src='images/<?php echo $details['profile_image'];?>' height="150" width="150"><span
                        class="font-weight-bold"><?php echo $details['name'];?>
                    </span><span class="text-black-50" <?php echo $details['name'];?></span></div>
            </div>
            <div class="col-md-8">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex flex-row align-items-center back"><i
                                class="fa fa-long-arrow-left mr-1 mb-1"></i>
                                <a href="home_page.php" style="color:black;">Back to home</a>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><input type="text" class="form-control" placeholder="first name"
                                value="<?php echo $details['name'];?>"></div>
                        <div class="col-md-6"><input type="text" class="form-control" placeholder="address"
                                value="<?php echo $details['address'];?>"></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6"><input type="text" class="form-control" placeholder="Email"
                                value="<?php echo $details['email'];?>"></div>
                        <div class="col-md-6"><input type="text" class="form-control"
                                value="<?php echo $details['phone'];?>" placeholder="Phone number"></div>
                        <div class="mt-5 text-right"><button class="btn btn-primary profile-button" type="button"><a
                                    href='update.php?id=<?php echo $details['id'] ?>' style=color:white;
                                    class="modal-button">Edit Profile</a>
                            </button></div>
                    </div>
                </div>
            </div>
        </div>


  <?php
   } 
  }
  ?>
          
       </div>
        <!-- content-wrapper ends -->
 <?php include('include/footer.php');?>

