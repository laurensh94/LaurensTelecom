<?php ini_set('display_errors', 1);  error_reporting(E_ALL);

$Naam = $_POST["Naam"];
$Postcode = $_POST["Postcode"];
$Huisnr = $_POST["Huisnr"];
$Toevoeging = $_POST["Toevoeging"];
$Plaats = $_POST["Woonplaats"];
$Straat = $_POST["Straat"];
$Gebruikersnaam = $_POST["Gebruikersnaam"];
$Wachtwoord = $_POST["Wachtwoord"];

include("functions.php");
$link = connect();
if($link == false){
    echo 0;
    exit;
}

$Hash = bCrypt($Wachtwoord, 12);

$AdresID = insertAddress($Postcode, $Huisnr, $Toevoeging, $Straat, $Plaats);
$PersoonID = insertPersoon($Naam, $AdresID);
insertLogingegevens($PersoonID, $Gebruikersnaam, $Hash);