<?php ini_set('display_errors', 1);  error_reporting(E_ALL);

function connect(){

    $link = new mysqli('10.10.1.3','root','L4urens1','Laurens_Telecom');
    
if ($link->connect_error) {
 trigger_error('Database connection failed: '  . $link->connect_error, E_USER_ERROR);
	}
}

function getTelefoon(){
    
    $link = connect();
    $stmt = mysqli_prepare($link, "SELECT * FROM Artikel");
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $nr, $cat);
    $array = array();
    while(mysqli_stmt_fetch($stmt)){
        $array[$UICCode] = $langNaam;
    }
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($link);
    
    return $array;
}

?>