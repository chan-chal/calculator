<!-- #4B49AC -->
<?php
include 'include/header-links.php';
include 'include/config.php';
session_start();

if (isset($_SESSION['logined']) && isset($_SESSION['roleid'])) {
    header('location:home_page.php');
}

// Define variables to store form data and error messages
$email = $password = '';
$emailErr = $passwordErr = '';

// Function to sanitize and validate input data
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

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

    if (empty($_POST['password'])) {
        $passwordErr = 'Password is required';
    } else {
        $password = sanitizeInput($_POST['password']);
    }

    if (empty($emailErr) && empty($passwordErr)) {
        $sql = "SELECT * FROM `register` WHERE `role` IN(1,2,3,4) && `email`='$email' && `password`= md5('$password') && `status`='0'";
        $result = mysqli_query($conn, $sql);
        $session_id = "";
        foreach ($result as $value) {
            $session_id = $value['id'];
            $role = $value['role'];
        }
        $res = mysqli_num_rows($result);
        if ($res > 0) {
            $_SESSION['logined'] = $session_id;
            $role_query = "SELECT role_id FROM `roles` where `role_id`='$role'";
            $role = mysqli_query($conn, $role_query);
            $dat = mysqli_fetch_assoc($role);
            $_SESSION['roleid'] = $dat['role_id'];

            // success swal
                    $title='Success';
                    $text='Login successful!';
                    $redirection='home_page.php';
                    include('success-swal.php');
        } else {
            // failure swal
                    $title='Login';
                    $text='Login Failed!';
                    $redirection='login-form.php';
                    include('failed-swal.php');

        }
    }
}
?>

<div class="container-fluid p-5">
    <div class="row justify-content-center custom-margin">
        <div class="col-6">
            <form action="" method="POST" class="m-5 pl-5">
                <div class="form-group">
                    <i class="fa-regular fa-user"></i>

                    <label for="email" class="font-weight-bold" style="font-size:1.2rem;">Email</label>
                    <input type="email" name="email" id="email" class="form-control mb-4" style="width:75%;"
                        value="<?php echo $email; ?> " placeholder="Email">
                    <div>
                        <span class="error"><?php echo $emailErr; ?></span>
                    </div>
                    <i class="fa-regular fa fa-key"></i>
                    <label class="font-weight-bold " style="font-size:1.2rem;">Password</label>
                    <div class="input-group mb-4" style="width: 75%;">
                        <input type="password" name="password" id="myInput8" class="form-control"
                            value="<?php echo $password; ?>" placeholder="password">
                        <div class="input-group-append">
                            <span class="input-group-text bg-secondary" style="height: 38px;"><i class="fas fa-eye"
                                    onclick="togglePasswordVisibility('myInput8')"></i></span>
                        </div>
                    </div>
                    <div class="row">
                        <span class="error"><?php  echo $passwordErr; ?></span>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary btn-md btn-block shadow-sm"
                        style="width:75%;">Login</button>
            </form>
            <p class="text-center text-muted mt-5 mb-0" style="font-size:1.2rem;width:75%;">Forgot password? <a
                    href="recover_email.php">Click here</a></p>
        </div>
    </div>
    <div class="col-6">
        <img src="https://i.imgur.com/uNGdWHi.png" class="img-fluid" style="height:500px;">
    </div>
</div>
</div>

<script src="include/footer.js"></script>