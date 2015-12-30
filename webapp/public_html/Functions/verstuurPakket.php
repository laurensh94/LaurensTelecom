<?php ini_set('display_errors', 0);  error_reporting(E_ALL);

date_default_timezone_set('Europe/Amsterdam');

$afzenderNaam = $_POST["afzenderNaam"];
$afzenderPostcode = $_POST["afzenderPostcode"];
$afzenderHuisnr = $_POST["afzenderHuisnummer"];
$afzenderToevoeging = $_POST["afzenderToevoeging"];
$afzenderPlaats = $_POST["afzenderWoonplaats"];
$afzenderStraat = $_POST["afzenderStraat"];
$afzenderEmail = $_POST["afzenderEmail"];
$afzenderTelefoonnummer = $_POST["afzenderTelefoonnummer"];

$ontvangerNaam = $_POST["ontvangerNaam"];
$ontvangerPostcode = $_POST["ontvangerPostcode"];
$ontvangerHuisnr = $_POST["ontvangerHuisnummer"];
$ontvangerToevoeging = $_POST["ontvangerToevoeging"];
$ontvangerPlaats = $_POST["ontvangerWoonplaats"];
$ontvangerStraat = $_POST["ontvangerStraat"];
$ontvangerHandtekening;

include("Functions.php");


$link = connect();

if($link == false){
    $returnArray = array('status'=>0);
    echo json_encode($returnArray);
    exit;
}



$BingRoute = bingCalculateRoute(Array('postal'=>$afzenderPostcode,'city'=>$afzenderPlaats,'street'=>$afzenderStraat,'nr'=>$afzenderHuisnr.' '.$afzenderToevoeging,'country'=>'NL'),
                                Array('postal'=>$ontvangerPostcode,'city'=>$ontvangerPlaats,'street'=>$ontvangerStraat,'nr'=>$ontvangerHuisnr.' '.$ontvangerToevoeging,'country'=>'NL'));

$pbs = checkPBS($BingRoute);

$price = round(calculatePrice($BingRoute['distance']), 2);

$afzenderAdresID = insertAddress($afzenderPostcode, $afzenderHuisnr, $afzenderToevoeging, $afzenderStraat, $afzenderPlaats);

$afzenderPersoonID = insertPersoon($afzenderNaam, $afzenderAdresID);

insertAfzender($afzenderPersoonID, $afzenderEmail, $afzenderTelefoonnummer);

$ontvangerAdresID = insertAddress($ontvangerPostcode, $ontvangerHuisnr, $ontvangerToevoeging, $ontvangerStraat, $ontvangerPlaats);

$ontvangerPersoonID = insertPersoon($ontvangerNaam, $ontvangerAdresID);

insertOntvanger($ontvangerPersoonID);

$RouteID = insertRoute($afzenderAdresID, $ontvangerAdresID, $BingRoute['distance'], $pbs['sendDate']);

$PakketID = insertPakket($RouteID, $afzenderPersoonID, $ontvangerPersoonID, $pbs['status'], $pbs['sendTime'], $BedrijfsID = 1, $Status = 1, $price, $pbs['sendDate']);

$returnArray = array('PakketID'=>$PakketID,'Prijs'=>$price, 'status'=>$pbs['status']);

echo json_encode($returnArray);

if($pbs['status'] == true){
    sendInvite($pbs['koeriers'], $PakketID, $pbs['startStation'], $pbs['endStation']);
}





