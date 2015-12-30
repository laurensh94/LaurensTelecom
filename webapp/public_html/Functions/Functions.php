<?php ini_set('display_errors', 1);  error_reporting(E_ALL);

function connect(){
    $link = mysqli_connect('82.150.140.89','KBS','Kbs.1234','KBS');
    
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

function updateAddress($AdresID, $Postcode, $Huisnr, $Toevoeging, $Straat, $Plaats){
    $link = connect();
    $stmt = mysqli_prepare($link, "UPDATE Adres SET Postcode = ?, Huisnummer = ?, Toevoeging = ?, Straat = ?, woonplaats = ? WHERE AdresID = \" $AdresID \";");
    mysqli_stmt_bind_param($stmt, "sisss", $Postcode, $Huisnr, $Toevoeging, $Straat, $Plaats);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($link);
}

function insertRoute($Startadres, $Eindadres, $Afstand, $BingRouteTijd){
    $link = connect();
    $stmt = mysqli_prepare($link, "INSERT INTO Route(Startadres, Eindadres, Afstand, BingRouteTijd) VALUES(?, ?, ?, ?);");
    mysqli_stmt_bind_param($stmt, "iiss", $Startadres, $Eindadres, $Afstand, $BingRouteTijd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);
    
    $stmt = mysqli_prepare($link, "SELECT MAX(RouteID) FROM Route WHERE Startadres = \"$Startadres\" AND Eindadres = \"$Eindadres\" ");
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $RouteID);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($link);
    
    return $RouteID;
}

function insertPakket($RouteID, $AfzenderID, $OntvangerID, $PBS, $Ophaaltijd, $BedrijfsID, $Status, $Prijs, $Datum){
    $link = connect();
    $stmt = mysqli_prepare($link, "INSERT INTO Pakket(RouteID, AfzenderID, OntvangerID, PBS, 
                                                        Ophaaltijd, BedrijfsID, Status, Prijs, Datum) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?);");
    mysqli_stmt_bind_param($stmt, "iiiisiiss", $RouteID, $AfzenderID, $OntvangerID, $PBS, $Ophaaltijd, 
                                                $BedrijfsID, $Status, $Prijs, $Datum);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);
    
    $stmt = mysqli_prepare($link, "SELECT MAX(PakketID) FROM Pakket WHERE RouteID = \"$RouteID\" AND AfzenderID = \"$AfzenderID\" ");
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $PakketID);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);
    
    $packetdata = getPacketData($PakketID);
    
    $qrdata = 'ID:'.$PakketID.';FROM:'.$packetdata['Afzender']['name'].', '.$packetdata['Afzender']['street'].' '.$packetdata['Afzender']['nr'].' '.$packetdata['Afzender']['ext'].', '.$packetdata['Afzender']['city'].', '.$packetdata['Afzender']['postalcode'].';TO:'.$packetdata['Ontvanger']['name'].', '.$packetdata['Ontvanger']['street'].' '.$packetdata['Ontvanger']['nr'].' '.$packetdata['Ontvanger']['ext'].', '.$packetdata['Ontvanger']['city'].', '.$packetdata['Ontvanger']['postalcode'].';KOURIER:TZT';
    
    $stmt = mysqli_prepare($link, "UPDATE Pakket SET QRdata=\"$qrdata\" WHERE PakketID=\"$PakketID\" ");
    mysqli_stmt_execute($stmt);
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($link);
    
    return $PakketID;
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

function updatePersoon($PersoonID, $Naam){
    $link = connect();
    $stmt = mysqli_prepare($link, "UPDATE Persoon SET Naam = ? WHERE PersoonID = \" $PersoonID \";");
    mysqli_stmt_bind_param($stmt, "s", $Naam);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);
    
    $stmt = mysqli_prepare($link, "SELECT AdresID FROM Persoon WHERE PersoonID = \" $PersoonID \";");
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $AdresID);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($link);
    
    return $AdresID;
}

