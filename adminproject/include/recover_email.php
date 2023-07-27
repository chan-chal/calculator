<?php
include('include/header-links.php');
session_start();
if (isset($_SESSION['logined']) && isset($_SESSION['roleid'])) {
  header('location:home_page.php');
}

function generateToken($length = 32)
{
    $bytes = random_bytes($length);
    return bin2hex($bytes);
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include('include/config.php');

// Define variables to store form data and error messages
$email = '';
$emailErr = $correctemailErr = '';

// Function to sanitize and validate input data
function sanitizeInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Form submission and validation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate email
    if (empty($_POST['email'])) {
        $emailErr = 'Email is required';
    } else {
        $email = sanitizeInput($_POST['email']);
        // Check if email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = 'Invalid email format';
        }
    }

    if (empty($emailErr) && empty($correctemailErr)) {
        $email_sql = "SELECT * FROM `register` WHERE `email`='$email'";
        $run = mysqli_query($conn, $email_sql);
        $count = mysqli_num_rows($run);
        $reset = mysqli_fetch_assoc($run);
        $user_id = $reset['id'];
        $user_email = $reset['email'];

        if ($count) {
            $token = generateToken();
            $currentDateTime = date('Y-m-d H:i:s');
            $expirationDateTime = date('Y-m-d H:i:s', strtotime('+1 hour', strtotime($currentDateTime)));
            $password_query = "INSERT INTO `password_reset`(`user_id`,`email`,`token`,`created_at`,`expiration_time`)VALUES ('$user_id','$user_email','$token','$currentDateTime','$expirationDateTime')";
            $insert_query = mysqli_query($conn, $password_query);

            if ($insert_query) {
                $resetLink = 'localhost/firstpannel/setnew_password.php?link=' . urlencode($token);
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
                    $mail->Subject = 'Password Reset Request';
                    $mail->Body    = "Click the following link to reset your password: <a href='" . $resetLink . "' target='__blank'>Click here</a>";
                    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                    $mail->send();
                    echo 'Email has been Successfully Sent!.';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                echo "please try after sometime...";
            }
        } else {
            $correctemailErr = "No such account exists!";
        }
    } else {
        $correctemailErr = "Please enter a correct email!";
    }
}
?>

<div class="container center-email">
    <div class="row">
        <div class="col-md-6 mt-5 pt-5">
            <h2 class="mb-4">Forgot Password</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="email" class="form-control" name="email" value="<?php echo $email; ?>"
                        placeholder="Enter your email">
                    <span class="error"><?php echo $emailErr; ?></span>
                </div>
                <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
                <span class="error"><?php echo $correctemailErr; ?></span>
                <p class="text-center text-muted mt-5 mb-0">Already had an account?
                    <a href="login-form.php">Login here</a>
                </p>
            </form>
        </div>
        <div class="col-6">
            <img src="https://img.freepik.com/free-vector/cyber-attack-concept-illustration_114360-2067.jpg?size=626&ext=jpg&ga=GA1.1.1841514627.1686724360&semt=ais"
                height="500px" width="500px">
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
</script>

</body>
</html>