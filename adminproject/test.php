<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
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

                                <form action="" method="POST" enctype="multipart/form-data">

                                    <div class="form-outline text-center">
                                        <img src="images/<?php echo $details['profile_image'] ?>" height="200px"
                                            width="170px" class="rounded-circle">
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example1cg">Your Name</label>
                                        <input type="text" id="form3Example1cg" class="form-control form-control-lg"
                                            name="name" value="<?php echo $details['name'] ?>" />
                                        <span class="error"><?php echo $nameErr; ?></span>

                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example1cg"
                                            value="<?php echo $details['profile_image'] ?>">Profile Image</label>
                                        <input type="file" name="uploadfile" id="form3Example1cg"
                                            class="form-control form-control-lg">

                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example3cg">Your Email</label>
                                        <input type="email" id="form3Example3cg" class="form-control form-control-lg"
                                            name="email" value="<?php echo $details['email'] ?>" />
                                        <span class="error"><?php echo $emailErr; ?></span>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example4cdg">Address</label>
                                        <input type="text" id="form3Example4cdg" class="form-control form-control-lg"
                                            name="address" value="<?php echo $details['address'] ?>" />
                                        <span class="error"><?php echo $addressErr; ?></span>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example4cdg">Phone Number</label>
                                        <input type="number" id="form3Example4cdg" class="form-control form-control-lg"
                                            name="phone" value="<?php echo $details['phone'] ?>" maxlength=10 />
                                        <span class="error"><?php echo $phoneErr; ?></span>
                                    </div>

                                    <!-- gpt form -->
                                    <!-- <form>
                                        <div class="form-group">
                                           <label for="inputField">Input Field:</label> -->
                                    <!-- <input type="text" class="form-control" id="inputField" name="inputField">
                                        </div>
                                    </form>  -->

                                    <!-- gpt dropdown
                                   <div class="dropdown show">
                                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Select Role
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            Add a data-value attribute to each dropdown item to store the value -->
                                    <!-- <a class="dropdown-item" href="#" data-value="Manager">Manager</a>
                                            <a class="dropdown-item" href="#" data-value="Chef">Chef</a>
                                            <a class="dropdown-item" href="#" data-value="Worker">Worker</a>
                                        </div>
                                    </div>  -->

                                    <select class="sel">
                                        <option selected disabled>Select Role</option>
                                        <option value="1">Manager</option>
                                        <option value="2">Chef</option>
                                        <option value="3">Worker</option>
                                    </select>                                    

                                    <br>
                                    <br>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" name="update"
                                            class="btn btn-success btn-block btn-md gradient-custom-4 text-white">Update</button>
                                    </div>
                                    <br>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" name="passs"
                                            class="btn btn-primary btn-block btn-md gradient-custom-4"><a
                                                style="color:white;text-decoration:none;"
                                                href="password_update.php?id=<?php echo $details['id'] ?>">Update
                                                password</a></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>

<script>
// Get the dropdown menu items
const dropdownItems = document.querySelectorAll('.dropdown-item');

// Add click event listener to each dropdown item
dropdownItems.forEach(item => {
    item.addEventListener('click', function() {
        // Get the selected value from the data-value attribute
        const selectedValue = this.getAttribute('data-value');

        // Update the input field with the selected value
        document.getElementById('inputField').value = selectedValue;
    });
});
</script>