function insertTreinreiziger($PersoonID, $Telefoonnummer, $ContractAkkoord, $IBAN, $Email){
    $link = connect();
    $stmt = mysqli_prepare($link, "INSERT INTO Treinreiziger(PersoonID, Telefoonnummer, ContractAkkoord, IBAN, Email) VALUES(?, ?, ?, ?, ?);");
    mysqli_stmt_bind_param($stmt, "isiss", $PersoonID, $Telefoonnummer, $ContractAkkoord, $IBAN, $Email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($link);
}

function updateTreinreiziger($PersoonID, $Telefoonnummer, $ContractAkkoord, $IBAN, $Email){
    $link = connect();
    $stmt = mysqli_prepare($link, "UPDATE Treinreiziger SET Telefoonnummer = ?, ContractAkkoord = ?, IBAN = ?, Email = ? WHERE PersoonID = \" $PersoonID \";");
    mysqli_stmt_bind_param($stmt, "siss", $Telefoonnummer, $ContractAkkoord, $IBAN, $Email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($link);
}

function insertAfzender($PersoonID, $afzenderEmail, $afzenderTelefoonnummer){
    $link = connect();
    $stmt = mysqli_prepare($link, "INSERT INTO Afzender(PersoonID, Email, Telefoonnummer) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "isi", $PersoonID, $afzenderEmail, $afzenderTelefoonnummer);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);
}

function insertOntvanger($PersoonID){
    $link = connect();
    $stmt = mysqli_prepare($link, "INSERT INTO Ontvanger(PersoonID) VALUES(?)");
    mysqli_stmt_bind_param($stmt, "i", $PersoonID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($link);
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

function updateLogingegevens($PersoonID, $Gebruikersnaam, $Wachtwoord){
    $link = connect();
    $stmt = mysqli_prepare($link, "UPDATE Logingegevens SET Gebruikersnaam = ?, Wachtwoord = ? WHERE PersoonID = \" $PersoonID \";");
    mysqli_stmt_bind_param($stmt, "ss", $Gebruikersnaam, $Wachtwoord);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($link);
}

function getPersoon($sessionID){
    $link = connect();
    $stmt = mysqli_prepare($link, "SELECT PersoonID, Naam, AdresID FROM Persoon WHERE PersoonID = \" $sessionID \" ");
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $PersoonID, $Naam, $AdresID);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($link);
    
    return array($PersoonID, $Naam, $AdresID);
}

function getTreinreiziger($sessionID){
    $link = connect();
    $stmt = mysqli_prepare($link, "SELECT PersoonID, Telefoonnummer, IBAN, Email FROM Treinreiziger WHERE PersoonID = \" $sessionID \" ");
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $PersoonID, $Telefoonnummer, $IBAN, $Email);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($link);
    
    return array($PersoonID, $Telefoonnummer, $IBAN, $Email);
}

function getLogingegevens($sessionID){
    $link = connect();
    $stmt = mysqli_prepare($link, "SELECT PersoonID, Gebruikersnaam FROM Logingegevens WHERE PersoonID = \" $sessionID \" ");
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $PersoonID, $Gebruikersnaam);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($link);
    
    return array($PersoonID, $Gebruikersnaam);
}

function getAdres($sessionID){
    $link = connect();
    $stmt = mysqli_prepare($link, "SELECT AdresID, Postcode, Huisnummer, Toevoeging, Straat, Woonplaats FROM Adres WHERE AdresID = \" $sessionID \" ");
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $AdresID, $Postcode, $Huisnummer, $Toevoeging, $Straat, $Woonplaats);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($link);
    
    return array($AdresID, $Postcode, $Huisnummer, $Toevoeging, $Straat, $Woonplaats);
}

function insertReistraject($PersoonID, $Startstation, $Eindstation, $Vertrektijd, $Beschikbaarheid){
    $link = connect();
    $stmt = mysqli_prepare($link, "INSERT INTO Reistraject(PersoonID, Startstation, Eindstation, Vertrektijd, Beschikbaarheid) "
            . "                     VALUES(?, ?, ?, ?, ?);");
    mysqli_stmt_bind_param($stmt, "issss", $PersoonID, $Startstation, $Eindstation, $Vertrektijd, $Beschikbaarheid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($link);
}

function deleteReistraject($PersoonID, $ReistrajectID){
    $link = connect();
    $stmt = mysqli_prepare($link, "DELETE FROM Reistraject WHERE PersoonID = ? AND ReistrajectID = ?;");
    mysqli_stmt_bind_param($stmt, "ii", $PersoonID, $ReistrajectID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($link);
}

function getReistrajectData($SessionID){
    $link = connect();
    $stmt = mysqli_prepare($link, "SELECT * FROM Reistraject WHERE PersoonID = \" $SessionID \" ");
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $ReistrajectID, $PersoonID, $Startstation, $Eindstation, $Vertrektijd, $Beschikbaarheid);
    $array = array();
    $num = 0;
    while(mysqli_stmt_fetch($stmt)){
        $array[$num] = array($ReistrajectID, $PersoonID, $Startstation, $Eindstation, $Vertrektijd, $Beschikbaarheid);
        $num++;
    }
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($link);
    
    return $array;
}

function bCrypt($pass,$cost){
      $chars='./ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

      // Build the beginning of the salt
      $salt=sprintf('$2a$%02d$',$cost);

      // Generate a random salt
      for($i=0; $i<22; $i++){ 
		  $salt .= $chars[rand(0,63)];
	  }

     // return the hash
    return crypt($pass,$salt);
}

function updatePassword($token, $link){
    // NewUser
    $Password = $_POST["Password"];
    $PasswordRepeat = $_POST["RepeatPassword"];

    if($Password != $PasswordRepeat){
        return 'De opgegeven wachtwoorden komen niet overeen.';
    }else{
        $hash = bCrypt($Password,12);
        $userid = checkToken($token, $link);
        //echo $userid;
        if($userid != 0){
            if ($stmt = mysqli_prepare($link, "UPDATE Logingegevens SET Wachtwoord = ? WHERE PersoonID = ?")) {
                    mysqli_stmt_bind_param($stmt, "si", $hash, $userid);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
            }
            if ($stmt = mysqli_prepare($link, "UPDATE PasswordReset SET used = 1 WHERE resetcode=?")) {
                    mysqli_stmt_bind_param($stmt, "s", $token);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
            }
            return true;
        }else{
            return 'Token niet gevonden';
        }
    }
}

function checkToken($token, $link){
    if ($stmt = mysqli_prepare($link, "SELECT PersoonID FROM PasswordReset WHERE resetcode=? AND used = 0")) {
        mysqli_stmt_bind_param($stmt, "s", $token);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $userid);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    }
    return $userid;
}

function getSenderMail($packetId){
    $link=connect();
    $stmt = mysqli_prepare($link, "SELECT `Afzender`.`Email` FROM `Afzender` INNER JOIN `Pakket` on `Pakket`.`AfzenderID` = `Afzender`.`PersoonID` WHERE `Pakket`.`PakketID` = ? LIMIT 1;"); 
    mysqli_stmt_bind_param($stmt, "i", $packetId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $Email);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    return $Email;
}
    
function checkSession(){
    if($_SESSION["Access"] == 0){
        return '<script> window.location.href = "index.php";</script>';
    }
}

function getNSloginData(){
    return array('melvindejong@outlook.com', 'VivYB4bHsGYwF9oRDiVJvC8RpYawathBA40yjyTvskVCgO_WW0F67A');
}

function nsGetStationsList(){
    
    //curl wordt gebruikt om een externe url aan te roepen en bij NS de gegevens op te halen
    $loginData = getNSloginData(); 
    
    $curl = curl_init();
	curl_setopt ($curl, CURLOPT_URL, 'http://webservices.ns.nl/ns-api-stations-v2');
	curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_USERPWD, $loginData[0] . ":" . $loginData[1]);
    curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
//    $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
//	$contents = substr(curl_exec ($curl),$header_size);
    $contents = curl_exec($curl);
    curl_close ($curl);
    
    return $contents;
}

