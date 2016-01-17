<?php 
    include("header.php");
    include("functions/functions.php");
?>
<section class="container oranjeLijnRest">
    <div class="col-md-6 col-md-push-3" >
        <article class="divGrijsInfo">
            <h3>Telefoons</h3>
            <div class="articleInner">
                <center>
                	<p>Klik op het logo om telefoons weer te geven </p><br>
                	<a href="*"><img class="merklogo" src="resources/images/merklogo/apple.png" alt="Apple Logo"></a>
                	<a href="*"><img class="merklogo" src="resources/images/merklogo/samsung.png" alt="Samsung Logo"></a>
                	<a href="*"><img class="merklogo" src="resources/images/merklogo/htc.png" alt="HTC Logo"></a><br>
                	<a href="*"><img class="merklogo" src="resources/images/merklogo/sony.png" alt="SONY Logo"></a>
                	<a href="*"><img class="merklogo" src="resources/images/merklogo/lg.png" alt="LG Logo"></a>
                	<a href="*"><img class="merklogo" src="resources/images/merklogo/huawei.png" alt="Huawei Logo"></a>
                    <br>
                    <br>
                    <?php
                        $link = connect();
                        $query = "SELECT * FROM Artikel WHERE Merk = 'Samsung' AND Categorie = 1";
                        $result = mysqli_query($link, $query);
                        $row = mysqli_fetch_assoc($result);

                        if($result->num_rows === 0){
                            echo "FOUT: ".mysqli_error($link);
                        }

                        while($row) {
                            echo"<img class='merklogo' src=".$row['Afbeelding']."alt='Telefoon'>";
                            echo $row["Merk"] ." ". $row["Model"]." EUR ".$row["Prijs"]." <br>";
                        }
                    ?>
                </center>
            </div>
        </article>
    </div>
</section>

<?php include("footer.php"); ?>