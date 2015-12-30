<?php date_default_timezone_set('Europe/Amsterdam');
include 'resources/phpqrcode/qrlib.php';
include 'Functions/Functions.php';

$packetId = $_GET['PakketId'];
$PersoonId = $_GET['PersoonId'];

$link = connect();
$stmt = mysqli_prepare($link, "SELECT `PBSKoerierID` FROM `Pakket` WHERE `PakketID` = ? LIMIT 1;"); 
    mysqli_stmt_bind_param($stmt, "i", $packetId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $user);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

echo $user;

if($user == 0){
    $stmt = mysqli_prepare($link, "UPDATE `Pakket` SET `PBSKoerierID` = ? WHERE `PakketID` = ? LIMIT 1;"); 
    mysqli_stmt_bind_param($stmt, "ii",$PersoonId, $packetId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    $message = 'Het pakket is aan uw accout toegekend';
  
}else{
    $message = 'Helaas heeft een andere trein reiziger dit pakket al geclaimed.';
}




?>
<html>
<head>
<title>TZT Print Sticker</title>
<link href="resources/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="resources/Style.css" rel="stylesheet">
</head>
<body style="padding:10px">
<?php echo '<h3>'.$message.'</h3>';?>
</body>
</html>