<?php
session_start();
if (isset($_SESSION['logined']) && isset($_SESSION['roleid'])) {
    include('include/header.php');
    include('include/sidebar.php');
?>

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <?php
        if (isset($_POST['remove'])) {
            $id = $_POST['remove'];
            //   echo $id;
            include('include/config.php');
            $remove_admin_query = "UPDATE `register` SET `role`='0' WHERE `id`='$id'";
            // echo $remove_admin_query;
            $remove_admin = mysqli_query($conn, $remove_admin_query);
            if ($remove_admin) {
                echo "<script>";
                echo "Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Removed successfully!',
                        showConfirmButton: false,
                        timer: 2500
                    }).then(() => {
                        window.location.href = 'admin_data.php';
                    });";
                echo "</script>";
            } else {
                // echo "failed";
                echo "<script>";
                echo "Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Unable to delete!',
                        showConfirmButton: false,
                        timer: 2500
                    }).then(() => {
                        window.location.href = 'all_user_page.php';
                    });";
                echo "</script>";
            }
        }
        ?>
    </div>
    <!-- content-wrapper ends -->
    <?php include('include/footer.php');
}
?>
