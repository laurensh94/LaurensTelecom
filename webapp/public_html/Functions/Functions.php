<?php ini_set('display_errors', 1);  error_reporting(E_ALL);

function connect(){

    $link = new mysqli('10.10.1.3','root','L4urens1','Laurens_Telecom');
    
if ($link->connect_error) {
 trigger_error('Database connection failed: '  . $link->connect_error, E_USER_ERROR);
	}
}
?>