<?php ini_set('display_errors', 1);  error_reporting(E_ALL);
session_start();

$PersoonID = $_SESSION["PersoonID"];

$Moment = $_POST["Moment"];
$StationA = $_POST["StationA"];
$StationB = $_POST["StationB"];
$Vertrektijd = $_POST["Vertrektijd"];

include("Functions.php");
$link = connect();
if($link == false){
    echo 0;
    exit;
}

insertReistraject($PersoonID, $StationA, $StationB, $Vertrektijd, $Moment);


?>