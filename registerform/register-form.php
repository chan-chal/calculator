<!-- <!doctype html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Registeration Form</title>
  </head>
  <body>
      <h1 class="text-center">Register here!</h1>
    <div class="container text-center align-middle">
    <div>
        <label for="name">Name :</label>
        <br>
        <input type="text" value="" name="name">
    </div>
    <br>

    <div>
    <label for="email">Email :</label>
    <br>
    <input type="email" value="" name="email">
    </div> 
    <br>

    <div>
    <label for="address">Address :</label>
    <br>
    <input type="email" value="" name="address">
    </div>
    <br>

    <div>
    <label for="phone">Phone Number :</label>
    <br>
    <input type="email" value="" name="phone">
    </div>
    <br>
    <div>
        <input class="bg-primary"type="submit" value="Submit" name="submit">

    </div>
    </div>

  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    
  </body>
</html> -->

<?php
session_start();
include ('config.php');
if(isset($_SESSION['logined'])){
    header('location:display.php');
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Registeration Form</title>
  </head>
  <body>       

<section class="vh-100 bg-image"
  style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Create an account</h2>

              <form action="register.php" method="POST" enctype="multipart/form-data">

                <div class="form-outline mb-4">
                  <input type="text" id="form3Example1cg"class="form-control form-control-lg" name="name" required/>
                  <label class="form-label" for="form3Example1cg">Your Name</label>
                  
                </div>

                <div class="form-outline mb-4">
                <input type="file" name="uploadfile"id="form3Example1cg"class="form-control form-control-lg" required/>
                  <label class="form-label" for="form3Example1cg">Profile Image</label>
                </div>

                <div class="form-outline mb-4">
                  <input type="text" id="form3Example3cg" class="form-control form-control-lg" name="email" required/>
                  <label class="form-label" for="form3Example3cg">Your Email</label>
                  <span><?php if(isset($emailErr)){echo $emailErr;}?></span>
                </div>

                <div class="form-outline mb-4">
                  <input type="text" id="form3Example4cdg" class="form-control form-control-lg" name="address" required/>
                  <label class="form-label" for="form3Example4cdg">Address</label>
                </div>

                <div class="form-outline mb-4">
                  <input type="text" id="form3Example4cdg" class="form-control form-control-lg" name="phone" required/>
                  <label class="form-label" for="form3Example4cdg">Phone Number</label>
                </div>
                
                <div class="form-outline mb-4">
                  <input type="password" id="password" class="form-control form-control-lg" name="pass" value="" required />
                  <label class="form-label" for="form3Example4cg">Password</label> <br>
                  <span id="password-error" style="color:red;"></span>
                </div>

                <div class="form-outline mb-4">
                  <input type="password" id="form3Example4cdg" class="form-control form-control-lg" name="cpass" required/>
                  <label class="form-label" for="form3Example4cdg">Confirm password</label>
                </div>
                

                <!-- <div class="form-check d-flex justify-content-center mb-5">
                  <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3cg" />
                  <label class="form-check-label" for="form2Example3g">
                    I agree all statements in <a href="#!" class="text-body"><u>Terms of service</u></a>
                  </label>
                </div> -->

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