function bingCalculateRoute($startAdress, $endAdress){
    //Array('postal'=>'8255PE','city'=>'Swifterbant','street'=>'de Kolk','nr'=>'36','country'=>'NL')
    //set adresses to bing format
    $wp0 = urlencode($startAdress['street']).'%20'.urlencode($startAdress['nr']).'%20'.urlencode($startAdress['city']).'%20'.urlencode($startAdress['postal']).'%20'.urlencode($startAdress['country']);
    $wp1 = urlencode($endAdress['street']).'%20'.urlencode($endAdress['nr']).'%20'.urlencode($endAdress['city']).'%20'.urlencode($endAdress['postal']).'%20'.urlencode($endAdress['country']);
    //$wp0 = 'de%20kolk%2036%20Swifterbant%208255PE%20NL';
    //$wp1 = 'herfst%2049%dronten%208251NR%20NL';
    
    $url = 'http://dev.virtualearth.net/REST/V1/Routes/Driving?o=xml&wp.0='.$wp0.'?&wp.1='.$wp1.'&avoid=minimizeTolls&key=AvZYgNZxXMF75-qLW_jlrrViYOPOpBXc1k1vjWUIaxZNLMplS5_UaFo8pCU2wf65';
    $curl = curl_init();
	curl_setopt ($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
	$contents = curl_exec ($curl);
    curl_close ($curl);
   
    $xmlparse = simplexml_load_string($contents);
    
    $distance = $xmlparse->ResourceSets->ResourceSet-> Resources->Route->TravelDistance;
    $startLat = $xmlparse->ResourceSets->ResourceSet-> Resources->Route->RouteLeg->ActualStart->Latitude;
    $startLong = $xmlparse->ResourceSets->ResourceSet-> Resources->Route->RouteLeg->ActualStart->Longitude;
    $endLat = $xmlparse->ResourceSets->ResourceSet-> Resources->Route->RouteLeg->ActualEnd->Latitude;
    $endLong = $xmlparse->ResourceSets->ResourceSet-> Resources->Route->RouteLeg->ActualEnd->Longitude;
    
    return array('distance'=>$distance,'start'=>array('lat'=>$startLat,'long'=>$startLong),'end'=>array('lat'=>$endLat,'long'=>$endLong));
    
}

function getStationName($id){
    $link = connect();
    $stmt = mysqli_prepare($link, "SELECT langNaam FROM Stations WHERE UICCode = \" $id \" ");
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $langNaam);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($link);
    
    return $langNaam;    
}

