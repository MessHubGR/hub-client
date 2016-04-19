<?php
    session_start();
    if(!isset($_SESSION['settings'])) {
        header("Location: /index.php");
    }

    //unset($_SESSION['logintoken']); To require login again.
    if (!isset($_SESSION['logintoken'])) {
        include 'loginoverlay.php';
    }
    else {
        echo $_SESSION['logintoken']. "thatwastoken";
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

        <script src="js/clock.js"></script>
        <script src="js/metro.min.js"></script>
        <script src="js/menuredirect.js"></script>
    </head>

    <body onload="startTime()">
        <div class="box">
            <?php include 'bar.php';?>

            <div class="row content">
                <?php
                if (!isset($_SESSION['logintoken'])) {
                    include 'loginoverlay.php';
                }
                ?>
            </div>
        </div>
    </body>
</html>
