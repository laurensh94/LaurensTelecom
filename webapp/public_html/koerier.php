<?php include("header.php"); ?>
<section class="container oranjeLijnRest">
    <div class="col-md-6 col-md-push-3" >
        <article>
            <h3>Koerier worden</h3>
            <div class="articleInner">
                <form class="form-inline" name="TrackTrace" >
                    <div class="form-group">
                        <input type="text" class="form-control" id="Naam" placeholder="Naam*">
                        <input type="email" class="form-control" id="Email" placeholder="E-mail*">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="Telefoonnummer" placeholder="Telefoonnummer*">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="IBAN" placeholder="IBAN*">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="Gbrkrsnm" name="Gbrkrsnm" placeholder="Gebruikersnaam*">
                        <input type="password" class="form-control" id="Wwoord" placeholder="Wachtwoord*">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="Wwoord2" placeholder="Herhaal wachtwoord*">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="Straat" placeholder="Straat*">
                        <input type="number" class="form-control" id="Huisnr" placeholder="Huisnr*">
                        <input type="text" class="form-control" id="Toevoeging" placeholder="Toevoeging">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="Postcode" placeholder="Postcode*">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="Plaats" placeholder="Plaats*">
                    </div>
                    <div>
                        <input type="checkbox" id="androidsmartphone" class="checkSmartphone">
                        <label class="koerierSmartphone">Bezit android smartphone</label>
                    </div>
                    <center><input type="button" value="Verstuur" onclick="validateForm()" class="btn btn-default knopAanmeldenPakket"></center>
                </form>
                <div id="Comment"></div>
            </div>
        </article>
    </div>
</section>
</div>

<script type="text/javascript">
    function validateForm() {
        var x = document.forms["TrackTrace"]["Gbrkrsnm"].value;
        if (x.length === 0) {
            $("input[name=pakketnummer]").css({border:"1px solid red"});
            alert("Voer een gebruikersnaam in.");
            return false;
        }else{ 
            $("input[name=Gbrkrsnm]").css({border:"1px solid #ccc"});
            var dbcheck = checkdb(x);
            if(dbcheck !== "2"){
                if(dbcheck !== "1"){
                    wordKoerier();
                }else{
                  alert("gebruikersnaam bestaat al! Kies een andere gebruikersnaam");
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
            url: "/Functions/UsernameValidate.php",
            async: false,
            type: 'POST',
            data: { Gebruikersnaam: pakketnr },
            success: function(data) {
                result = data;
            }
       });
       return result;
    }
</script>

<script type="text/javascript">
    function wordKoerier(){
        var Naam = $("#Naam").val();
        var Postcode = $("#Postcode").val();
        var Huisnr = $("#Huisnr").val(); 
        var Toevoeging = $("#Toevoeging").val();
        var Plaats = $("#Plaats").val();
        var Straat = $("#Straat").val();
        var Email = $("#Email").val();
        var Telefoonnummer = $("#Telefoonnummer").val();
        var IBAN = $("#IBAN").val();
        var Gebruikersnaam = $("#Gbrkrsnm").val();
        var Wachtwoord = $("#Wwoord").val();
        var Wachtwoord2 = $("#Wwoord2").val();
        var Smartphone = $("#androidsmartphone").is(":checked");
        //var ContractAkkoord = true;
        
        if(Smartphone === true){
            if(Naam.length===0){$("#Naam").css({border:"1px solid red"});}
            else{$("#Naam").css({border:"1px solid #ccc"});}
            if(Postcode.length===0){$("#Postcode").css({border:"1px solid red"});}
            else{$("#Postcode").css({border:"1px solid #ccc"});}
            if(Huisnr.length===0){$("#Huisnr").css({border:"1px solid red"});}
            else{$("#Huisnr").css({border:"1px solid #ccc"});}
            if(Plaats.length===0){$("#Plaats").css({border:"1px solid red"});}
            else{$("#Plaats").css({border:"1px solid #ccc"});}
            if(Straat.length===0){$("#Straat").css({border:"1px solid red"});}
            else{$("#Straat").css({border:"1px solid #ccc"});}
            if(Email.length===0){$("#Email").css({border:"1px solid red"});}
            else{$("#Email").css({border:"1px solid #ccc"});}
            if(Telefoonnummer.length===0){$("#Telefoonnummer").css({border:"1px solid red"});}
            else{$("#Telefoonnummer").css({border:"1px solid #ccc"});}
            if(IBAN.length===0){$("#IBAN").css({border:"1px solid red"});}
            else{$("#IBAN").css({border:"1px solid #ccc"});}
            if(Gebruikersnaam.length===0){$("#Gbrkrsnm").css({border:"1px solid red"});}
            else{$("#Gbrkrsnm").css({border:"1px solid #ccc"});}
            if(Wachtwoord.length===0){$("#Wwoord").css({border:"1px solid red"});}
            else{$("#Wwoord").css({border:"1px solid #ccc"});}
            if(Wachtwoord2.length===0){$("#Wwoord2").css({border:"1px solid red"});}
            else{$("#Wwoord2").css({border:"1px solid #ccc"});}
                 
            if(Wachtwoord === Wachtwoord2){
                if(Naam.length === 0 || Postcode.length === 0 || Huisnr.length === 0 || Plaats.length === 0 || 
                    Straat.length === 0 || Email.length === 0 || Telefoonnummer.length === 0 || IBAN.length === 0 ||
                    Gebruikersnaam.length === 0 || Wachtwoord.length === 0){
                    $("#Comment").html("U bent iets vergeten in te vullen.");
                }else{
                    $.post( "/Functions/wordKoerier.php", {
                        Naam: Naam,
                        Postcode: Postcode,
                        Huisnummer: Huisnr,
                        Toevoeging: Toevoeging,
                        Woonplaats: Plaats,
                        Straat: Straat,
                        Email: Email,
                        Telefoonnummer: Telefoonnummer,
                        IBAN: IBAN,
                        Gebruikersnaam: Gebruikersnaam,
                        Wachtwoord: Wachtwoord
                    }).done(function(data){
                        if(data !== "0"){
                            $("#Naam").val("");
                            $("#Postcode").val("");
                            $("#Huisnr").val(""); 
                            $("#Toevoeging").val("");
                            $("#Plaats").val("");
                            $("#Straat").val("");
                            $("#Email").val("");
                            $("#Telefoonnummer").val("");
                            $("#IBAN").val("");
                            $("#Gbrkrsnm").val("");
                            $("#Wwoord").val("");
                            $("#Wwoord2").val("");
                            $("#Comment").html("Succesvol toegevoegd");
                        }else{
                            $("#Comment").html("");
                            alert("Er kan geen verbinding gemaakt worden.");
                        }
                    });
                }
            }else{
                $("#Comment").html("Uw ingevulde wachtwoorden komen niet overeen.");
            }
        }else{
            $("#Comment").html("Om koerier te kunnen worden moet je in het bezit zijn van een android smartphone.");
        }
    }
</script>
<?php include("footer.php"); ?>