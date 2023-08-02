// delete button
function getDeleteElementId(id) {
    document.getElementById('delete-btn').setAttribute('value', id);
}



// function for password visibilty on eye click
function togglePasswordVisibility(inputId) {
    var x = document.getElementById(inputId);
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

// End set new password js

// jQuery('#registerform').validate({

//     rules:{
//         name:'required',
//         email:'required'
//     },
//     messages:{

//     }
// });
// $(document).ready(function() {
// $('#registerform').validate({
//     rules: {
//       name: 'required',
//       email: 'required',
//       password: 'required',
//     },
//     messages: {
//       // Custom error messages for each field (optional)
//       name: 'Please enter your name.',
//       email: 'Please enter a valid email address.',
//     },
//     // submitHandler:function(form){
//     //     console.log('Form successfully validated');
//     //     form.submit();
//     submitHandler: function(form) {
//         console.log('Form successfully validated');
//        console.log(form); 
//        console.log(form instanceof HTMLFormElement);
//         // This function will be called when the form is successfully validated
//         form.submit(this);
//     },
//   });
// });

// // jQuery(function(){
// $(document).ready(function() {
//     $('#registerform').validate({
//       rules: {
//       name: 'required',
//       email: 'required',
//       password: 'required',
//       },
//       messages: {
//         name: 'Please enter your name.',
//         email: 'Please enter a valid email address.',
//       },
//     //   submitHandler: function(form) {
//     //     // This function will be called when the form is successfully validated
//     //     console.log('Form successfully validated');
//     //     console.log(form); // Check the form variable
  
//     //     if (form instanceof HTMLFormElement) {
//     //       form.submit(); // Trigger the form's submission
//     //     } else {
//     //       console.error('Form variable is not a valid form element.');
//     //     }
//     //   },
//     submitHandler: function(form) {
//         console.log('Form successfully validated');
//         console.log(form); // Check the form variable
//         $(form).trigger('submit'); // Trigger the form's submission using jQuery
//       },
//     });
//   });
  

// jQuery('#registerform').on('submit',function(e){
  //   jQuery.ajax({
//       url:'login-php.php',
//       type:'post',
//       data:jQuery('#registerform').serialize(),
//       success:function(result){
  //           // alert('result');
  //       }
  //   });
  //   e.preventDefault();
  // });
// let isFormSubmitting = false; // Variable to track form submission status
  
// $('#registerform').validate({
//   rules: {
//     name: 'required',
//     email: 'required',
//     password: 'required',
//   },
//   messages: {
//     name: 'Please enter your name.',
//     email: 'Please enter a valid email address.',
//   },
//   submitHandler: function(form) {
//     if (!isFormSubmitting) {
//       console.log('Form successfully validated');
//       console.log(form); // Check the form variable

//       isFormSubmitting = true; // Mark the form as submitting to avoid the loop

//       $(form).trigger('submit'); // Trigger the form's submission using jQuery
//     } else {
//       console.log('Form is already submitting.'); // Optional: Display a message for debugging
//     }
//   },
// });


// $(document).ready(function () {
//   $("#registerform").validate({
//       // Your validation rules and messages here
//       rules: {
//         name : "required",
//         email:
//         {
//           required:true,
//           email:true,

//         },
//         image:'required',
//         phone_number:'required',
//         address: 'required',
//         password:
//         {
//           required:true,
//           minlength:8,
          
//         },
//         cpassword:{
//           required:true,
//           minlength:8,
//           equalTo:"#myInput1",
//         },
//       },
//       messages: {
//         name : "please enter name as it is a required feild",
//                 phone_number : "please enter the phone number as it is a required feild",
//                 image : "please choose an image as it is a required feild",
//                 address : "please enter address as it a  required feild",
//                 // email  : "please enter name as it is a required feild",       
//                 password:
//                 {
//                     required:"Please enter password as it is a required feild",
//                     minlength : "your password must be of 8 charcters",
//                 },

//                 cpassword:
//                 {
//                     required:"Please enter password as it is a required feild",
//                     minlength : "your password must be of 8 charcters",
//                     equalTo :"Password and confirm Password should match",
//                 }
//       },
//       submitHandler: function (form) {
//           // Form is valid, handle the form submission using AJAX
//           var formData = new FormData();
//           formData.append('name', $('#name').val());
//           formData.append('email', $('#email').val());
//           formData.append('phone_number', $('#phone_number').val());
//           formData.append('image', $('#image')[0].files[0]);
//           formData.append('password', $('#myInput1').val());
//           formData.append('cpassword', $('#myInput2').val());
//           formData.append('address', $('#address').val());
          
//           $.ajax({
//             url: 'demo-test.php', // Replace with your server-side script URL
//             type: 'POST',
//             data: formData,
//             contentType: false,
//             processData: false,
//             success: function(response) {
//               // The request was successful, and the server responded with data (if any).
//               // You can handle the server response here.
//               // console.log('Data was successfully sent to the server.');
//               // console.log(response); // Log the server response (if needed).
//               var data = JSON.parse(response);
//               if (data.success === true) {
//               // console.log('Data inserted successfully.');
//             Swal.fire({
//                       icon: 'success',
//                       title: 'success',
//                       text: 'Registration successfull',
//                       showConfirmButton: false,
//                       timer: 2500
//                   }).then(() => {
//                       window.location.href = 'login.php';  
//                   });
//               // Do something if the insertion was successful.
//               } else {
//               console.log('Failed to insert data.');
//               // Handle the case when the insertion failed.
//               Swal.fire({
//                 icon: 'error',
//                 title: 'failed',
//                 text: 'Registration failed',
//                 showConfirmButton: false,
//                 timer: 2500
//             }).then(() => {
//                 window.location.href = 'test .php';  
//             });
//               }
//             },
//               error: function (xhr, status, error) {
//                   // Handle AJAX errors here
//                   console.error('Error sending data to the server:', error);
//               }
//           });
//       }
//   });
// });





$('#submit').click(function() {
  // Create a FormData object
  var formData = new FormData();

  // Append form fields to the FormData object
  formData.append('name', $('#name').val());
  formData.append('email', $('#email').val());

  // Uncomment the following lines and add more if needed
  // formData.append('phone_number', $('#phone_number').val());
  // formData.append('image', $('#image')[0].files[0]);
  // formData.append('password', $('#myInput1').val());
  // formData.append('cpassword', $('#myInput2').val());
  // formData.append('address', $('#address').val());

  // Display form data in the console
  for (const pair of formData.entries()) {
    console.log(pair[0], pair[1]);
  }

  // Display "clicked" in the console
  console.log('clicked');
});
