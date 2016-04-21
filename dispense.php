<?php
    session_start();
    if(!isset($_SESSION['settings'])) {
        header("Location: /index.php");
    }

    //unset($_SESSION['logintoken']); To require login again.
    if(!empty($_POST) && isset($_SESSION['logintoken'])) {
        $quantity = $_POST['mealq'];
        $turl = $_SESSION['settings']['domain'] . "/api/actions";

        $auth = array(
            "authorization: bearer ".$_SESSION['logintoken'],
            "cache-control: no-cache",
            "postman-token: 21c1593f-d63d-dde3-a50c-7cbcf59ae738"
        );

        $data = array();
        $data['hub'] = $_SESSION['hubdetails']['hub']['id'];
        $data['type'] = "takeaway";
        $data['meals'] = $quantity;
        $data['drinks'] = 0;

        $murl = curl_init();
        curl_setopt($murl, CURLOPT_URL, $turl);
        curl_setopt($murl, CURLOPT_POST, sizeof($data));
        curl_setopt($murl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($murl, CURLOPT_HTTPHEADER, $auth);
        curl_setopt($murl, CURLOPT_RETURNTRANSFER, true);

        $json = curl_exec($murl);
        $json = json_decode($json,true);
        curl_close($murl);

        if(isset($json['message'])){
            $_SESSION['dispensefailed'] = $json['message'];
            header("Refresh:0");
            exit;
        }
        else {
            echo "MILANO PRE";
            //$output = shell_exec('dispense' . $quantity);
            //echo "<pre>$output</pre>";
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
        <script src="js/metro.min.js"></script>
        <script src="js/menuredirect.js"></script>
    </head>

    <body onload="startTime()">
        <div class="box">
            <?php include 'bar.php';?>

            <div class="row content" align="center" style="position: relative; height: 100%;">
                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%);">
                    <h1>Welcome!</h1>
                    <h2>Select how many meals you want to dispense:</h2>
                    <?php
                        if(isset($_SESSION['dispensefailed'])) {
                            echo "<font color='red'>". $_SESSION['dispensefailed'] ."</font><br />";
                        }
                    ?>
                    <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                        <div class="input-control text" data-role="keypad">
                            <input type="number" name="mealq" id="mealq" min="0" placeholder="Meal Quantity" style="text-align:center; font-size: 1.2em;" required>
                        </div>
                        <br />
                        <button type="Submit" class="button success" style="font-size:1.5em;"><i class="fa fa-cutlery" aria-hidden="true"> Dispense</i></button>
                    </form>
                </div>
                <?php
                if (!isset($_SESSION['logintoken'])) {
                    echo '<div id="overlay"><div style="opacity: 1;">';
                    include 'loginoverlay.php';
                    echo '</div></div>';
                }
                ?>
            </div>
        </div>
    </body>
</html>
