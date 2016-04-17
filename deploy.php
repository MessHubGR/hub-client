<?php
session_start();
if(!empty($_POST)){
    //echo '<div id="overlay"><div class="loader more"></div></div>';
    $furl="http://40.68.43.138/api/hubs/deploy";
    $turl="http://40.68.43.138/api/authenticate";

    $stupidtokens = array();
    $stupidtokens['username'] = 'admin';
    $stupidtokens['password'] = 'admin';

    $murl = curl_init();
    curl_setopt($murl, CURLOPT_URL, $turl);
    curl_setopt($murl,CURLOPT_POST, sizeof($stupidtokens));
    curl_setopt($murl, CURLOPT_POSTFIELDS, $stupidtokens);
    curl_setopt($murl, CURLOPT_RETURNTRANSFER, true);

    $json = curl_exec($murl);
    $json = json_decode($json,true);
    curl_close($murl);

    $data = array();
    $data['key'] = $_POST['keyin'];
    $data['capacity_meals'] = $_POST['meals'];
    $data['capacity_drinks'] = $_POST['drinks'];

    $auth = array(
        "authorization: bearer " . $json['token'],
        "cache-control: no-cache",
        "postman-token: b548747a-18cc-015c-0f6c-217d33d41334"
    );

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $furl);
    curl_setopt($curl,CURLOPT_POST, sizeof($data));
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $auth);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);

    if(strpos($result, 'active')!== false){//CLEANUP
        file_put_contents("/saves/hubdetails.json",$result);
        $_SESSION['deployed'] = true;
        $_SESSION['failedtodeploy'] = false;
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'index.php';
        header("Location: http://$host$uri/$extra");
    }
    else{
        header("Refresh:0");
        $_SESSION['deployed'] = false;
        $_SESSION['failedtodeploy'] = true;
    }
}
?>

<html>
<head>
    <title>MessHub</title>
    <link href="css/metro.min.css" rel="stylesheet" type="text/css">
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/flex.css" rel="stylesheet" type="text/css">
    <link href="css/menus.css" rel="stylesheet" type="text/css">
    <link href="css/flag-icon.min.css" rel="stylesheet" type="text/css">
    <link href="css/loader.css" rel="stylesheet" type="text/css">

    <script src="js/clock.js"></script>
    <script src="js/overlay.js"></script>
</head>

<body onload="startTime(); loading()">
    <div class="box">
        <?php include 'bar.php';?>

        <div class="row content" align="center" style="position: relative; height: 100%;">
            <div style="position: absolute; top: 45%; left: 50%; transform: translate(-50%,-50%);">
                <span style="font-size: 4em; color: #B0BAC4;">Welcome to</span>
                <br />
                <span style="font-size: 5em; color: #22A7F0;">MessHub</span>
                <hr style="width:60em;">
                <br />
                <p style="font-size: 1.5em;">
                    This hub is not deployed.<br />
                    Please register it at the dashboard and fill out the form below.
                </p>
                <?php
                if(isset($_SESSION['failedtodeploy']) && $_SESSION['failedtodeploy']){
                    echo "<b>Please try again.</b><br />";
                }
                ?>
                <br />
                <form method="POST" action="deploy.php">
                    <div class="input-control text">
                        <label for="keyin" style="font-size: 1.2em;">Hub's Registration Key</label>
                        <input type="text" name="keyin" id="keyin" maxlength="16" placeholder="Hub Key" style="text-align:center; font-size: 1.2em;" required>
                    </div>
                    <br />
                    <br />
                    <div class="input-control text">
                        <label for="meals" style="font-size: 1.2em;">Meals Capacity</label>
                        <input type="number" name="meals" id="meals" min="0" placeholder="Meals Capacity" style="text-align:center; font-size: 1.2em;" required>
                    </div>
                    <br />
                    <br />
                    <div class="input-control text">
                        <label for="bottles" style="font-size: 1.2em;">Bottles Capacity</label>
                        <input type="number" name="drinks" id="drinks" min="0" placeholder="Bottles Capacity" style="text-align:center; font-size: 1.2em;" required>
                    </div>
                    <br />
                    <button type="Submit" class="button success" style="font-size:1.5em;"><i class="fa fa-check">Deploy</i></button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
