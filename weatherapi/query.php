<?php
    $status="";
    $msg="";
if(isset($_POST['submit'])){
    if(!empty($_POST['city'])){
    $city=$_POST['city'];
    $api_key="49c0bad2c7458f1c76bec9654081a661";
    $api = "https://api.openweathermap.org/data/2.5/weather?q=".urlencode($city)."&appid=".$api_key; 
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $api);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $weatherData = curl_exec($curl);
    curl_close($curl);
        $weatherData=json_decode($weatherData,true);
        if($weatherData['cod']==200){
            $status="yes";
        }else{
            $status="no";
            $msg=$weatherData['message'];
        }
    }
}
?>
