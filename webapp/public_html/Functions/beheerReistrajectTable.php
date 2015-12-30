<?php session_start();?>
<?php ini_set('display_errors', 1);  error_reporting(E_ALL);
    include("../resources/bootstrap/css/bootstrap.min.css");
    include("../resources/Style.css");
?>

<tr><th>Route</th><th>Vertrektijd</th><th>Moment</th><th colspan="2">Instellingen</th></tr>

<?php
include("Functions.php");
foreach(getReistrajectData($_SESSION["PersoonID"]) as $key => $value){
$startstation = getStationName($value[2]);
$eindstation = getStationName($value[3]);
?>
    <tr id="<?php echo $key; ?>">
        <td class="tableData <?php echo $value[0]; ?>"><?php echo $startstation ?> - <?php echo $eindstation ?></td>
        <td class="tableData <?php echo $value[0]; ?>"><?php echo $value[4] ?></td>
        <td class="tableData <?php echo $value[0]; ?>"><?php echo $value[5] ?></td>
        <td><button class="btn btn-default" onclick="delet(<?php echo $value[0];?>)">Verwijder</button></td>
    </tr>
<?php
}
?>

<script>
    function delet(id){
        if(confirm("Weet u zeker dat u dit traject wilt verwijderen?")===true){
            $.post("/Functions/deleteReistraject.php", {
                ReistrajectID: id
            }, function(data){
                if(data !== "0"){
                    $("#routesTable").load("Functions/beheerReistrajectTable.php");
                }else{
                    alert("Er kan geen verbinding gemaakt worden.");
                }
            });
        }
    }
</script>