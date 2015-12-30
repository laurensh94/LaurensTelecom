<?php 
include("Functions.php");
$link = connect();
if($link == false){
    echo 2;
    exit;
}

$pakketnummer = $_POST['pakketnummer'];  
                          
  
$stmt = mysqli_prepare($link, "SELECT PakketID FROM Pakket WHERE PakketID = \"$pakketnummer\" ");
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $result);
mysqli_stmt_fetch($stmt);
  
//if number of rows fields is bigger than 0 that means the number is present in the database '  
if($result){  
    //and we send 1 to the ajax request  
    echo 1;  
}else{  
    //else if it's not bigger then 0, then it's not present in the database '  
    //and we send 0 to the ajax request  
    echo 0;  
}  
?>