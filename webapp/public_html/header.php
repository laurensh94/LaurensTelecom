<?php session_start(); ini_set('display_errors', 1);  error_reporting(E_ALL);
if(!isset($_SESSION["Access"])){
    $_SESSION["Access"] = 0;
}
if(isset($_GET["Logout"])){
    $Logout = $_GET["Logout"];
    if($Logout == true){
        $_SESSION["Access"] = 0;
        session_destroy();
    }
}
include("functions/functions.php");
$link = connect();
?>
<html>
    <head>
        <title>Laurens Telecom</title>
        <meta name="description" content="Laurens Telecom" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
        <link href="resources/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="resources/Style.css" rel="stylesheet">
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="resources/bootstrap/js/bootstrap.js"></script>
        <script type="text/javascript" src="resources/Style.js"></script>
    </head>
    <body>
        <div id="page">
            <header class="container-fluid">

                    <header class="container-fluid">

                        <?php
                        if($_SESSION["Access"] == 0){?>
                            <div id="Login">
                                <form method="POST">
                                    <div class="form-group">
                                        <input type="text" placeholder="Gebruikersnaam" id="GebruikersnaamHeader" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" placeholder="Wachtwoord" id="WachtwoordHeader" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-default btn-custom" onclick="Login()">Inloggen</button>
                                    </div>
                                </form>

                            </div>
                            <label id="LoginLabel">Login</label>
                        <?php }else{ ?>
                            <div id="User">
                                <form method="POST">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-default btn-custom" onclick="Logout()">Uitloggen</button>
                                    </div>
                                </form>
                            </div>
                            <label id="UserLabel"><?php echo $_SESSION["Gebruikersnaam"];?></label>
                        <?php }?>

                        <script type="text/javascript">
                            function Login(){
                                var Gebruikersnaam = $("#GebruikersnaamHeader").val();
                                var Wachtwoord = $("#WachtwoordHeader").val();

                                if(Gebruikersnaam.length > 0 && Wachtwoord.length > 0){
                                    $("#GebruikersnaamHeader").css({border:"1px solid #ccc"});
                                    $("#WachtwoordHeader").css({border:"1px solid #ccc"});

                                    $.post( "/functions/Login.php", {
                                        Gebruikersnaam: Gebruikersnaam,
                                        Wachtwoord: Wachtwoord
                                    }, function(data){
                                        if(data.connectError !== 0){
                                            if(data.Access === 1){
                                                window.location.href = "index.php";
                                            }else{
                                                alert(data.Access);
                                            }

                                            $("#GebruikersnaamHeader").val("");
                                            $("#WachtwoordHeader").val("");
                                        }else{
                                            $("#WachtwoordHeader").val("");
                                            alert("Er kan geen verbinding gemaakt worden.");
                                        }
                                    }, "json");
                                }else{
                                    $("#GebruikersnaamHeader").css({border:"1px solid red"});
                                    $("#WachtwoordHeader").css({border:"1px solid red"});
                                }
                            }

                            function Logout(){
                                var x = confirm("Weet je zeker dat je wilt uitloggen?");
                                if(x === true){
                                    window.location.href = "index.php?Logout=true";
                                }
                            }
                        </script>

                 <nav class="navbar navbar-default">
                    <div class="container headerInner">

                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a href="index.php"><img id="Logo" src="resources/logo.png" alt="Logo"></a>
                        </div>

                        <div id="navbar" class="navbar-collapse collapse">
                            <ul class="nav navbar-nav">
                                <li><a href="index.php">Home</a></li>
                                <li><a href="telefoons.php">Telefoons</a></li>
                                <li><a href="tablets.php">Tablets</a></li>
                                <li><a href="contact.php">Contact</a></li>
                                <li><a href="registreer.php">registreer</a></li>
                            </ul>
                        </div>

                    </div>
                </nav>
            </header>