<?php
include("header.php");
?>
    <section class="container groeneLijnRest">
        <article class="divGrijsInfo">
            <h3>Apple iPhones</h3>
            <div class="articleInner">
                <div class="container">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-md-10 col-md-offset-1">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th class="text-center">Prijs</th>
                                        <th> </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $query = "SELECT * FROM Artikel WHERE Merk = 'Xiaomi' AND Categorie = 1";
                                    $result = mysqli_query($link, $query);


                                    if ($result->num_rows === 0) {
                                        if (mysqli_error($link)) {
                                            echo "FOUT: " . mysqli_error($link);
                                        } else {
                                            echo "<p> Op dit moment zijn er geen telefoons aanwezig. Houd de website in de gaten voor nieuwe telefoons</p>";
                                        }
                                    } ?>

                                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <tr>
                                            <td class="col-sm-8 col-md-6">
                                                <div class="media">
                                                    <?php echo "<img class='foto' src= '" . $row['Afbeelding'] . "' alt='Telefoon'><br>"; ?>
                                                    </a>
                                                    <div class="media-body">
                                                        <h4 class="media-heading"><?php echo $row["Merk"] . " " . $row["Model"]; ?></h4>
                                                        <h5 class="media-heading">
                                                            Omschrijving <?php echo $row["Omschrijving"]; ?></h5>
                                                        <span>Status: </span><span class="text-success"><strong>Op
                                                                voorraad</strong></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="col-sm-1 col-md-1 text-center">
                                                <strong> <?php echo "€" . $row["Prijs"]; ?> </strong></td>

                                            <td class="col-sm-1 col-md-1">
                                                <button type="button" class="btn btn-success">
                                                    stop in winkelwagen
                                                </button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>


<?php include("footer.php"); ?>