    <?php 
    session_start();
    include('include/config.php');
    include('include/header.php');
    include('include/sidebar.php');
    if(isset($_SESSION['logined'])&& isset($_SESSION['roleid'])){
    $id = $_SESSION['logined'];
    }
    // $sql1="SELECT * FROM `register` where `status`='0' && `role`= '2' && `id`!= $id";
    $sql1="SELECT r.*, roles.role_name FROM `register` r JOIN `roles` ON r.`role` = roles.`role_id` WHERE r.`role`='2' AND r.`status` = '0' AND r.`id` != $id";
    $data=mysqli_query($conn,$sql1);
    $result=mysqli_num_rows($data);
    ?>

    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="wrapper">
                <main id="main" class="main">
                    <div class="container">
                        <div class="row">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Profile Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <?php if($_SESSION['roleid']==1){  ?>
                                        <th>Action</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($details=mysqli_fetch_array($data)) { ?>
                                    <tr scope="row">
                                        <td><img src='images/<?php echo $details['profile_image'];?>' height='80px'
                                                width='80px'></td>
                                        <td><?php echo $details['name'];?></td>
                                        <td><?php echo $details['email'];?></td>
                                        <td><?php echo $details['address'];?></td>
                                        <td><?php echo $details['phone'];?></td>
                                        <td><?php echo $details['role_name'];?></td>

                                        <?php if($_SESSION['roleid']==1){  ?>
                                        <td><button class="btn btn-secondary btn-md">
                                                <a style=color:white;
                                                    href='update.php?id=<?php echo $details['id'] ?>'>Edit</a></button>
                                            <button name="delete" class="btn btn-dark btn-md">
                                                <a style=color:white; data-toggle="modal"
                                                    data-target="#exampleModalLongg"
                                                    onclick="getDeleteElementId(<?php echo $details['id'] ?>);"
                                                    href='#'>Delete</a></button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <?php include('include/footer.php');?>