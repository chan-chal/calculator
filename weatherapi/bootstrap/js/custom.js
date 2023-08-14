$(document).ready(function () {
    $.validator.addMethod("validCity", function(value, element) {
        var validCityPattern = /^[a-zA-Z\s\-]+$/;
        return validCityPattern.test(value.trim());
    }, "Please enter a valid city name.");
    
    $('#weather_form').validate({
        rules: {
            city: {
                required: true,
                validCity: true
            }
        },
        messages: {
            city: {
                required: "Please enter city name."
            }
        },
        submitHandler: function(form) {
            var cityInput = $('#city_input').val().trim();
            checkCityValidity(cityInput);
        }
    });
    
    function checkCityValidity(cityName) {
        // Use an AJAX request to check if the city exists in OpenWeatherMap API
        $.ajax({
            url: `https://api.openweathermap.org/data/2.5/weather?q=${cityName}&appid=01f3d262b72a0f5b1d9084a16f6d7b33`,
            method: 'GET',
            success: function(data) {
                // Handle success, show weather data or a message
                console.log(data);
                if (data.cod === 200) {
                    alert('City is valid!');
                    // Now you can proceed with form submission
                    $('#weather_form').submit();
                } else {
                    alert('City not found. Please enter a valid city name.');
                }
            },
            error: function() {
                alert('An error occurred. Please try again later.');
            }
        });
    }
});
