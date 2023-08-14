<?php
    $status="";
if(isset($_POST['submit'])){
    if(!empty($_POST['city'])){
    $city=$_POST['city'];

    $api_key="01f3d262b72a0f5b1d9084a16f6d7b33";
    $api = "https://api.openweathermap.org/data/2.5/weather?q=".urlencode($city)."&appid=".$api_key; 
    // $api='https://api.openweathermap.org/data/2.5/weather?q=chandigarh&appid=01f3d262b72a0f5b1d9084a16f6d7b33';
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $api);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $weatherData = curl_exec($curl);
    curl_close($curl);
        $weatherData=json_decode($weatherData,true);
        if($weatherData['cod']==200){
            $status="yes";
        }else{
            $msg=$weatherData['message'];
        }
    }
}
?>