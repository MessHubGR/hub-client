<?php
session_start();
session_unset();

//Loading configs and saves
$hdfile="saves/hubdetails.json";
$sfile="cfg/settings.json";

if(file_exists($hdfile)) {
    $hubdetails = json_decode(file_get_contents($hdfile), true);
}
else {
    header('Location: /deploy.php');
    die();
}
$settings = json_decode(file_get_contents($sfile), true);
$_SESSION['settings'] = $settings;

//Checking connection to MessHub.
$connected = @fsockopen(explode("//", $settings['domain'])[1], 80);
if ($connected) {
    header('Location: /menu.php');
    die();
}
else {
    echo "Please connect to the internet and refresh this page.";
}
?>
<html>
    <head>
        <title>MessHub Index</title>
    </head>
    <body>
        You shouldn't have gotten stuck here...
    </body>
</html>