function getPacketData($id){
    $link = connect();
    $stmt = mysqli_prepare($link, "SELECT AfzenderID, OntvangerID, QRdata FROM Pakket WHERE PakketID = \" $id \" LIMIT 1 ");
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $AfzenderID, $OntvangerID, $QRdata);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($link);
    
    $array = array('QRData'=>$QRdata, 'Afzender'=>getAdresCombined($AfzenderID), 'Ontvanger'=>getAdresCombined($OntvangerID));
    
    return $array;  
   
}

function getAdresCombined($userid){
    $user = getPersoon($userid);
    $adres = getAdres($user[2]);
    
    return array('name'=>$user[1],'postalcode'=>$adres[1],'nr'=>$adres[2],'ext'=>$adres[3],'street'=>$adres[4],'city'=>$adres[5]);
}

function getStationsIdName(){
    
    $link = connect();
    $stmt = mysqli_prepare($link, "SELECT UICCode, langNaam FROM Stations WHERE land = 'NL' ORDER BY langNaam");
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $UICCode, $langNaam);
    $array = array();
    while(mysqli_stmt_fetch($stmt)){
        $array[$UICCode] = $langNaam;
    }
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($link);
    
    return $array;
}

function refreshStationsDb(){
    //get feed
    $contents = nsGetStationsList();
    //read feed
    $xmlparse = simplexml_load_string($contents);
    //open db connection
    $link = connect();
    //clear current list
    $stmt = mysqli_prepare($link, "TRUNCATE TABLE Stations;");
    mysqli_stmt_execute($stmt);
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);
    //add each station to db
    foreach ($xmlparse->Station as $station) {
        $lat = utf8_decode($station->Lat);
        $long = utf8_decode($station->Lon);
        $naamKort = utf8_decode($station->Namen->Kort);
        $naamMid = utf8_decode($station->Namen->Middel);
        $naamLang = utf8_decode($station->Namen->Lang);

        $stmt = mysqli_prepare($link, "INSERT INTO Stations VALUES(?,?,?,?,?,?,?,?)");
        mysqli_stmt_bind_param ($stmt, "isssssss", $station->UICCode, $station->Code, $naamKort, $naamMid, $naamLang, $station->Land, $lat, $long);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_free_result($stmt);
        mysqli_stmt_close($stmt);

    }
    mysqli_close($link);
}

