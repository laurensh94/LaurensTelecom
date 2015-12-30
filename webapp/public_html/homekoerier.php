<?php

include("header.php");
//if (!isset($_GET['inloggen'])) {
//    header("Location: index.php");
//}
?>
<section class="container oranjeLijnRest">
    <div class="col-md-6 col-md-push-3" >
        <article class="divGrijsInfo">
            <h3>Home</h3>
            <div class="articleInner">
                <div>
                    <form class="form-inline">
                        <div class="form-group">
                            <input type="text" class="form-control" id="Naam" placeholder="Naam">
                            <input type="email" class="form-control" id="Email" placeholder="E-mail">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="Telefoonnummer" placeholder="Telefoonnummer">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="IBAN" placeholder="IBAN">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="Straat" placeholder="Straat">
                            <input type="text" class="form-control" size="5" id="Huisnr" placeholder="Huisnr">
                            <input type="text" class="form-control" size="5" id="Toevoeging" placeholder="Toevoeging">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="Postcode" placeholder="Postcode">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="Plaats" placeholder="Plaats">
                        </div>
                        <div>
                            <input type="checkbox" name="androidsmartphone" class="checkSmartphone">
                            <label class="koerierSmartphone">Bezit android smartphone</label>
                        </div>
                        <center><input type="button" name="verstuurPakket" onclick="wordKoerier()" value="Verstuur" class="btn btn-default knopAanmeldenPakket"></center>
                    </form>
                </div>
                <div>
                    <form method="POST" class="form-horizontal">
                        <div class="form-group" >
                            <label class="blauwKleur">Gebruikersnaam wijzigen:</label>
                            <input  class="form-control" placeholder="Oude gebruikersnaam">
                            <input  class="form-control" placeholder="Nieuwe gebruikersnaam">
                        </div>
                        <div class="form-group">
                            <label class="blauwKleur">Wachtwoord wijzigen:</label>
                            <input  class="form-control" placeholder="Oude wachtwoord">
                            <input  class="form-control" placeholder="Nieuwe wachtwoord">
                        </div>
                        <center><input type="button" name="wijzigaanmeldgegevens" value="Wijzig" class="btn btn-default knopAanmeldenPakket"></center>
                    </form>
                </div>
            </div>
        </article>
    </div>
</section>
</div>
<?php include("footer.php"); ?>