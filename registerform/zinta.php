<?php
$conn = mysqli_connect('localhost','root','','tatto_blazers');
    // Define variables and set to empty values
    $nameErr = $emailErr = $passwordErr = "";
    $name = $email = $password = $address =$phone = "";
    $conpassErr = "";
    $phoneErr="";
    $addErr="";
    $imageErr="";

    // Function to sanitize and validate input data
    function sanitize_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Process form data on submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate name
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = sanitize_input($_POST["name"]);
            // Check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                $nameErr = "Only letters and white space allowed";
            }
        }

        // Validate email
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = sanitize_input($_POST["email"]);
            // Check if email is valid
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }

        // Validate password
        if (empty($_POST["password"])) {
            $passwordErr = "Password is required";
        } else {
            $password = sanitize_input($_POST["password"]);
            // Check if password is strong (at least 8 characters, contains a lowercase letter, an uppercase letter, and a number)
            if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/", $password)) {
                $passwordErr = "Password must be at least 8 characters long and contain at least one lowercase letter, one uppercase letter, and one number";
            }
        }
        if(empty($_POST['cpassword']))
        {
            $passwordErr="password is required";
        }
        else
        {
            if($_POST['password']!==$_POST['cpassword'])
            {
                $conpassErr ="password did not matched";
            } 
        }

        if(empty($_POST['address']))
        {
            $addErr ="address is required";
        }
        if (empty($_POST["address"])) {
            $addErr = "address is required";
        } else {
            $address = sanitize_input($_POST["address"]);
            // // Check if address is valid
            // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //     $addErr = "Invalid email format";
            // }
        }
        if (empty($_POST["phone_number"])) {
            $phoneErr = "phone is required";
        } else {
            $phone = sanitize_input($_POST["phone_number"]);
            // Check if contact is valid
            if ($phone !=10) {
                $phoneErr = "Invalid phone number";
            }
        }

        if($_POST['email'])
        {
            $email_sql = "SELECT * FROM `blazers_data` WHERE `email`='$email'"; 
            $run = mysqli_query($conn,$email_sql);
            $count = mysqli_num_rows($run);
    
            if($count>0)
            {
            // echo "<script>alert('The email alreay exists');</script>";
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('Email alreay exits');
            window.location.href='register-form.php';
            </script>");
            }
            else
            {
  
        // If all validations pass, you can perform further actions like storing data in a database
        if ($nameErr == "" && $emailErr == "" && $passwordErr == "" && $addErr =="" && $conpassErr=="" && $phoneErr =="") {
            $sql = "INSERT INTO `blazers_data`(`name`,`email`,`address`,`contact`,`user_image`,`password`) VALUES ('$name','$email','$address','$phone','$password')";
                            $run =mysqli_query($conn,$sql);
                            if(!$run){
                            echo ("<script LANGUAGE='JavaScript'>
                            window.alert('Something went wrong please try again');
                            window.location.href='register-form.html';
                            </script>");
                            }
                            else
                            {
                            echo ("<script LANGUAGE='JavaScript'>
                            window.alert('Registraion Successfull');
                            window.location.href='login.html';
                            </script>");
                            }

        }

        }
            
        }  
    }
    ?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Register-Tatto BlazeRs</title>
    <style>
        .error { color: red; }
    </style>
</head>

<body>
    <div class="container my-5">
        <div class="row">
            <div class="col-6">
                <img src="https://images.unsplash.com/photo-1655069482983-d87066eefd01?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dGF0dG9vfGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60" alt="">
            </div>
            <div class="col-6" id="form">
                <h1 class="text-center">Welcome to Tatto BlazeRs</h1>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required value="<?php echo $name ?>">
        <span class="error"><?php echo $nameErr; ?></span>

                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required value="<?php echo $email ?>">
        <span class="error"><?php echo $emailErr; ?></span>

                    </div>
                    <div class="form-group">
                        <label for="Address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" required value="<?php echo $address ?>">
        <span class="error"><?php echo $addErr; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" required maxlength="10" minlength="10" value="<?php echo $phone ?>">
        <span class="error"><?php echo $phoneErr; ?></span>

                    </div>
                    <div class="form-group">
                        <label for="image">User Image</label>
                        <input type="file" class="form-control" id="image" name="image" required>
        <span class="error"><?php echo $imageErr; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required maxlength="10">
        <span class="error"><?php echo $passwordErr; ?></span>

                    </div>
                    <div class="form-group">
                        <label for="cpassword">Confirm Password</label>
                        <input type="password" class="form-control" id="cpassword" name="cpassword" required maxlength="10">
        <span class="error"><?php echo $conpassErr; ?></span>

                    </div>
                    <button type="submit" class="btn btn-dark btn-lg btn-block" name="register">Register</button>
                    <p class="text-center my-3">Already Registered <a href="login.html">Login Here</a></p>
                </form>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
    <div class="container">


        <footer class="bg-light text-center text-lg-start">
            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                © 2023 Copyright:
                <a class="text-dark" href="">Tatto BlazeRs.com</a>
            </div>
            <!-- Copyright -->
        </footer>
    </div>
</body>

</html>

<?php 









?>