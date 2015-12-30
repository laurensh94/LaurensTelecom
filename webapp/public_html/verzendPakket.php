<?php

if(isset($_POST["name"]) || isset($_POST["afzenderpostcode"]) || isset($_POST["afzenderhuisnr"]) || isset($_POST["afzendertoevoeging"]) || isset($_POST["city"]) || isset($_POST["afzenderstraat"]) || isset($_POST["email"]) || isset($_POST["afzendertelefoonnummer"]) || 
   isset($_POST["ontvangernaam"]) || isset($_POST["ontvangerpostcode"]) || isset($_POST["ontvangerhuisnr"]) || isset($_POST["ontvangertoevoeging"]) || isset($_POST["ontvangerplaats"]) || isset($_POST["ontvangerstraat"])){
    
    $afzenderNaam =              $_POST["name"];
    $afzenderPostcode =          $_POST["afzenderpostcode"];
    $afzenderHuisnr =            $_POST["afzenderhuisnr"]; 
    $afzenderToevoeging =        $_POST["afzendertoevoeging"];
    $afzenderPlaats =            $_POST["city"];
    $afzenderStraat =            $_POST["afzenderstraat"];
    $afzenderEmail =             $_POST["email"]; 
    $afzenderTelefoonnummer =    $_POST["afzendertelefoonnummer"]; 

    $ontvangerNaam =             $_POST["ontvangernaam"]; 
    $ontvangerPostcode =         $_POST["ontvangerpostcode"];
    $ontvangerHuisnr =           $_POST["ontvangerhuisnr"];
    $ontvangerToevoeging =       $_POST["ontvangertoevoeging"];
    $ontvangerPlaats =           $_POST["ontvangerplaats"];
    $ontvangerStraat =           $_POST["ontvangerstraat"];

    
}
else{
    header("Location: index.php");
    die();
}

include("header.php"); date_default_timezone_set('Europe/Amsterdam');

