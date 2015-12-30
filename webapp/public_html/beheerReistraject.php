<?php include("header.php"); ini_set('display_errors', 1);  error_reporting(E_ALL);
include("Functions/Functions.php");
echo checkSession();

//get list of stations
$link = connect();
$Stations = getStationsIdName();

?>

<section class="container">
    <div class="col-md-12">
        <article>
            <h3>Beheer routes</h3>
            <div class="articleInner">
                <section>
                    <form class="form-inline" id="formRoute">
                        <div class="form-group">
                            <select name ="Van Station" class="form-control" id ="StationA">
                                <option value="" disabled selected>Van station</option>
                            <?php
                            foreach($Stations as $stationid => $Station){
                                echo '<option value= "'.$stationid.'">'.utf8_encode($Station).'</option>';
                            }
                            ?>
                            </select>
                            <!--<input type="text" id="StationA" class="form-control" placeholder="Van station">-->
                        </div>
                        <div class="form-group">
                            
                            <select name ="Naar Station" class="form-control" id ="StationB">
                                <option value="" disabled selected>Naar station</option>
                            <?php
                            foreach($Stations as $stationid => $Station){
                                echo '<option value= "'.$stationid.'">'.utf8_encode($Station).'</option>';
                            }
                            ?>
                            </select>
                            <!--<input type="text" id="StationB" class="form-control" placeholder="Naar station">-->
                        </div>
                        <div class="form-group">
                            <input type="time" id="Vertrektijd" class="form-control" placeholder="Vertrektijd (bijv. 11:59)">
                        </div>
                        <div class="form-group">
<!--                            <input type="text" id="Moment" class="form-control" placeholder="Moment">-->
                            <select name ="Naar Station" class="form-control" id ="Moment">
                                <option value="" disabled selected>Dag van de week</option>
                                <option value="Zondag">Zondag</option>
                                <option value="Maandag">Maandag</option>
                                <option value="Dinsdag">Dinsdag</option>
                                <option value="Woensdag">Woensdag</option>
                                <option value="Donderdag">Donderdag</option>
                                <option value="Vrijdag">Vrijdag</option>
                                <option value="Zaterdag">Zaterdag</option>
                        </div>
                        <div class="form-group">
                            <input type="button" onclick="insertReistraject()" class="btn btn-default btn-custom" value="Route toevoegen">
                        </div>
                    </form>
                    <script type="text/javascript">
                        function insertReistraject(){
                            
                            var Moment = $("#Moment").val();
                            var StationA = $("#StationA").val();
                            var StationB = $("#StationB").val();
                            var Vertrektijd = $("#Vertrektijd").val();
                            
                            if(Moment===null){$("#Moment").css({border:"1px solid red"});}
                            else{$("#Moment").css({border:"1px solid #ccc"});}
                            if(StationA===null){$("#StationA").css({border:"1px solid red"});}
                            else{$("#StationA").css({border:"1px solid #ccc"});}
                            if(StationB===null){$("#StationB").css({border:"1px solid red"});}
                            else{$("#StationB").css({border:"1px solid #ccc"});}
                            if(Vertrektijd===""){$("#Vertrektijd").css({border:"1px solid red"});}
                            else{$("#Vertrektijd").css({border:"1px solid #ccc"});}
                            
                            if(Moment !== null && StationA !== null && StationB !== null && Vertrektijd !== ""){
                                $.post( "/Functions/reistrajectBeheer.php", {
                                    Moment: Moment,
                                    StationA: StationA,
                                    StationB: StationB,
                                    Vertrektijd: Vertrektijd
                                }, function(){
                                    $("#routesTable").load("Functions/beheerReistrajectTable.php");
                                    $("#Moment").val("");
                                    $("#StationA").val("");
                                    $("#StationB").val("");
                                    $("#Vertrektijd").val("");
                                });
                            }else{
                              alert("U bent iets vergeten in te vullen!");
                            }
                        }
                    </script>
                </section>
                <section>
                    <table id="routesTable" class="table table-condensed tableRoute">
                        <script type="text/javascript">
                            $(document).ready(function(){
                                $("#routesTable").load("Functions/beheerReistrajectTable.php");
                            });
                        </script>
                    </table>
                </section>
            </div>
        </article>
    </div>
</section>

<?php include("footer.php");?>