function checkPBS($routeData){
    $pbs = array();
    if($routeData['distance'] > 75){
        $startStation = findClosestStation($routeData['start']['lat'],$routeData['start']['long']);
        $endStation = findClosestStation($routeData['end']['lat'],$routeData['end']['long']);
        if($startStation){
            if($endStation){
                $timeslot = calculateSendDay();
                $pbs['sendTime']=$timeslot['1'];
                $pbs['sendDate']=$timeslot['3'];
                $koeriers = findKoerier($startStation, $endStation, $timeslot);
                if(!empty($koeriers)){
                    $pbs['status']= true;
                    $pbs['koeriers']= $koeriers;
                    $pbs['startStation']= $startStation;
                    $pbs['endStation']= $endStation;
                    
                }else{
                    $pbs['status'] = false;
                }
            }else{
                $pbs['status'] = false;
            }   
        }else{
            $pbs['status'] = false;
        }
    }else{
        $pbs['status'] = false;
    }  
    return $pbs;
}

function findClosestStation($lat, $long){
    $link = connect();
    $stmt = mysqli_prepare($link, "
SELECT UICCode FROM (
 SELECT z.UICCode,
        z.lat, z.long,
        p.radius,
        p.distance_unit
                 * DEGREES(ACOS(COS(RADIANS(p.latpoint))
                 * COS(RADIANS(z.lat))
                 * COS(RADIANS(p.longpoint - z.long))
                 + SIN(RADIANS(p.latpoint))
                 * SIN(RADIANS(z.lat)))) AS distance
  FROM Stations AS z
  JOIN (   /* these are the query parameters */
        SELECT  CAST(? AS DECIMAL(10,6))  AS latpoint,  CAST(? AS DECIMAL(10,6)) AS longpoint,
                10.0 AS radius,      111.045 AS distance_unit
    ) AS p ON 1=1
  WHERE z.lat
     BETWEEN p.latpoint  - (p.radius / p.distance_unit)
         AND p.latpoint  + (p.radius / p.distance_unit)
    AND z.long
     BETWEEN p.longpoint - (p.radius / (p.distance_unit * COS(RADIANS(p.latpoint))))
         AND p.longpoint + (p.radius / (p.distance_unit * COS(RADIANS(p.latpoint))))
 ) AS d
 WHERE distance <= radius
 ORDER BY distance
 LIMIT 1
    ");
    mysqli_stmt_bind_param($stmt, "dd", $lat, $long);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $UICCode); 
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($link);
//    echo $lat.'<br>';
//    echo $long.'<br>';
//    echo $UICCode.'<br>';
    return $UICCode;
    
}

function sendInvite($koeriers, $packetId, $startStation, $endStation){
    foreach($koeriers as $koerier){
        $from_name = "TZT Post";
    $from_mail = "info@tztpost.nl";

    $to = getKoerierMail($koerier);
    $subject = "Uw pakket met TZT";
    $message = "<p>Beste Koerier, </p>"
            . " <p>Wij hebben uw pakket beschikbaar op jou route tussen ".getStationName($startStation)." en ".getStationName($endStation).".</p><br>"
            . ' <p>Klik <a href="http://localhost:8080/meldaan.php?PakketId='.$packetId.'&PersoonId='.$koerier.'">hier</a> om je voor dit pakket aan te melden.</p><br>'
            . " <p>Met vriendelijke groet,</p>"
            . " <p>Het TZT-team</p>"
            . " <p>Campus 2-6 Lokaal D2.38<br> 8017 CA Zwolle <br> 0900-8899</p>"; // message

    $header = "From: ".$from_name." <".$from_mail.">\r\n";
    $header .= "Content-type:text/html; charset=iso-8859-1\r\n";

    mail($to, $subject, $message, $header);
    }
}

