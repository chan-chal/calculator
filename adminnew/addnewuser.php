         
    <?php
    session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    if(isset($_SESSION['logined'])){
        include ('include/header.php');
        include ('include/sidebar.php');
        include ('include/config.php');
    // Define variables to store form data and error messages
    $name = $phone = $email = $address = $password = $confirmPassword = '';
    $nameErr = $phoneErr = $fileErr= $emailErr = $addressErr = $passwordErr = $confirmPasswordErr = '';

    // Function to sanitize and validate input data
    function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }

    // Form submission and validation
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validate name
    if (empty($_POST['name'])) {
    $nameErr = 'Name is required';
    } else {
    $name = sanitizeInput($_POST['name']);
    // Check if name contains only letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
    $nameErr = 'Only letters and whitespace allowed';
    }
    }
    $added_session_id=$_SESSION['logined'];
    // echo  $added_session_id;
    // die;
    // Validate file upload
    if (empty($_FILES['uploadfile']['name'])) {
    $fileErr = 'File upload is required';
    } else {
    $allowedExtensions = ['jpeg', 'jpg', 'avif', 'png'];
    $uploadedFile = $_FILES['uploadfile']['name']; // Assuming you are using a file upload form
    $fileExtension = strtolower(pathinfo($uploadedFile, PATHINFO_EXTENSION));

    if (!in_array($fileExtension, $allowedExtensions)) {
    // File extension is not allowed
    $fileErr =  "Invalid file type. Only JPEG, AVIF, and PNG images are allowed.";
    // You can choose to exit the script or take other appropriate action
    }
    }

    // Validate phone
    if (empty($_POST['phone'])) {
    $phoneErr = 'Phone number is required';
    } else {
    $phone = sanitizeInput($_POST['phone']);
    if(!preg_match('/^[0-9]{10}+$/', $phone)) {
    $phoneErr="Mobile must have 10 digits";
    }
    }

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

    // Validate address
    if (empty($_POST['address'])) {
    $addressErr = 'Address is required';
    } else {
    $address = sanitizeInput($_POST['address']);
    }

    // Validate password
    if (empty($_POST['pass'])) {
    $passwordErr = 'Please fill the password';
    } else {
    $password = sanitizeInput($_POST['pass']);
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);
    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
    $passwordErr='Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
    }
    }
    // Validate confirm password
    if (empty($_POST['cpass'])) {
    $confirmPasswordErr = 'Confirm password is required';
    } else {
    $confirmPassword = sanitizeInput($_POST['cpass']);
    // Check if confirm password matches the password
    if ($confirmPassword !== $password) {
    $confirmPasswordErr = 'Password and confirm password do not match';
    }
    }

    if($_POST['email'])
    {
    $email_sql = "SELECT * FROM `register` WHERE `email`='$email'"; 
    $run = mysqli_query($conn,$email_sql);
    $count = mysqli_num_rows($run);

    if($count>0)
    {
    $emailErr="Email already exists";
    }
    else
    {
    // If there are no errors, you can proceed with further processing
    if (empty($nameErr) && empty($fileErr) && empty($phoneErr) && empty($emailErr) && empty($addressErr) && empty($passwordErr) && empty($confirmPasswordErr)) {
    $names=$_FILES['uploadfile']['name'];
    $tempname=$_FILES['uploadfile']['tmp_name'];
    $folder="images/".$names;
    move_uploaded_file($tempname,$folder);
    $sql_inst ="INSERT INTO `register` (`profile_image`,`name`,`email`,`address`,`phone`,`password`,`added_user_id`)VALUES ('$names','$name','$email','$address','$phone',md5('$password'),'$added_session_id')";
    $run = mysqli_query($conn,$sql_inst);

    if(!$run)
    {
    // echo "<script>";
    // echo "Swal.fire('Success', 'Registration successful!', 'success');";
    // echo "</script>";
    // echo "Helo";
    // header('location:register-form.php');

    echo "<script>";
    echo " Swal.fire({
    icon: 'error',
    title: 'Error',
    text: 'Unable to add!',
    showConfirmButton: false,
    timer: 2500
    }).then(() => {
    window.location.href = 'addnewuser.php';
    })";

    echo "</script>";
    }
    else{
        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        
        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'chanchalkodion@gmail.com';                     //SMTP username
            $mail->Password   = 'klgyhtbmqdqkkbam';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('chanchalkodion@gmail.com', 'Welcome');
            $mail->addAddress($email,$name);     //Add a recipient
        
            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            // $mail->Subject = 'Welcome';
            $mail->Body    = 'Welcome to Skylash.Manage your users fasters!';
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    echo "<script>";
    echo " Swal.fire({
    icon: 'success',
    title: 'Success',
    text: 'Added successfully!',
    showConfirmButton: false,
    timer: 2500
    }).then(() => {
    window.location.href = 'home_page.php';
    })";
    echo "</script>";
    }
    }
    }

    }
    }
    ?>

          <!-- partial -->
          <div class="main-panel">
        <div class="content-wrapper">

    
    <div class="container">
    <section class="bg-image">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card formmargin" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">Create an account</h2>

                                <form action="" method="POST" enctype="multipart/form-data">

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example1cg">Your Name</label>
                                        <input type="text" id="form3Example1cg" class="form-control form-control-lg"
                                            value="<?php echo $name; ?>" name="name" required />
                                        <span class="error"><?php echo $nameErr; ?></span>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example1cg">Profile Image</label>
                                        <input type="file" name="uploadfile" id="form3Example1cg"
                                            class="form-control form-control-lg" value="" required />
                                        <span class="error"><?php echo $fileErr; ?></span>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example3cg">Your Email</label>
                                        <input type="text" id="form3Example3cg" class="form-control form-control-lg"
                                            value="<?php echo $email; ?>" name="email" required />
                                        <span class="error"><?php echo $emailErr; ?></span>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example4cdg">Address</label>
                                        <input type="text" id="form3Example4cdg" class="form-control form-control-lg"
                                            value="<?php echo $address; ?>" name="address" required />
                                        <span class="error"><?php echo $addressErr; ?></span>
                                    </div>

                                    <input type="hidden" name="new" value="<?php echo $_SESSION['logined'] ?>"></input>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example4cdg">Phone Number</label>
                                        <input type="text" id="form3Example4cdg" class="form-control form-control-lg"
                                            value="<?php echo $phone; ?>" name="phone" required maxlength=10 />
                                        <span class="error"><?php echo $phoneErr; ?></span>
                                    </div>

                                    <label for="exampleInputEmail1">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="pass" id="myInput"
                                            value="<?php echo $password; ?>" required>
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="button" onclick="myFunction()"><i
                                                    class="fa fa-eye" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <span class="error"><?php echo $passwordErr; ?></span>
                                    </div>
                                    <br>

                                    <label for="exampleInputEmail1">Confirm Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="cpass" id="myInput1"
                                            name="cpass" value="<?php echo $confirmPassword; ?>" required
                                            maxlength="32">
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="button" onclick="myFunction1()"><i
                                                    class="fa fa-eye" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <span class="error"><?php echo $confirmPasswordErr; ?></span>
                                    </div>

                                    <br>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit" name="submit" class="btn btn-primary btn-block btn-md">Add account</button>
                                    </div>
                                    <br>
                                    <a href="home_page.php"><u>back</u></a>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>    

    <script>
function myFunction() {
    var x = document.getElementById("myInput");
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
    </script>

    <?php }  ?>
          
       </div>
        <!-- content-wrapper ends -->
 <?php include('include/footer.php');?>

