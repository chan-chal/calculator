<?php


$cookie_name1="snum";
$cookie_value1="";
$cookie_name2="opr";
$cookie_value2="";
if(isset($_POST['snum'])){
    $snum =$_POST['input'].$_POST['snum'];
    // echo $_POST['input'];
}
else
{
    $snum="";
}
if(isset($_POST['opr'])){
    $cookie_value1=$_POST['input'];
    echo $cookie_value1; 
    setcookie($cookie_name1,$cookie_value1,time()+(86400*30));
    
    $cookie_value2=$_POST['opr'];
    setcookie($cookie_name2,$cookie_value2,time()+(86400*30));
    $snum="";
}

if(isset($_POST['equal']))
{
    $var = isset($_COOKIE['opr'])?$_COOKIE['opr']:'';
    $snum = isset($_POST['input'])?$_POST['input']:'';
    if(isset($_COOKIE['snum']) &&  $snum != ''){
        switch($var){
            case "+":
                $final=$_COOKIE['snum']+$snum;
                break;
            case "-":
                $final=$_COOKIE['snum']-$snum;
                break;
            case "/":
                $final=$_COOKIE['snum']/$snum;
                break;
            case "*":
                $final=$_COOKIE['snum']*$snum;
                break;
            case "√":
                $final=(sqrt($_COOKIE['snum']));
        }
        $snum=$final;
    }else{
        // echo "Please enter value for ".$var;
    }

    
}

if(isset($_POST['clearlast']))
{
    $snum="";
}
if(isset($_POST['clearall']))
{
    setcookie($cookie_name1,$cookie_value1,time()-(86400*30)); 
    setcookie($cookie_name2,$cookie_value2,time()-(86400*30));
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylec.css">
    <title>Calculator</title>
</head>
<body>
    <div class="calculation">
        <form action="" method="POST">
            <input type="text" class="maininput" name="input" value="<?php echo $snum; ?>" readonly placeholder="0">
            <br>
            <input type="submit" class="oprbtn" id="spl" name="opr" value="MR">
            <input type="submit" class="oprbtn" id="spl" name="opr" value="MC">
            <input type="submit" class="oprbtn" id="spl" name="opr" value="M+">
            <input type="submit" class="oprbtn" name="opr" id="opra" value="(">
            <input type="submit" class="oprbtn" name="opr" id="opra" value=")">
            <br>
            <input type="submit" class="numbtn" name="snum" value="7">
            <input type="submit" class="numbtn" name="snum" value="8">
            <input type="submit" class="numbtn" name="snum" value="9">
            <input type="submit" class="oprbtn" name="opr" id="opra" value="/">
            <input type="submit" class="oprbtn" name="clearall" id="clean"  value="C">
            <br>
            <input type="submit" class="numbtn" name="snum" value="4">
            <input type="submit" class="numbtn" name="snum" value="5">
            <input type="submit" class="numbtn" name="snum" value="6">
            <input type="submit" class="oprbtn" name="opr" id="opra" value="*">
            <input type="submit" class="oprbtn" name="clearlast" id="cancel" value="CE">
            <br>
            <input type="submit" class="numbtn" name="snum" value="1">
            <input type="submit" class="numbtn" name="snum" value="2">
            <input type="submit" class="numbtn" name="snum" value="3">
            <input type="submit" class="oprbtn" name="opr" id="opra" value="-">
            <input type="submit" class="oprbtn" name="opr" id="opra" value="√">
            <br>
            <input type="submit" class="oprbtn" name="snum" id="opra" value="+-" disabled>
            <input type="submit" class="numbtn" name="snum" value="0">
            <input type="submit" class="numbtn" name="snum" id="opra" value=".">
            <input type="submit" class="oprbtn" name="opr" id="opra" value="+">
            <input type="submit" class="oprbtn" name="equal" id="opra" value="=">
            <br>

        </form>

        </div>
    </div>
</body>
</html>