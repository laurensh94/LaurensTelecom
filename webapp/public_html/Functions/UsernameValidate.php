<?php 

	$link = mysqli_connect('82.150.140.89','KBS','Kbs.1234','KBS');

	$Gebruikersnaam = $_POST["Gebruikersnaam"];
	
	//prepared statement to select field username if it's equal to the username that we check
	$stmt = mysqli_prepare($link, "SELECT Gebruikersnaam FROM Logingegevens WHERE Gebruikersnaam = \"$Gebruikersnaam\" ");
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $result);
	mysqli_stmt_fetch($stmt);
	  
	//if number of rows fields is bigger than 0 that means it's NOT available ' 
	if(!$result){  
	    //and we send 0 to the ajax request  
	    echo 0;  
	}else{  
	    //else if it's not bigger then 0, then it's available '  
	    //and we send 1 to the ajax request 
	    echo 1;  
	}   

?>