?>

    <section class="container">
        <div class="col-md-12">
            <article>
                <h3>Pakket aanmelden</h3>
                <div class="articleInner">
                    <h4>Controleer aub de gegevens hier onder:</h4>
                  <form  method="post" onsubmit="return verstuurPakket()" class="form-inline">
                      <!--action="https://www.paypal.com/cgi-bin/webscr"-->
                        <input type="hidden" name="cmd" value="_xclick">
                        <input type="hidden" name="business" value="info@tztpost.nl">
                        <input type="hidden" name="item_name" value="TZT-post">
                        <input type="hidden" name="item_number" value="1">
                        <input type="hidden" name="no_shipping" value="0">
                        <input type="hidden" name="no_note" value="1">
                        <input type="hidden" name="amount" id="amount" value="1"> <!-- hier komt het bedrag van de routeberekening -->
                        <input type="hidden" name="currency_code" value="EUR">
                        <input type="hidden" name="lc" value="NL">
                        <input type="hidden" name="bn" value="PP-BuyNowBF">
                        <input type="hidden" name="return" id="return" value="localhost:8080/index.php?paymentCompleted">
                        <div>
                            <label class="blauwKleur">Van:</label>
                            <div class="form-group">
                              <input type="text" class="form-control" value="<?php echo $afzenderNaam ?>" id="afzendernaam" name="name" placeholder="Naam*">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" size="5" value="<?php echo $afzenderPostcode ?>" id="afzenderpostcode" placeholder="Postcode*">
                                <input type="number" class="form-control" size="3" value="<?php echo $afzenderHuisnr ?>" id="afzenderhuisnr" placeholder="Huisnr*">
                                <input type="text" class="form-control" size="10" value="<?php echo $afzenderToevoeging ?>" id="afzendertoevoeging" placeholder="Toevoeging">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="<?php echo $afzenderPlaats ?>" id="afzenderplaats" name="city" placeholder="Plaats*">
                                <input type="text" class="form-control" value="<?php echo $afzenderStraat ?>" id="afzenderstraat" placeholder="Straat*">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" value="<?php echo $afzenderEmail ?>" id="afzenderemail" name="email" placeholder="E-mail*">
                                <input type="text" class="form-control" value="<?php echo $afzenderTelefoonnummer ?>" id="afzendertelefoonnummer" placeholder="Telefoonnummer">
                            </div>
                        </div>
                        <div>
                            <label class="blauwKleurPadding">Naar:</label>
                            <div class="form-group">
                                <input type="text" class="form-control" value="<?php echo $ontvangerNaam ?>" id="ontvangernaam" placeholder="Naam*">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="<?php echo $ontvangerPostcode ?>" size="5" id="ontvangerpostcode" placeholder="Postcode*">
                                <input type="number" class="form-control" value="<?php echo $ontvangerHuisnr ?>" size="3" id="ontvangerhuisnr" placeholder="Huisnr*">
                                <input type="text" class="form-control" value="<?php echo $ontvangerToevoeging ?>" size="10" id="ontvangertoevoeging" placeholder="Toevoeging">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="<?php echo $ontvangerPlaats ?>" id="ontvangerplaats" placeholder="Plaats*">
                                <input type="text" class="form-control" value="<?php echo $ontvangerStraat ?>" id="ontvangerstraat" placeholder="Straat*">
                            </div>
                        </div>
                        * verplichte velden <br/>
                        ** pakketjes groter dan 100cm of zwaarder dan 10kg worden niet aangenomen.<br /><br />
                        <center><input type="submit" value="Verstuur" name="submit-paypal" class="btn btn-default btn-custom"></center>
                        <script type="text/javascript">
                            function verstuurPakket(){

                                var afzenderNaam =              $("#afzendernaam").val();
                                var afzenderPostcode =          $("#afzenderpostcode").val();
                                var afzenderHuisnr =            $("#afzenderhuisnr").val(); 
                                var afzenderToevoeging =        $("#afzendertoevoeging").val();
                                var afzenderPlaats =            $("#afzenderplaats").val();
                                var afzenderStraat =            $("#afzenderstraat").val();
                                var afzenderEmail =             $("#afzenderemail").val(); 
                                var afzenderTelefoonnummer =    $("#afzendertelefoonnummer").val(); 

                                var ontvangerNaam =             $("#ontvangernaam").val(); 
                                var ontvangerPostcode =         $("#ontvangerpostcode").val();
                                var ontvangerHuisnr =           $("#ontvangerhuisnr").val();
                                var ontvangerToevoeging =       $("#ontvangertoevoeging").val();
                                var ontvangerPlaats =           $("#ontvangerplaats").val();
                                var ontvangerStraat =           $("#ontvangerstraat").val();

                                if(afzenderNaam.length===0){$("#afzendernaam").css({border:"1px solid red"});}
                                else{$("#afzendernaam").css({border:"1px solid #ccc"});}
                                if(afzenderPostcode.length===0){$("#afzenderpostcode").css({border:"1px solid red"});}
                                else{$("#afzenderpostcode").css({border:"1px solid #ccc"});}
                                if(afzenderHuisnr.length===0){$("#afzenderhuisnr").css({border:"1px solid red"});}
                                else{$("#afzenderhuisnr").css({border:"1px solid #ccc"});}
                                if(afzenderPlaats.length===0){$("#afzenderplaats").css({border:"1px solid red"});}
                                else{$("#afzenderplaats").css({border:"1px solid #ccc"});}
                                if(afzenderStraat.length===0){$("#afzenderstraat").css({border:"1px solid red"});}
                                else{$("#afzenderstraat").css({border:"1px solid #ccc"});}
                                if(afzenderEmail.length===0){$("#afzenderemail").css({border:"1px solid red"});}
                                else{$("#afzenderemail").css({border:"1px solid #ccc"});}
                                if(ontvangerNaam.length===0){$("#ontvangernaam").css({border:"1px solid red"});}
                                else{$("#ontvangernaam").css({border:"1px solid #ccc"});}
                                if(ontvangerPostcode.length===0){$("#ontvangerpostcode").css({border:"1px solid red"});}
                                else{$("#ontvangerpostcode").css({border:"1px solid #ccc"});}
                                if(ontvangerHuisnr.length===0){$("#ontvangerhuisnr").css({border:"1px solid red"});}
                                else{$("#ontvangerhuisnr").css({border:"1px solid #ccc"});}
                                if(ontvangerPlaats.length===0){$("#ontvangerplaats").css({border:"1px solid red"});}
                                else{$("#ontvangerplaats").css({border:"1px solid #ccc"});}
                                if(ontvangerStraat.length===0){$("#ontvangerstraat").css({border:"1px solid red"});}
                                else{$("#ontvangerstraat").css({border:"1px solid #ccc"});}

                                if(afzenderNaam.length === 0 || afzenderPostcode.length === 0 || afzenderHuisnr.length === 0 || 
                                    afzenderPlaats.length === 0 || afzenderStraat.length === 0 || afzenderEmail.length === 0 ||
                                    ontvangerNaam.length === 0 || ontvangerPostcode.length === 0 || ontvangerHuisnr.length === 0 ||
                                    ontvangerPlaats.length === 0 || ontvangerStraat.length === 0)
                                {
                                    $("#Comment").html("U bent iets vergeten in te vullen.");
                                    return false;
                                }else{
                                    var returnValue = true;
                                    try{
                                        $.ajax({
                                          method: 'POST',
                                          url: "/Functions/verstuurPakket.php", 
                                          async:false,
                                        data:{
                                            afzenderNaam: afzenderNaam, 
                                            afzenderPostcode: afzenderPostcode, 
                                            afzenderHuisnummer: afzenderHuisnr, 
                                            afzenderToevoeging: afzenderToevoeging, 
                                            afzenderWoonplaats: afzenderPlaats, 
                                            afzenderStraat: afzenderStraat, 
                                            afzenderEmail: afzenderEmail, 
                                            afzenderTelefoonnummer: afzenderTelefoonnummer,

                                            ontvangerNaam: ontvangerNaam, 
                                            ontvangerPostcode: ontvangerPostcode, 
                                            ontvangerHuisnummer: ontvangerHuisnr, 
                                            ontvangerToevoeging: ontvangerToevoeging, 
                                            ontvangerWoonplaats: ontvangerPlaats, 
                                            ontvangerStraat: ontvangerStraat
                                        }}).done(function(data){
                                            if(data !== "0"){

                                                var res = $.parseJSON(data);
                                                
                                                //alert(data);
                                                if(res.status == 0){
                                                    throw 'error';
                                                }

                                                if(!confirm("Dit pakket gaat €" + res.Prijs + " kosten")){
                                                    throw 'user_cancel';
                                                }  


                                                $("#afzendernaam").val("");
                                                $("#afzenderpostcode").val("");
                                                $("#afzenderhuisnr").val(""); 
                                                $("#afzendertoevoeging").val("");
                                                $("#afzenderplaats").val("");
                                                $("#afzenderstraat").val("");
                                                $("#afzenderemail").val(""); 
                                                $("#afzendertelefoonnummer").val(""); 

                                                $("#ontvangernaam").val(""); 
                                                $("#ontvangerpostcode").val("");
                                                $("#ontvangerhuisnr").val("");
                                                $("#ontvangertoevoeging").val("");
                                                $("#ontvangerplaats").val("");
                                                $("#ontvangerstraat").val("");
                                                $("#return").val("localhost:8080/index.php?paymentCompleted&id="+res.PakketID);
                                                $("#amount").val(res.Prijs);                                          
                                            }else{
                                                $("#Comment").html("");
                                                alert("Er kan geen verbinding gemaakt worden.");
                                            }
                                        });
                                    }catch(E){
                                        if (E != 'user_cancel') {alert('Helaas is er iets mis gegaan met het aanmelden van uw pakket.')};
                                        returnValue = false;
                                    }
                                    //alert(returnValue);
                                return returnValue;
                                }
                            }
                        </script>
                    </form>
                    <div id="Comment"><?php if(isset($comment)){echo $comment;} ?></div>
                </div>
            </article>
        </div>
    </section>

<script type="text/javascript">
    function validateForm() {
        var x = document.forms["TrackTrace"]["pakketnummer"].value;
        if (x.length === 0) {
            $("input[name=pakketnummer]").css({border:"1px solid red"});
            alert("Voer een pakketnummer in.");
            return false;
        }else{ 
            $("input[name=pakketnummer]").css({border:"1px solid #ccc"});
            var dbcheck = checkdb(x);
            if(dbcheck !== "2"){
                if(dbcheck !== "1"){
                    alert("Uw ingevoerde code is niet gevonden in ons systeem.");
                    return false;
                }  
            }else{
                alert("Er kan geen verbinding gemaakt worden.");
                return false;
            }
        }
    }

    function checkdb(pakketnr){
        var result = "test";
        $.ajax({
            url: "/Functions/TrackTraceValidate.php",
            async: false,
            type: 'POST',
            data: { pakketnummer: pakketnr },
            success: function(data) {
                result = data;
            }
       });
       return result;
    }
</script>
<?php include("footer.php"); ?>