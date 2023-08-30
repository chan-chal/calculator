<?php include('header.php') ?>
<?php include('query.php') ;
?>
<div class="background-image">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 text-center">
                <h2 class="mb-4 mt-5 text-color">Weather Check</h2>
                <form action="" method="post" id="weather_form">
                    <div class="form-group mb-3 text-color">
                        <input type="text" id="weather_input" name="city" placeholder="Enter City Name"
                            class="form-control" autocomplete="off">
                        <ul id="suggestionList"></ul>
                        <?php echo $msg; ?>
                        <p id="noMatchMessage" class="error-message" style="display: none;">No matches found.</p>
                    </div>
                    <button type="submit" name="submit" id="submit_button"
                        class="btn btn-secondary btn-md btn-block">Get Weather</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php if($status=="yes") { ?>
<div class="wrapper">
    <div class="widget-container">
        <div class="top-left">
            <h1 class="city" id="city"><?php echo  $weatherData['name'] ?></h1>
            <h2 id="day">Day</h2>
            <h3 id="date"><?php echo date('d M',$weatherData['dt']) ?></h3>
            <p class="geo"></p>
        </div>
        <div class="top-right">
            <h1 id="weather-status"><?php echo $weatherData['weather'][0]['description'];?></h1>
            <img class="weather-icon" src="https://myleschuahiock.files.wordpress.com/2016/02/sunny2.png">
        </div>
        <div class="horizontal-half-divider"></div>
        <div class="bottom-left">
            <h1 id="temperature"><?php echo round($weatherData['main']['temp']-273.15)?></h1>
            <h2 id="celsius">&degC</h2>
        </div>
        <div class="vertical-half-divider"></div>
        <div class="bottom-right">
            <div class="other-details-key">
                <p>Wind Speed</p>
                <p>Humidity</p>
            </div>
            <div class="other-details-values">
                <p class="windspeed"><?php echo  $weatherData['wind']['speed']."km" ?>/h</p>
                <p class="humidity"><?php echo $weatherData['main']['humidity']."%" ?></p>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<?php include('footer.php') ?>