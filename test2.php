<?php
// comment
session_start();
if(isset($_SESSION['logined'])){
  include('config.php');
  $id = $_SESSION['logined'];
  $sql1="SELECT * FROM `register` where `status`='0' && `id`!= $id ";
  $data=mysqli_query($conn,$sql1);
  $result=mysqli_num_rows($data);
  ?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Welcome</title>
</head>

<body>
    <?php include('header.php') ?>
    <div class="container-fluid text-center">

        <h1 style="text-align:center">Welcome</h1>
        <table class="table">
            <thead>
                <tr>
                    <!-- <th scope="col">Id</th> -->
                    <th scope="col">Profile Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Address</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>

            <!-- while loop to fetch data from database  -->
            <tbody>
                <?php while($details=mysqli_fetch_array($data)) { ?>
                <tr scope="row">
                    <td><img src='images/<?php echo $details['profile_image'];?>' height='80px' width='80px'></td>
                    <td><?php echo $details['name'];?></td>
                    <td><?php echo $details['email'];?></td>
                    <td><?php echo $details['address'];?></td>
                    <td><?php echo $details['phone'];?></td>

                    <td><button class="btn btn-success btn-lg">
                            <a style=color:white; href='update.php?id=<?php echo $details['id'] ?>'>Edit</a></button>
                        <!-- <button name="delete" class="btn btn-danger btn-lg"> -->
                        <!-- <a style=color:white; data-toggle="modal" data-target="#exampleModalLongg" href='delete.php?id='>Delete</a></button></td> -->
                        <button name="delete" class="btn btn-danger btn-lg">
                            <a style=color:white; data-toggle="modal" data-target="#exampleModalLongg"
                                onclick="getDeleteElementId(<?php echo $details['id'] ?>);" href='#'>Delete</a></button>
                    </td>

                </tr>

                <?php } }?>
            </tbody>
        </table>

    </div>
    <!-- modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Are you sure?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Do you really want to logout?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success text-white" data-dismiss="modal"><a href="display.php"
                            class="modal-button">No</a></button>
                    <button type="button" class="btn btn-danger text-white"><a class="modal-button"
                            href="logout.php">Yes</a></button>
                </div>
            </div>
        </div>
    </div>

    <!--Delete modal -->
    <div class="modal fade" id="exampleModalLongg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLonggTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLonggTitle">Are you sure?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Do you really want to delete this account?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success text-white" data-dismiss="modal"
                        href="alldata.php">No</button>
                    <form action="delete.php" method="POST">
                        <input type="hidden" name="yes" value="" id="delete-btn">
                        <button type="submit" class="btn btn-success text-white modal-button">Yes</button>
                    </form>
                    <!-- <form action="delete.php" method="POST"> -->
                    <!-- <button type="button" class="btn btn-success text-white" data-dismiss="modal" ><a href="alldata.php"class="modal-button">No</a></button> -->
                    <!-- <button type="button" class="btn btn-danger text-white" ><a class="modal-button" name="yes" href='delete.php?id='>Yes</a></button> -->
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </div>
    <script>
    function getDeleteElementId(id) {
        document.getElementById('delete-btn').setAttribute('value', id);
        // console.log(document.getElementById('delete-btn'));  
    }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
</body>

</html>



<!-- only show particular data added by particular user -->

<?php
// comment
session_start();
if(isset($_SESSION['logined'])){
  include('config.php');
  $id = $_SESSION['logined'];
  $sql1="SELECT * FROM `register` where `status`='0' && `id`!= $id && `added_user_id`=$id";
//   echo $sql1;
//   die;
  $data=mysqli_query($conn,$sql1);
  $result=mysqli_num_rows($data);
  ?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Welcome</title>
</head>

<body>
    <?php include('header.php') ?>
    <div class="container-fluid text-center">

        <h1 style="text-align:center">Welcome</h1>
        <table class="table">
            <thead>
                <tr>
                    <!-- <th scope="col">Id</th> -->
                    <th scope="col">Profile Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Address</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>

            <!-- while loop to fetch data from database  -->
            <tbody>
                <?php while($details=mysqli_fetch_array($data)) { ?>
                <tr scope="row">
                    <td><img src='images/<?php echo $details['profile_image'];?>' height='80px' width='80px'></td>
                    <td><?php echo $details['name'];?></td>
                    <td><?php echo $details['email'];?></td>
                    <td><?php echo $details['address'];?></td>
                    <td><?php echo $details['phone'];?></td>

                    <td><button class="btn btn-success btn-lg">
                            <a style=color:white; href='update.php?id=<?php echo $details['id'] ?>'>Edit</a></button>
                        <!-- <button name="delete" class="btn btn-danger btn-lg"> -->
                        <!-- <a style=color:white; data-toggle="modal" data-target="#exampleModalLongg" href='delete.php?id='>Delete</a></button></td> -->
                        <button name="delete" class="btn btn-danger btn-lg">
                            <a style=color:white; data-toggle="modal" data-target="#exampleModalLongg"
                                onclick="getDeleteElementId(<?php echo $details['id'] ?>);" href='#'>Delete</a></button>
                    </td>

                </tr>

                <?php } }?>
            </tbody>
        </table>

    </div>
    <!-- modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Are you sure?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Do you really want to logout?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success text-white" data-dismiss="modal"><a href="display.php"
                            class="modal-button">No</a></button>
                    <button type="button" class="btn btn-danger text-white"><a class="modal-button"
                            href="logout.php">Yes</a></button>
                </div>
            </div>
        </div>
    </div>

    <!--Delete modal -->
    <div class="modal fade" id="exampleModalLongg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLonggTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLonggTitle">Are you sure?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Do you really want to delete this account?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success text-white" data-dismiss="modal"
                        href="alldata.php">No</button>
                    <form action="delete.php" method="POST">
                        <input type="hidden" name="yes" value="" id="delete-btn">
                        <button type="submit" class="btn btn-success text-white modal-button">Yes</button>
                    </form>
                    <!-- <form action="delete.php" method="POST"> -->
                    <!-- <button type="button" class="btn btn-success text-white" data-dismiss="modal" ><a href="alldata.php"class="modal-button">No</a></button> -->
                    <!-- <button type="button" class="btn btn-danger text-white" ><a class="modal-button" name="yes" href='delete.php?id='>Yes</a></button> -->
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </div>
    <script>
    function getDeleteElementId(id) {
        document.getElementById('delete-btn').setAttribute('value', id);
        // console.log(document.getElementById('delete-btn'));  
    }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
</body>

</html>