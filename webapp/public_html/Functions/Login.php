<?php session_start();
ini_set('display_errors', 0);  error_reporting(E_ALL);

$Gebruikersnaam = $_POST["Gebruikersnaam"];
$Wachtwoord = $_POST["Wachtwoord"];

include("Functions.php");

$link = connect();
if($link == false){
    echo json_encode(array("connectError"=>0)); 
    exit;
}

$query = "SELECT PersoonID, BINARY Gebruikersnaam, BINARY Wachtwoord FROM Logingegevens WHERE BINARY Gebruikersnaam = BINARY ?;";
$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, "s", $Gebruikersnaam);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $PersoonID, $FGebruikersnaam, $FWachtwoord);
mysqli_stmt_fetch($stmt);
mysqli_stmt_free_result($stmt);
mysqli_stmt_close($stmt);

$WW = crypt($Wachtwoord, $FWachtwoord);

if($Gebruikersnaam == $FGebruikersnaam && $FWachtwoord == $WW){
        $_SESSION["Access"] = 1;
        $_SESSION["Gebruikersnaam"] = $FGebruikersnaam;
        $_SESSION["PersoonID"] = $PersoonID;
        echo json_encode(array("name"=>$FGebruikersnaam,"Access"=> $_SESSION["Access"]));
}else{
        $_SESSION["Access"] = 0;
        echo json_encode(array("Access"=>"Logingegevens onjuist"));
}

mysqli_close($link);
        