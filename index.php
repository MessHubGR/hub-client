<? php
session_start();
$homepage = file_get_contents('hubdetails.json',FILE_USE_INCLUDE_PATH);
echo $homepage;
$json = json_decode(file_get_contents("./hubdetails.json"), true);
var_dump($json);
?>
