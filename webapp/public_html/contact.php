<?php include("header.php"); ?>

<script src="https://maps.googleapis.com/maps/api/js"></script>
<script type="text/javascript">
    function initialize() {
        var myLatlng = new google.maps.LatLng(52.500035, 6.079423, 281);
        var mapOptions = {
            zoom: 15,
            center: myLatlng
        }
        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: 'Windesheim Zwolle'
        });
    }

    google.maps.event.addDomListener(window, 'load', initialize);
</script>
<section class="container oranjeLijnRest">
    <div class="col-md-8 col-md-push-2" >
        <article class="divGrijsRest">
            <h3 class="h3Index">Contact</h3>
            <div class="innerdivIndex">
                <div id="map-canvas"></div>
                <div>
                    <p class="blauwKleur">Adres: </p>
                    Campus 2-6, 8017 CA Zwolle
                </div>
            </div>
        </article>
    </div>
</section>

<?php include("footer.php"); ?>