<?php ini_set('display_errors', 1);
error_reporting(E_ALL);
include("header.php"); ?>

    <section class="container groeneeLijnRest">
        <div class="col-md-6 col-md-push-3">
            <article>
                <h3>Registreer</h3>
                <div class="articleInner">
                    <form class="form-inline" name="Registreer" action="functions/Registreren.php">
                        <div class="form-group">
                            <input type="text" class="form-control" id="Naam" placeholder="Naam*">
                            <input type="text" class="form-control" id="Gbrkrsnm" name="Gbrkrsnm"
                                   placeholder="Gebruikersnaam*">
                            <div class="form-group">
                                <input type="password" class="form-control" id="Wwoord" placeholder="Wachtwoord*">
                                <input type="password" class="form-control" id="Wwoord2"
                                       placeholder="Herhaal wachtwoord*">
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
                            <div style="text-align: center;"><input type="button" value="Verstuur" onclick="validateForm()"
                                                                    class="btn btn-success"></div>
                    </form>
                    <div id="Comment"></div>
                </div>
            </article>
        </div>
    </section>

    <script type="text/javascript">
        function Registreer() {
            var Naam = $("#Naam").val();
            var Postcode = $("#Postcode").val();
            var Huisnr = $("#Huisnr").val();
            var Toevoeging = $("#Toevoeging").val();
            var Plaats = $("#Plaats").val();
            var Straat = $("#Straat").val();
            var Gebruikersnaam = $("#Gbrkrsnm").val();
            var Wachtwoord = $("#Wwoord").val();
            var Wachtwoord2 = $("#Wwoord2").val();

            if (Wachtwoord === Wachtwoord2) {
                if (Naam.length === 0 || Postcode.length === 0 || Huisnr.length === 0 || Plaats.length === 0 ||
                    Straat.length === 0 || Gebruikersnaam.length === 0 || Wachtwoord.length === 0) {

                    $("#Comment").html("U bent iets vergeten in te vullen.");

                } else {
                    $.post("/functions/Registeren.php", {
                        Naam: Naam,
                        Postcode: Postcode,
                        Huisnummer: Huisnr,
                        Toevoeging: Toevoeging,
                        Woonplaats: Plaats,
                        Straat: Straat,
                        Gebruikersnaam: Gebruikersnaam,
                        Wachtwoord: Wachtwoord
                    )}}.done(function (data) {
            if (data !== "0") {
                $("#Naam").val("");
                $("#Postcode").val("");
                $("#Huisnr").val("");
                $("#Toevoeging").val("");
                $("#Plaats").val("");
                $("#Straat").val("");
                $("#Gbrkrsnm").val("");
                $("#Wwoord").val("");
                $("#Wwoord2").val("");
                $("#Comment").html("Succesvol toegevoegd");
            } else {
                $("#Comment").html("");
                alert("Er kan geen verbinding gemaakt worden.");
            }
        });
        }
        } else {
            $("#Comment").html("Uw ingevulde wachtwoorden komen niet overeen.");
        }
        }
    </script>

    <script type="text/javascript">
        function validateForm() {
            var x = document.forms["Registreer"]["Gbrkrsnm"].value;
            if (x.length === 0) {
                alert("Pass, hij doet het :D.");
                $("input[name=Registreer]").css({border: "1px solid red"});
                alert("Voer een gebruikersnaam in.");
                return false;
            } else {
                $("input[name=Gbrkrsnm]").css({border: "1px solid #ccc"});
                var dbcheck = checkdb(x);
                if (dbcheck !== "2") {
                    if (dbcheck !== "1") {
                        Registreer();
                        alert("Pass, hij doet het :D.");
                    } else {
                        alert("gebruikersnaam bestaat al! Kies een andere gebruikersnaam");
                        return false;
                    }
                } else {
                    alert("Er kan geen verbinding gemaakt worden.");
                    return false;
                }
            }
        }

        function checkdb(gebruikersnaam) {
            var result = "test";
            $.ajax({
                url: "/functions/UsernameValidate.php",
                async: false,
                type: 'POST',
                data: {Gebruikersnaam: gebruikersnaam},
                success: function (data) {
                    result = data;
                }
            });
            return result;
        }
    </script>


<?php include("footer.php"); ?>