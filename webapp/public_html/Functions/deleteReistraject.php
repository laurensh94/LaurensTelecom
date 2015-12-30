<?php session_start(); ini_set('display_errors', 1);  error_reporting(E_ALL);

$PersoonID = $_SESSION["PersoonID"];
$ReistrajectID = $_POST["ReistrajectID"];

include("Functions.php");
$link = connect();
if($link == false){
    echo 0;
    exit;
}

deleteReistraject($PersoonID, $ReistrajectID);

?>