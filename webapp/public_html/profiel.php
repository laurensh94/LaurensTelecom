<?php include("header.php"); 
include("Functions/Functions.php");
echo checkSession();

$persoonData = getPersoon($_SESSION["PersoonID"]);
$treinreizigerData = getTreinreiziger($_SESSION["PersoonID"]);
$loginData = getLogingegevens($_SESSION["PersoonID"]);
$adresData = getAdres($persoonData[2]);
?>

<section class="container">
    <div>
        <article class="col-md-6 col-md-push-3">
            <h3>Instellingen</h3>
            <div class="articleInner">
                <form method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" id="Naam" placeholder="Naam*" value="<?php echo $persoonData[1]; ?>">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="Email" placeholder="E-mail*" value="<?php echo $treinreizigerData[3]; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="Telefoonnummer" placeholder="Telefoonnummer*" value="<?php echo $treinreizigerData[1]; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="IBAN" placeholder="IBAN*" value="<?php echo $treinreizigerData[2]; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="Gbrkrsnm" placeholder="Gebruikersnaam*" value="<?php echo $loginData[1]; ?>">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="Wwoord" placeholder="Wachtwoord*">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="Wwoord2" placeholder="Herhaal wachtwoord*">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="Straat" placeholder="Straat*" value="<?php echo $adresData[4]; ?>">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" size="5" id="Huisnr" placeholder="Huisnr*" value="<?php echo $adresData[2]; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" size="5" id="Toevoeging" placeholder="Toevoeging" value="<?php echo $adresData[3]; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="Postcode" placeholder="Postcode*" value="<?php echo $adresData[1]; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="Plaats" placeholder="Plaats*" value="<?php echo $adresData[5]; ?>">
                    </div>
                    <center><input type="button" onclick="wijzigKoerier()" value="Wijzig" class="btn btn-default knopAanmeldenPakket"></center>
                </form>
                <div id="Comment"></div>
            </div>
        </article>
    </div>
</section>

<script type="text/javascript">
    function wijzigKoerier(){
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
        
        if(Wachtwoord === Wachtwoord2){
            if(Naam.length === 0 || Postcode.length === 0 || Huisnr.length === 0 || Plaats.length === 0 || 
                Straat.length === 0 || Email.length === 0 || Telefoonnummer.length === 0 || IBAN.length === 0 ||
                Gebruikersnaam.length === 0 || Wachtwoord.length === 0){
                $("#Comment").html("U bent iets vergeten in te vullen.");
            }else{
                $.post( "/Functions/wijzigKoerier.php", {
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
                        $("#Comment").html("Succesvol toegevoegd");
                        $("#Wwoord").val("");
                        $("#Wwoord2").val("");
                    }else{
                        $("#Comment").html("");
                        alert("Er kan geen verbinding gemaakt worden.");
                    }
                });
            }
        }else{
            $("#Comment").html("Uw ingevulde wachtwoorden komen niet overeen.");
        }
    }
</script>

<?php include("footer.php");?>