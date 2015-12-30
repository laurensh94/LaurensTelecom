<?php include("header.php"); date_default_timezone_set('Europe/Amsterdam');?>
    <section class="container">
        <div class="col-md-12">
            <article>
                <h3>Pakket aanmelden</h3>
                <div class="articleInner">
                  <form action="verzendPakket.php" method="post" onsubmit="return verstuurPakket()" class="form-inline">
                        <input type="hidden" name="cmd" value="_xclick">
                        <input type="hidden" name="business" value="info@tztpost.nl">
                        <input type="hidden" name="item_name" value="TZT-post">
                        <input type="hidden" name="item_number" value="1">
                        <input type="hidden" name="no_shipping" value="0">
                        <input type="hidden" name="no_note" value="1">
                        <input type="hidden" name="amount" value="40"> <!-- hier komt het bedrag van de routeberekening -->
                        <input type="hidden" name="currency_code" value="EUR">
                        <input type="hidden" name="lc" value="NL">
                        <input type="hidden" name="bn" value="PP-BuyNowBF">
                        <input type="hidden" name="return" id="return" value="localhost:8080/index.php?paymentCompleted">
                        <div>
                            <label class="blauwKleur">Van:</label>
                            <div class="form-group">
                              <input type="text" class="form-control" id="afzendernaam" name="name" placeholder="Naam*">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" size="5" id="afzenderpostcode" name="afzenderpostcode" placeholder="Postcode*">
                                <input type="number" class="form-control" size="3" id="afzenderhuisnr" name="afzenderhuisnr" placeholder="Huisnr*">
                                <input type="text" class="form-control" size="10" id="afzendertoevoeging" name="afzendertoevoeging" placeholder="Toevoeging">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="afzenderplaats" name="city" placeholder="Plaats*">
                                <input type="text" class="form-control" id="afzenderstraat" name="afzenderstraat" placeholder="Straat*">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" id="afzenderemail" name="email" placeholder="E-mail*">
                                <input type="text" class="form-control" id="afzendertelefoonnummer" name="afzendertelefoonnummer" placeholder="Telefoonnummer">
                            </div>
                        </div>
                        <div>
                            <label class="blauwKleurPadding">Naar:</label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="ontvangernaam" name="ontvangernaam" placeholder="Naam*">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" size="5" id="ontvangerpostcode" name="ontvangerpostcode" placeholder="Postcode*">
                                <input type="number" class="form-control" size="3" id="ontvangerhuisnr" name="ontvangerhuisnr" placeholder="Huisnr*">
                                <input type="text" class="form-control" size="10" id="ontvangertoevoeging" name="ontvangertoevoeging" placeholder="Toevoeging">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="ontvangerplaats" name="ontvangerplaats" placeholder="Plaats*">
                                <input type="text" class="form-control" id="ontvangerstraat" name="ontvangerstraat" placeholder="Straat*">
                            </div>
                        </div>
                        * verplichte velden <br/>
                        ** pakketjes groter dan 100cm of zwaarder dan 10kg worden niet aangenomen.
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
                                }else{return true;}
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