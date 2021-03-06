<?php include("header.php"); ?>

<script src="https://maps.googleapis.com/maps/api/js"></script>
<script type="text/javascript">
    function initialize() {
        var myLatlng = new google.maps.LatLng(52.48459333, 6.10202819);
        var mapOptions = {
            zoom: 15,
            center: myLatlng
        }
        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: 'Laurens Telecom'
        });
    }

    google.maps.event.addDomListener(window, 'load', initialize);
</script>
<section class="container groeneLijnRest">
    <div class="col-md-8 col-md-push-2" >
        <article class="divGrijsRest">
            <h3 class="h3Index">Contact</h3>
            <div class="innerdivIndex">
                <div id="map-canvas"></div>
                <div>
                    <p class="blauwKleur">Adres: </p>
                    Provincieroute 23, 8016AE Zwolle
                </div>
            </div>
        </article>
    </div>
</section>

<?php include("footer.php"); ?>