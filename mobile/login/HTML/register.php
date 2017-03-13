<?php
ob_start();
session_start();
if( isset($_SESSION['user'])!="" ){
 header("Location: home.php");
}
include_once 'dbconnect.php';
require_once "Mail.php";
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!?#@%';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


if(isset($_POST['btn-signup'])) {
  
 $uname = trim($_POST['uname']);
 $email = trim($_POST['email']);
 $upass = generateRandomString();
 
 $email_subject = "Welkom bij MinetopiaATM!";
 $email_from = "henkdekipgaming@gmail.com";
 //create email
 $email_message .= "Beste ".$uname.",\n \n";
 $email_message .= "Welkom bij de MinetopiaATM community. \n";
 $email_message .= "Deze website is speciaal voor 1 plugin gemaakt, namelijk de MinetopiaATM plugin. \n";
 $email_message .= "Nu je een account hebt op deze website kan je de premium versie kopen, of de gratis versie downloaden. \n \n";
 $email_message .= "Je gegevens: \n";
 $email_message .= "Je username: ".$uname." \n";
 $email_message .= "Je mailadres: ".$email." \n";
 $email_message .= "Je wachtwoord: ".$upass." \n \n";
 $email_message .= "Met vriendelijke groet, \n \n Karsten (HenkDeKipGaming) \n \n";
 $email_message .= "Als je je niet aangemeld hebt op http://www.minetopiaATM.nl en je hoeft er geen account, dan hoef je niks meer te doen. \n";
 $email_message .= "Heb je je niet aangemeld maar wil je wel een account, email dan zsm naar HenkDeKipGaming@gmail.com \n";
 
 //NEW
 $from = 'henkdekipgaming@gmail.com';

$headers = array(
    'From' => $email_from,
    'To' => $email,
    'Subject' => $email_subject
);

$smtp = Mail::factory('smtp', array(
        'host' => 'ssl://smtp.gmail.com',
        'port' => '465',
        'auth' => true,
        'username' => 'henkdekipgaming@gmail.com',
        'password' => '!BfgHgfXJKhb8!'
    ));

 
 // password encrypt using SHA256();
 $password = hash('sha256', $upass);
 
 
  $uname = strip_tags($uname);
 $email = strip_tags($email);
 // check email exist or not
 $query = "SELECT userEmail FROM users WHERE userEmail='$email'";
 $result = mysql_query($query);
 
 $count = mysql_num_rows($result); // if email not found then proceed
 
 if ($count==0) {
     
  $mail = $smtp->send($email, $headers, $email_message);
  $query = "INSERT INTO users(userName,userEmail,userPass,download) VALUES('$uname','$email','$password','0')";
  $res = mysql_query($query);
   
  if ($res) {
   $errTyp = "success";
   $errMSG = "succesvol geregistreerd! Check je email voor meer informatie. ";
   
  } else {
   $errTyp = "Error";
   $errMSG = "Oeps, er ging iets mis, probeer later opnieuw..."; 
  } 
   
 } else {
  $errTyp = "Fout!";
  $errMSG = "Sorry Dit mailadres wordt al gebruikt...";
 }
 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.css" rel="stylesheet">
        <!-- Template CSS -->
        <link rel="stylesheet" href="assets/css/animate.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/nexus.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/responsive.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/custom.css" rel="stylesheet">
        <!-- Google Fonts-->
        <link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=PT+Sans" type="text/css" rel="stylesheet">
        <link href="http://fonts.googleapis.com/css?family=Roboto:400,300" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MinetopiaATM - Registreer</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>

<div class="container">

 <div id="login-form">
    <form method="post" autocomplete="off">
    
     <div class="col-md-12">
        
         <div class="form-group">
             <h2 class="">Registreer.</h2>
            </div>
        
         <div class="form-group">
             <hr />
            </div>
            
            <?php
   if ( isset($errMSG) ) {
    
    ?>
    <div class="form-group">
             <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
             </div>
                <?php
   }
   ?>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="uname" class="form-control" placeholder="Gebruikersnaam" required />
                </div>
            </div>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
             <input type="email" name="email" class="form-control" placeholder="voorbeeld@mail.com" required />
                </div>
            </div>
            
            
            
            <div class="form-group">
             <hr />
            </div>
            
            <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Registreer</button>
            </div>
            
            <div class="form-group">
             <hr />
            </div>
            
            <div class="form-group">
             <a href="login.php">Ga naar login</a>
            </div>
        
        </div>
   
    </form>
    </div> 

</div>

</body>
</html>