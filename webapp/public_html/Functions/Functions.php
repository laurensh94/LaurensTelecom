<?php ini_set('display_errors', 1);  error_reporting(E_ALL);

function connect(){
    $link = mysqli_connect('82.150.140.89','KBS','Kbs.1234','KBS');
    
    if ($link->connect_error) {
        return false;
    }else{
        return $link;
    }
}