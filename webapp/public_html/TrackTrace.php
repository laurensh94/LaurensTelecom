<?php include("header.php"); 
      include("resources/link.php"); 
      $pakketnummer = $_GET['pakketnummer'];
ini_set('display_errors',1);  error_reporting(E_ALL);
?>
<section class="container oranjeLijnTrackTrace">
    <div class="col-md-12 minHeightTrackTrace">
      <article>
        <div class="divaanmeldenPakket">
            <h3 class="h3Index">Track en Trace</h3>
            <div class="innerdivTrackTrace">
                <h4 class="blauwKleurTrackTrace"><b>Pakketinformatie</b></h4>
                </br> 
                <p class="blauwKleur">Pakketnummer: <?php echo $pakketnummer ?></p>
                <?php 
                    $stmt = mysqli_prepare($link, "SELECT RouteID FROM Pakket WHERE PakketID = \"$pakketnummer\" ");
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $route);
                    mysqli_stmt_fetch($stmt);
                    mysqli_stmt_free_result($stmt);

                    $stmt = mysqli_prepare($link, "SELECT Startadres, Eindadres FROM Route WHERE RouteID = \"$route\" ");
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $Start, $Eind);
                    mysqli_stmt_fetch($stmt);
                    mysqli_stmt_free_result($stmt);
                                   
                    $Startadres = array();
                    $stmt = mysqli_prepare($link, "SELECT * FROM Adres WHERE adresID = \"$Start\" ");
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $Start, $Postcode, $Huisnummer, $Toevoeging, $Straat, $woonplaats);
                    mysqli_stmt_fetch($stmt);
                    mysqli_stmt_free_result($stmt);

                    $startadres['Postcode'] = $Postcode;
                    $startadres['Huisnummer'] = $Huisnummer;
                    $startadres['Toevoeging'] = $Toevoeging;
                    $startadres['Straat'] = $Straat;
                    $startadres['Woonplaats'] = $woonplaats;
                ?>
                <p class="blauwKleur">Adres afzender: <?php echo $Straat," ", $Huisnummer, " ", $Toevoeging, " ", $Postcode, " ", $woonplaats;?></p>
                <?php
                    $Eindadres = array();
                    $stmt = mysqli_prepare($link, "SELECT * FROM Adres WHERE adresID = \"$Eind\" ");
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $Start, $Postcode, $Huisnummer, $Toevoeging, $Straat, $woonplaats);
                    mysqli_stmt_fetch($stmt);
                    mysqli_stmt_free_result($stmt);

                    $Eindadres['Postcode'] = $Postcode;
                    $Eindadres['Huisnummer'] = $Huisnummer;
                    $Eindadres['Toevoeging'] = $Toevoeging;
                    $Eindadres['Straat'] = $Straat;
                    $Eindadres['Woonplaats'] = $woonplaats;
                ?>
                <p class="blauwKleur">Adres ontvanger: <?php echo $Straat," ", $Huisnummer, " ", $Toevoeging, " ", $Postcode, " ", $woonplaats;?></p>
                    
                <?php 
                    mysqli_stmt_close($stmt);
                                    
                    $stmt = mysqli_prepare($link, "SELECT PakketID, RouteID, AfzenderID, OntvangerID, PBS, Status FROM Pakket WHERE PakketID = \"$pakketnummer\"");
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $PakketID, $RouteID, $AfzenderID, $OntvangerID, $PBS, $Status);  
                    mysqli_stmt_fetch($stmt);
                    mysqli_stmt_free_result($stmt);
                      
                    if($PBS == 1){  
                        if($Status == 1) { ?> 
                            <img class= "StatusPakket" src="resources/Status1.png" alt="Status 1" >  
                    <?php   }
                       
                        else if($Status == 2) { 
                    ?>
                            <img class= "StatusPakket" src="resources/Status2.png" alt="Status 2" >
                            
                    <?php   }
                       
                       else if($Status == 3) { 
                    ?>         
                            <img class= "StatusPakket" src="resources/Status3.png" alt="Status 3" >
                    <?php   }
                        
                        else if($Status == 4) { 
                    ?> 
                            <img class= "StatusPakket" src="resources/Status4.png" alt="Status 4" >
                    <?php   }
                        
                        else { 
                    ?> 
                            <img class= "StatusPakket" src="resources/Status0.png" alt="Status 0" >
                    <?php   }
                    
                mysqli_stmt_free_result($stmt);
                mysqli_stmt_close($stmt);
                mysqli_close($link); 
            }


                ?>
            



            </div>
            </article>
        </div>
    </div>
    </section>
<?php include("footer.php"); ?>



