<?php
include '../Functions/Functions.php';

$link = connect();
$username = $_GET['username'];

if($link){    
    //echo json_encode(getHash($link, $username));
    echo getHash($link, $username);
}else{
    echo "no_connect";
   
}


?>