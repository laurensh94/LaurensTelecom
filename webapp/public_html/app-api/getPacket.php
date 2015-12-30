 <?php include '../Functions/Functions.php';

$link = connect();

$username = $_GET['username'];

if($link){    
    //echo json_encode(getHash($link, $username));
    echo getIncome($link, $username);
    
}else{
    //echo json_encode("no_connect");
    echo "no_connect";
}

function getIncome($link, $username){
    if ($stmt = mysqli_prepare($link, "SELECT QRData FROM Pakket AS a JOIN Logingegevens AS b ON a.PBSKoerierID = b.PersoonID WHERE Gebruikersnaam=? and Gescand=0 LIMIT 1")) {
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

?>