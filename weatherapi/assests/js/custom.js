$(document).ready(function () {  
    $('#weather_form').validate({
        rules: {
            city: {
                required: true,
            }
        },
        messages: {
            city: {
                required: "Please enter city name."
            }
        },
    });
});

    const cityInput = document.getElementById("weather_input");
    const suggestionList = document.getElementById("suggestionList");

    cityInput.addEventListener("input", async () => {
        const cityName = encodeURIComponent(cityInput.value);
        const response = await fetch(`https://us1.locationiq.com/v1/search.php?key=pk.e36e723eec4a9049152466c3a6e0c2df&q=${encodeURIComponent(cityName)}&format=json`);
        const data = await response.json();
        displaySuggestions(data);
    });

    function displaySuggestions(suggestions) {
    suggestionList.innerHTML = "";
    suggestions.forEach(suggestion => {
        const listItem = document.createElement("li");
        listItem.textContent = suggestion.display_name;
        listItem.addEventListener("click", () => {
        cityInput.value = suggestion.display_name;
        suggestionList.innerHTML = "";
        makeLocationRequest(suggestion.display_name);
        });
        suggestionList.appendChild(listItem);
    });
    }
    async function makeLocationRequest(cityName) {
        const response = await fetch(`https://us1.locationiq.com/v1/search.php?key=pk.e36e723eec4a9049152466c3a6e0c2df&q=${encodeURIComponent(cityName)}&format=json`);
        const data = await response.json();
        console.log(data); 
    }