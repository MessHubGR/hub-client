<?php
    session_start();
    if(!isset($_SESSION['settings'])) {
        header("Location: /index.php");
    }

    //unset($_SESSION['loggedin']); To require login again.
    if (!isset($_SESSION['loggedin'])) {
        $_SESSION['goto'] = basename($_SERVER['PHP_SELF']);
        header("Location: /login.php");
        die();
    }
    else {
        echo "GO";
    }
?>
