<?php
    $stmt = mysqli_prepare($link, "
    INSERT INTO Adres (Adresid, Postcode, Huisnummer, Toevoeging, Straat, Woonplaats) VALUES (?,?,?,?,?,?);
    SELECT LAST_INSERT_ID() INTO @adresID;
    INSERT INTO Persoon (PersoonID, Naam, Adresid) VALUES (?,?,@adresID);
    SELECT LAST_INSERT_ID() INTO @persoonID;
    INSERT INTO Afzender (AfzenderID, Email, Persoonid) VALUES (?,?,@persoonID;);
    ");
    mysqli_stmt_bind_param($stmt, "ssisssss", $null, $afzenderPostcode, $afzenderHuisnr, $afzenderToevoeging, $afzenderStraat, $afzenderPlaats, , $null, $afzenderNaam, , $null, $afzenderEmail);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);


?>