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

?>