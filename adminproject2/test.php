<!-- <!doctype html>
<html lang="en">
<head> -->
    <!-- Required meta tags -->
    <!-- <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

    <!-- <title>Hello, world!</title>
</head>
<style>
.sel
{
width: 440px;
height: 46px;
}
</style>

<body>
    <section>
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card formmargin" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">Update your account</h2>

                                <form action="" method="POST" enctype="multipart/form-data" id="registerform">

                    
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example1cg">Your Name</label>
                                        <input type="text" id="form3Example1cg" class="form-control form-control-lg"
                                            name="name" value="" />
                
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example1cg"
                                            value="">Profile Image</label>
                                        <input type="file" name="uploadfile" id="form3Example1cg"
                                            class="form-control form-control-lg">

                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example3cg">Your Email</label>
                                        <input type="email" id="form3Example3cg" class="form-control form-control-lg"
                                            name="email" value="" />
                
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example4cdg">Address</label>
                                        <input type="text" id="form3Example4cdg" class="form-control form-control-lg"
                                            name="address" value="" />
                
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example4cdg">Phone Number</label>
                                        <input type="number" id="form3Example4cdg" class="form-control form-control-lg"
                                            name="phone" value="" maxlength=10 />
                                    </div>
        
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" name="update"
                                            class="btn btn-success btn-block btn-md gradient-custom-4 text-white">Update</button>
                                    </div>
                       
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"crossorigin="anonymous"> -->
    <!-- </script> -->
    <!-- <script src="bootstrap/js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
<script>
        jQuery('#registerform').on('submit',function(e){
            jQuery.ajax({
                url:'sub.php',
                type:'post',
                data:jQuery('#registerform').serialize(),
                success:function(result){
                    alert(result);
                }
            });
            e.preventDefault();
        });
</script>

</body>
</html> -->



<?php
include 'include/header-links.php';
?>
<div class="container-fluid p-5">
    <div class="row justify-content-center custom-margin">
        <div class="col-6">
            <form action="" method="POST" class="m-5 pl-5" id="registerform">
                <div class="form-group">
                    <i class="fa-regular fa-user"></i>

                    <label for="email" class="font-weight-bold" style="font-size:1.2rem;">Email</label>
                    <input type="email" name="email" id="email" class="form-control mb-4" style="width:75%;"
                        value=" " placeholder="Email">
                    <div>
                    <i class="fa-regular fa fa-key"></i>
                    <label class="font-weight-bold " style="font-size:1.2rem;">Password</label>
                    <div class="form-group mb-4" style="width: 75%;">
                        <input type="password" name="password" id="myInput8" class="form-control"
                            value="" placeholder="password" autocomplete="new_password">
                        <div class="input-group-append">
                            <span class="input-group-text bg-secondary" style="height: 38px;"><i class="fas fa-eye"
                                    onclick="togglePasswordVisibility('myInput8')"></i></span>
                        </div>
                    </div>
                    </div>
                    <button type="button" name="submit" class="btn btn-primary btn-md btn-block shadow-sm"
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
<script>
// jQuery('#registerform').on('submit',function(e){
//     jQuery.ajax({
//         url:'login-php.php',
//         type:'post',
//         data:jQuery('#registerform').serialize(),
//         success:function(result){
//             // alert('result');
//         }
//     });
//     e.preventDefault();
// });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" 
integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" 
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="include/footer.js"></script>

