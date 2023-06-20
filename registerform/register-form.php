

<?php
session_start();
include ('config.php');
if(isset($_SESSION['logined'])){
    header('location:display2.php');
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <title>Registeration Form</title>
  </head>
  <body>       
<section class="vh-100 bg-image">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Create an account</h2>

              <form action="register.php" method="POST" enctype="multipart/form-data">

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example1cg">Your Name</label>
                  <input type="text" id="form3Example1cg"class="form-control form-control-lg" name="name" required/>
                  
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example1cg">Profile Image</label>
                <input type="file" name="uploadfile"id="form3Example1cg"class="form-control form-control-lg" required/>
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example3cg">Your Email</label>
                  <input type="text" id="form3Example3cg" class="form-control form-control-lg" name="email" required/>
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4cdg">Address</label>
                  <input type="text" id="form3Example4cdg" class="form-control form-control-lg" name="address" required/>
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4cdg">Phone Number</label>
                  <input type="text" id="form3Example4cdg" class="form-control form-control-lg" name="phone" required maxlength="10"/>
                </div>
                
                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4cg">Password</label> <br>
                  <input type="password" id="password" class="form-control form-control-lg" name="pass" value="" required />
                  <span id="password-error" style="color:red;"></span>
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4cdg">Confirm password</label>
                  <input type="password" id="form3Example4cdg" class="form-control form-control-lg" name="cpass" required/>
                </div>
              
                <div class="d-flex justify-content-center">
                  <button type="submit" name="submit"
                    class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
                </div>

                <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="login-form.php"
                    class="fw-bold text-body"><u>Login here</u></a></p>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  // function NameCheck(){
  // console.log('namecheck function called');
  // }
  // function PasswordCheck(){
  //   console.log('Password function called');
  //     value=document.getElementById('password').value;
  //     console.log(value);
  //     if(value.length <6){
  //       console.log('length of password must be greater than 6 character!');
  //       document.getElementById('password-error').innerText="length of password must be greater than 6 character!";
  //     }else{
  //       document.getElementById('password-error').innerText="";

  //     }
  
  // }
</script>

</body>
</html>
