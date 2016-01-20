<?php

function connect(){
    $hostname = "mysql.hostinger.nl";
    $username = "u259788128_lh";
    $password = "h3LBE6AO";
    $database = "u259788128_lh";

    $link = mysqli_connect($hostname, $username, $password, $database);

    if ($link->connect_error) {
        return false;
    }else{
        return $link;
    }
}

function insertAddress($Postcode, $Huisnr, $Toevoeging, $Straat, $Plaats){
    $link = connect();
    $stmt = mysqli_prepare($link, "INSERT INTO Adres(Postcode, Huisnummer, Toevoeging, Straat, Woonplaats) VALUES(?, ?, ?, ?, ?);");
    mysqli_stmt_bind_param($stmt, "sisss", $Postcode, $Huisnr, $Toevoeging, $Straat, $Plaats);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);

    $stmt = mysqli_prepare($link, "SELECT MAX(AdresID) FROM Adres WHERE Postcode = \"$Postcode\" AND Huisnummer = \"$Huisnr\" ");
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $AdresID);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);


    return $AdresID;
}

function insertPersoon($Naam, $AdresID){
    $link = connect();
    $stmt = mysqli_prepare($link, "INSERT INTO Persoon(Naam, Adresid) VALUES(?, ?);");
    mysqli_stmt_bind_param($stmt, "si", $Naam, $AdresID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);

    $stmt = mysqli_prepare($link, "SELECT MAX(PersoonID) FROM Persoon WHERE Naam = \"$Naam\" AND Adresid = \"$AdresID\" ");
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $PersoonID);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($link);

    return $PersoonID;
}
function insertLogingegevens($PersoonID, $Gebruikersnaam, $Wachtwoord){
    $link = connect();
    $stmt = mysqli_prepare($link, "INSERT INTO Logingegevens(PersoonID, Gebruikersnaam, Wachtwoord) VALUES(?, ?, ?);");
    mysqli_stmt_bind_param($stmt, "iss", $PersoonID, $Gebruikersnaam, $Wachtwoord);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($link);
}

function bCrypt($pass, $cost)
{
    $chars = './ABCDEFGHIJKLMNOPQRSTUVWkXYZabcdefghijklmnopqrstuvwxyz0123456789';

    // Build the beginning of the salt
    $salt = sprintf('$2a$%02d$', $cost);

    // Generate a random salt
    for ($i = 0; $i < 22; $i++) {
        $salt .= $chars[rand(0, 63)];
    }

    // return the hash
    return crypt($pass, $salt);
}

function checkSession()
{
    if ($_SESSION["Access"] == 0) {
        return '<script> window.location.href = "index.php";</script>';
    }
}

?>