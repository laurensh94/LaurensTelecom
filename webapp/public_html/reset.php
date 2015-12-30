<?php ini_set('display_errors',1);  error_reporting(E_ALL);
session_start();

 if(!isset($_SESSION["uRights"])){
        $_SESSION["uRights"] = 0; 
 }

include ("Functions/Functions.php");
 
include ('Functions/connect.php');
$link = connect();

//on load:
if (isset($_GET['token'])){
	$token = $_GET['token'];
}else if (isset($_POST['token'])){
	$token = $_POST['token'];
}

if(isset($token)){
	$userid = checkToken($token, $link);
	if($userid != 0){
		$allow_reset = true;
	}else{
		$allow_reset = false;
	}
}


if(isset($_POST["Submit"])){
	$updateStatus = updatePassword($token, $link);
	if($updateStatus == 1){
		$allow_reset = false;
		$message = 'Uw wachtwoord is gewijzigd';
	}else{
		$message = $updateStatus;
	}
	//$message = $updateStatus;
}
mysqli_close($link);
?>
<?php include 'header.php'?>
<section class="container">
    <div class="col-md-6">
        <article>
		<div style="padding:2px;padding-top:20px;">
			<h1 style="color:#751919;">Wijzig wachtwoord</h1>
            <?php 	if(isset($message)){echo $message;}
					if ($allow_reset == true){?>
			<form method="POST">
				<table>   
                    <tr><td>Wachtwoord</td><td><input <input pattern=".[!@#$%^&*()-+0-9A-Za-z]{5,}" required title="Minimaal 5 characters, een hoofdletter en één van de volgende tekens: .!@#$%^&*()-+" type="password" name="Password" placeholder="Wachtwoord" style="width:250px;padding:2.5px;"required></td></tr>
					<tr><td>Bevestig Wachtwoord</td><td><input type="password" name="RepeatPassword" placeholder="Herhaal wachtwoord" style="width:250px;padding:2.5px;"required></td></tr>
                    <input type="hidden" name="token" value="<?php echo $token;?>">
					<tr><td colspan="2"><input type="submit" name= "Submit" class="button1" value="Opslaan" style="float:right;margin-left:5px;">
					<input type="button" class="button1" onClick="location.href='index.php'" value='Annuleren' style="float:right;">
                </table>  
            </form> 
				<?php }else{ if(!isset($updateStatus)){ echo 'Deze token is niet geldig';}} ?>
		</div>
        </div>
        </article>
    </div>
</section>
    <?php include 'footer.php'?>