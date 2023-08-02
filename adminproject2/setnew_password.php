<?php
 include('include/header-links.php');
include('include/config.php');
$_link = $_GET['link'];
$sql = "SELECT * FROM `password_reset` WHERE `token`='$_link'";
$data = mysqli_query($conn, $sql);
$details = mysqli_fetch_assoc($data);
$expire_time = $details['expiration_time'];
$_userid = $details['user_id'];
$email = $details['email'];
$currentDateTime = date('Y-m-d H:i:s');
$newpassword = $renewpassword = '';
$newpassErr = $renewpasswordErr = '';

// Function to sanitize and validate input data
function sanitizeInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if ($currentDateTime < $expire_time) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

        if (empty($newpassErr) && empty($renewpasswordErr)) {
            $newpassword = md5($newpassword);
            $update = "UPDATE `register`
            JOIN `password_reset` ON `register`.id = `password_reset`.user_id
            SET `register`.password = '$newpassword', `password_reset`.used = 1
            WHERE `password_reset`.token = '$_link' AND `password_reset`.used = 0";
            $result = mysqli_query($conn, $update);
            $affectedRows = mysqli_affected_rows($conn);

            if ($affectedRows > 0) {
                    $title='Success';
                    $text='Password changed successfully!';
                    $redirection='';
                    include('success-swal.php');
                $body='Your password has been changed successfully.';
                $subject='Reset password';
                $name='';
                include('php-mailer.php');
            } else {
                header('location:error-500.html');
            }
        }
    }
} else {
    echo "Your link has been expired.";
}
?>

    <section>
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card formmargin" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">Update your password</h2>
                                <form action="" method="POST">

                                    <i class="fa-regular fa-key"></i>
                                    <label class="font-weight-bold">New password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="newpass" id="myInput4"
                                            placeholder="New password" value="" required maxlength="32">
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="button" onclick="togglePasswordVisibility('myInput4')"><i
                                                    class="fa fa-eye" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <span class="error"><?php echo $newpassErr; ?></span>
                                    </div>
                                    <br>

                                    <i class="fa-regular fa-key"></i>
                                    <label class="font-weight-bold">Confirm Newpassword</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="renewpass" id="myInput5"
                                            value="" placeholder="Confirm Newpassword" required maxlength="32">
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="button" onclick="togglePasswordVisibility('myInput5')"><i
                                                    class="fa fa-eye" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <span class="error"><?php echo $renewpasswordErr; ?></span>
                                    </div>
                                    <br>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit" name="update"
                                            class="btn btn-success btn-block btn-md gradient-custom-4 "><a
                                                style="color:white;text-decoration:none;"
                                                class="modal-button">Submit</a></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script src="include/footer.js"></script>
</body>
</html>

