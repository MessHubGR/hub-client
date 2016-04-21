<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
unset($_SESSION['logintoken']);
unset($_SESSION['dispensefailed']);

$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $pass = $_POST["pass"];
    if ($name == '' or $pass == ''){
        $msg = "You must fill all fields.";
    }
    else{
        $logindata = array();
        $logindata['username'] = $name;
        $logindata['password'] = $pass;

        $turl = $_SESSION['settings']['domain'] . "/api/authenticate";

        $murl = curl_init();
        curl_setopt($murl, CURLOPT_URL, $turl);
        curl_setopt($murl, CURLOPT_POST, sizeof($logindata));
        curl_setopt($murl, CURLOPT_POSTFIELDS, $logindata);
        curl_setopt($murl, CURLOPT_RETURNTRANSFER, true);

        $json = curl_exec($murl);
        $json = json_decode($json,true);
        curl_close($murl);

        if(isset($json['token'])) {
            unset($_SESSION['loginfailed']);
            $_SESSION['logintoken'] = $json['token'];
            header("Refresh:0");
            exit;
        }
        else {
            $_SESSION['loginfailed'] = "You entered invalid credentials.<br />Please try again";
        }
    }
}
?>

<html>
    <style>.login-form { position: absolute; opacity: 1; width: 25rem; height: 18.75rem; position: fixed; top: 50%; margin-top: -9.375rem; left: 50%; margin-left: -12.5rem; background-color: rgb(255, 255, 255); opacity: 0; transform: scale(0.8); }</style>
    <link href="css/metro.min.css" rel="stylesheet" type="text/css">
    <link href="css/metro-icons.min.css" rel="stylesheet" type="text/css">

    <div style="opacity: 1; transform: scale(1); transition: all 0.5s ease 0s;" class="login-form padding20 block-shadow">
        <form name="login" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <h1 class="text-light" style="font-family: Trebuchet MS;">Login to MessHub</h1>
            <hr class="thin">
            <?php
                if(isset($_SESSION['loginfailed'])) {
                    echo "<font color='red'>You entered invalid credentials.<br />Please try again.</font><br />";
                }
            ?>
            <br />
            <div class="input-control text full-size" data-role="input">
                <label for="name"><font color='black'>Username:</font></label>
                <input style="padding-right: 42px;" name="name" id="name" type="text" placeholer="Username" required>
                <button type="button" tabindex="-1" class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br>
            <br>
            <div class="input-control password full-size" data-role="input">
                <label for="pass"><font color='black'>Password:</font></label>
                <input style="padding-right: 42px;" name="pass" id="pass" type="password" placeholer="Password" required>
                <button type="button" tabindex="-1" class="button helper-button reveal"><span class="mif-looks"></span></button>
            </div>
            <br>
            <br>
            <div class="form-actions">
                <button type="submit" class="button primary">Login</button>
            </div>
        </form>
    </div>
</html>
