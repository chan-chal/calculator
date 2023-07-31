<?php
session_start();
include('include/config.php');
include('include/header.php');
include('include/sidebar.php');

if (isset($_SESSION['logined']) && isset($_SESSION['roleid'])) {
    $id = $_GET['id'];
    $sql = "SELECT password FROM `register` WHERE id='$id'";
    $data = mysqli_query($conn, $sql);
    $result = mysqli_num_rows($data);
    $details = mysqli_fetch_assoc($data);

    $oldpassword = $newpassword = $renewpassword = '';
    $oldpassErr = $newpassErr = $renewpasswordErr = '';

    // Function to sanitize and validate input data
    function sanitizeInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // old password
        if (empty($_POST['oldpass'])) {
            $oldpassErr = 'Please fill the password';
        } else {
            $oldpassword = sanitizeInput($_POST['oldpass']);
            if (md5($oldpassword) != $details['password']) {
                $oldpassErr = "Wrong password";
            }
        }

        // new password
        if (empty($_POST['newpass'])) {
            $newpassErr = 'Please fill the password';
        } else {
            $newpassword = sanitizeInput($_POST['newpass']);
            $uppercase = preg_match('@[A-Z]@', $newpassword);
            $lowercase = preg_match('@[a-z]@', $newpassword);
            $number = preg_match('@[0-9]@', $newpassword);
            $specialChars = preg_match('@[^\w]@', $newpassword);
            if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($newpassword) < 8) {
                $newpassErr = 'Password should be at least 8 characters in length and should include at least one uppercase letter, one number, and one special character.';
            }
        }

        // confirm new password
        if (empty($_POST['renewpass'])) {
            $renewpasswordErr = 'Please fill the password';
        } else {
            $renewpassword = sanitizeInput($_POST['renewpass']);
            if ($newpassword !== $renewpassword) {
                $renewpasswordErr = 'Password and confirm password do not match';
            }
        }

        if ($oldpassword == $renewpassword) {
            $renewpasswordErr = 'New password cannot be the same as the old password';
        }

        if (empty($oldpassErr) && empty($newpassErr) && empty($renewpasswordErr)) {
            $newpassword = md5($newpassword);
            $update = "UPDATE `register` SET `password` = '$newpassword' WHERE `id`='$id'";
            $result = mysqli_query($conn, $update);

            if ($result) {
                        $title='Success';
                        $text='Password Updated successfully!';
                        $redirection='all_user_page.php';
                        include('success-swal.php');
            } else {
                echo "Unable to Update Password";
            }
        }
    }
}
?>

<!-- Partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <!-- Update form -->
        <section>
            <div class="mask d-flex align-items-center h-100 gradient-custom-3">
                <div class="container h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                            <div class="card formmargin" style="border-radius: 15px;">
                                <div class="card-body p-5">
                                    <h2 class="text-uppercase text-center mb-5">Update Your Password</h2>
                                    <form action="" method="POST">
                                        <label for="myInput3" class="font-weight-bold">Old Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="oldpass" id="myInput3"
                                                placeholder="Old Password" required maxlength="32">
                                            <div class="input-group-append">
                                                <button class="btn btn-secondary" type="button"
                                                    onclick="togglePasswordVisibility('myInput3')">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <span class="error"><?php echo $oldpassErr; ?></span>
                                        </div>
                                        <br>

                                        <label for="myInput1" class="font-weight-bold">New Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="newpass" id="myInput1"
                                                placeholder="New Password" required maxlength="32">
                                            <div class="input-group-append">
                                                <button class="btn btn-secondary" type="button"
                                                    onclick="togglePasswordVisibility('myInput1')">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <span class="error"><?php echo $newpassErr; ?></span>
                                        </div>
                                        <br>

                                        <label for="myInput2" class="font-weight-bold">Confirm New Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="renewpass" id="myInput2"
                                                placeholder="Confirm New Password" required maxlength="32">
                                            <div class="input-group-append">
                                                <button class="btn btn-secondary" type="button"
                                                    onclick="togglePasswordVisibility('myInput2')">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <span class="error"><?php echo $renewpasswordErr; ?></span>
                                        </div>
                                        <br>

                                        <div class="d-flex justify-content-center">
                                            <button type="submit" name="update"
                                                class="btn btn-success btn-block btn-md gradient-custom-4">Update Password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <!-- content-wrapper ends -->
</div>
<script src="include/footer.js"></script>
