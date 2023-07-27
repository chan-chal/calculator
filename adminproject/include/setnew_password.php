<?php
 include('include/header-links.php');
include('include/config.php');
$_link = $_GET['link'];
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
                echo "<script>";
                echo "Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Password changed successfully!',
                    showConfirmButton: false,
                    timer: 2500
                  })";
                echo "</script>";

                require 'PHPMailer/src/Exception.php';
                require 'PHPMailer/src/PHPMailer.php';
                require 'PHPMailer/src/SMTP.php';
                // Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try {
                    // Server settings
                    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                      //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                  //Enable SMTP authentication
                    $mail->Username   = 'chanchalkodion@gmail.com';            //SMTP username
                    $mail->Password   = 'klgyhtbmqdqkkbam';                    //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           //Enable implicit TLS encryption
                    $mail->Port       = 465;                                  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                    //Recipients
                    $mail->setFrom('chanchalkodion@gmail.com', 'Welcome');
                    $mail->addAddress($email);                                 //Add a recipient

                    //Attachments
                    // $mail->addAttachment('/var/tmp/file.tar.gz');            //Add attachments
                    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');       //Optional name

                    //Content
                    $mail->isHTML(true);                                      //Set email format to HTML
                    $mail->Subject = 'Reset password';
                    $mail->Body    = "Your password has been changed successfully.";
                    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                    $mail->send();
                    echo 'Please check your email';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                // echo "Password update failed. Link may be invalid or has already been used.";
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
                                        <input type="password" class="form-control" name="newpass" id="myInput1"
                                            placeholder="New password" value="" required maxlength="32">
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="button" onclick="myFunction1()"><i
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
                                        <input type="password" class="form-control" name="renewpass" id="myInput2"
                                            value="" placeholder="Confirm Newpassword" required maxlength="32">
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="button" onclick="myFunction2()"><i
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
</body>

</html>


<script>
function myFunction3() {
    var x = document.getElementById("myInput3");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

function myFunction1() {
    var x = document.getElementById("myInput1");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

function myFunction2() {
    var x = document.getElementById("myInput2");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
</script>