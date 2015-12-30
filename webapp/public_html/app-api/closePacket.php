 <?php include '../Functions/Functions.php';

$username = $_GET['username'];
$password = $_GET['password'];
$packetId = $_GET['id'];


//echo json_encode(getHash($link, $username));
echo closePacket($username, $password, $packetId);


function closePacket ($username, $password, $packetId){
    $link = connect();
    
    $hash = getHash($link, $username);
    
    if (crypt($password, $hash) == $hash){
        if ($stmt = mysqli_prepare($link, "UPDATE Pakket AS a 
JOIN Logingegevens AS b on a.PBSKoerierID = b.PersoonID 
JOIN Treinreiziger AS c on a.PBSKoerierID = c.PersoonID 
SET a.status = 4, c.Openstaand = c.Openstaand + 10, a.Gescand = 1  
WHERE b.Gebruikersnaam = ?
AND a.PakketID = ?")) {
        mysqli_stmt_bind_param($stmt, "si", $username, $packetId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        echo 'done';
    }else{
        return 'no_connect';
    }
    }
    
}


?>