<?php ini_set('display_errors',1);  error_reporting(E_ALL);

if(isset($_POST['submit'])){
    include 'Functions/Functions.php';
    $link = connect();
    
    $username = $_POST['username'];
    
    $get_user = mysqli_query($link, "SELECT * FROM Logingegevens WHERE Gebruikersnaam = '$username' LIMIT 1");
    $user_data = mysqli_fetch_assoc($get_user);
    $userid  = $user_data['PersoonID'];
    
    if(!$get_user || $userid == 0){
        $message = 'gebruiker niet gevonden!';
    }else{
        
    $stmt = mysqli_prepare($link, "SELECT Email FROM Treinreiziger WHERE PersoonID = \"$userid\"");
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $email);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);
    //mysqli_close($link);
        
        $random_string = generateRandomString(20);
        $timestamp = date(time());
        $mySqlDate = date('Y-m-d H:i:s', $timestamp);
        $token = $timestamp.$random_string;
        $reset = mysqli_query($link, "INSERT INTO PasswordReset (PersoonID, resetcode, timestamp) VALUES ('$userid', '$token', '$mySqlDate')");
        $message = 'Er is een email verstuurd met een reset link';
        sendmail($email, $token); 
        
        mysqli_close($link);
    }
}

function sendmail($email, $token){
    $to      = $email;
    $subject = 'Password reset UitgesteldKopjeKnippen.nl';
    $message = 'Klik op de volgende link om uw wachtwoord te wijzigen: '.$_SERVER['HTTP_HOST'].'/reset.php?token='.$token;
    $headers = 'From: webmaster@example.com' . "\r\n" .
        'Reply-To: webmaster@example.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);   
    
}

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    
    return $randomString;
}
?>
<?php include 'header.php'?>
<section class="container">
    <div class="col-md-6 col-md-push-3">
        <article>  
            <h3>Wachtwoord vergeten</h3>
            <div class="articleInner">
                <form action="" method="post" style="text-align:center;">
                    <div class="form-group">
                        <input name="username" placeholder="Gebruikersnaam" class="form-control" autofocus/>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" value="Verstuur" class="btn btn-default btn-custom"/>
                    </div>
                </form>
            <h3><?php if(isset($message)){echo $message;}?></h3>
            </div>
        </article>
    </div>
</section>
    <?php include 'footer.php'?>

