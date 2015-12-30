<?php ini_set('display_errors', 0);  error_reporting(E_ALL);

$Naam = $_POST["Naam"];
$Postcode = $_POST["Postcode"];
$Huisnr = $_POST["Huisnummer"];
$Toevoeging = $_POST["Toevoeging"];
$Plaats = $_POST["Woonplaats"];
$Straat = $_POST["Straat"];
$Email = $_POST["Email"];
$Telefoonnummer = $_POST["Telefoonnummer"];
$IBAN = $_POST["IBAN"];
$Gebruikersnaam = $_POST["Gebruikersnaam"];
$Wachtwoord = $_POST["Wachtwoord"];

include("Functions.php");
$link = connect();
if($link == false){
    echo 0;
    exit;
}

$Hash = bCrypt($Wachtwoord, 12);

$AdresID = insertAddress($Postcode, $Huisnr, $Toevoeging, $Straat, $Plaats);
$PersoonID = insertPersoon($Naam, $AdresID);
insertTreinreiziger($PersoonID, $Telefoonnummer, $ContractAkkoord = true, $IBAN, $Email);
insertLogingegevens($PersoonID, $Gebruikersnaam, $Hash);