function getKoerierMail($PersoonID){
    $link=connect();
    $stmt = mysqli_prepare($link, "SELECT `Email` FROM `Treinreiziger` WHERE `PersoonID` = ? LIMIT 1;"); 
    mysqli_stmt_bind_param($stmt, "i", $packetId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $Email);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    return $Email;
}

function findKoerier($startStation, $endStation, $timeslot){
    $link = connect();
    $fromTime = date('H:i:s', strtotime("+15 minutes")); 
    $toTime = date('H:i:s', strtotime("+45 minutes"));
    
    $stmt = mysqli_prepare($link, "Select PersoonID FROM  Reistraject WHERE Startstation = ? AND Eindstation = ? AND Beschikbaarheid = ? AND Vertrektijd BETWEEN CAST(? AS TIME) AND CAST(? AS TIME)");
    mysqli_stmt_bind_param($stmt, "iisss", $startStation, $endStation, $timeslot[0], $timeslot[1], $timeslot[2]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $PersoonID);
    $array = array();
    while(mysqli_stmt_fetch($stmt)){
        $array[] = $PersoonID;
    }
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($link);
    
    return $array;
}

function calculateSendDay(){
    
    $fromTime = date('H:i:s', strtotime("+15 minutes")); 
    $toTime = date('H:i:s', strtotime("+45 minutes"));
    
    $days = array('Zondag','Maandag','Dinsdag','Woensdag','Donderdag','Vrijdag','Zaterdag');
    
    $day = date( "w", time());
    $date = date("Y-m-d");
    
    if(!isBetween('06:00', '15:00', date('H:i', time()))){
        if(!isBetween('00:00', '15:00', date('H:i', time()))){
            if($day == 6){
                $day = 0;
            }else{
                $day +=1;
                $date = date($date, strtotime("+1 day"));
            }
        }        
        $fromTime = '06:00';
        $fromTime = '06:30';
    }
    
    return array($days[$day], $fromTime, $toTime, $date);
}

function isBetween($from, $till, $input) {
	$f = DateTime::createFromFormat('!H:i', $from);
	$t = DateTime::createFromFormat('!H:i', $till);
	$i = DateTime::createFromFormat('!H:i', $input);
	if ($f > $t) $t->modify('+1 day');
	return ($f <= $i && $i <= $t) || ($f <= $i->modify('+1 day') && $i <= $t);
}

function calculatePrice($distance){
    if($distance < 25){
        return 12;
    }else if($distance < 75){
        return $distance * 0.39 *1.2;
    }else if($distance < 100){
        return 46.8;
    }else if($distance < 125){
        return 54;
    }else if($distance < 150){
        return 61.2;
    }else if($distance < 175){
        return 68.4;
    }else if($distance < 200){
        return 75.6;
    }else if($distance < 225){
        return 82.8;
    }else if($distance < 250){
        return 90;
    }else if($distance < 275){
        return 97.2;
    }else{
        return 104.4;
    }
}

function getHash($link, $username){
    if ($stmt = mysqli_prepare($link, "select Wachtwoord from Logingegevens where Gebruikersnaam=?")) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $hash);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        
        
        if(empty($hash)){
            return array('hash'=>'user_fail', 'id'=>0);
        }else{
            return $hash;
        }
    }else{
        return 'no_connect';
    }
}

function getIncome($link, $username){
    if ($stmt = mysqli_prepare($link, "select Openstaand from Treinreiziger as a JOIN Logingegevens as b on a.PersoonID = b.PersoonID where Gebruikersnaam=?")) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $income);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
                
//        if(empty($income) || $income != 0){
//            return 'user_fail';
//        }else{
//            return $income;
//        }
        echo $income;
    }else{
        return 'no_connect';
    }
}

