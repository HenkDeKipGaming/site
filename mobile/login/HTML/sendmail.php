<?php
 
if(isset($_POST['email'])) {
 
     
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
 
    $email_to = "HenkDeKipGaming@gmail.com";
 
    $email_subject = "Een nieuw plugin idee";
 
     
 
     
 
    function died($error) {
 
        // your error code can go here
 
        echo "Er zijn fouten gevonden in de gegevens. ";
 
        echo "Dit zijn de errors:.<br /><br />";
 
        echo $error."<br /><br />";
 
        echo "Ga aub terug en los deze errors op.<br /><br />";
 
        die();
 
    }
 
     
 
    // validation expected data exists
 
    if(!isset($_POST['first_name']) ||
 
        !isset($_POST['last_name']) ||
 
        !isset($_POST['email']) ||
 
        !isset($_POST['telephone']) ||
 
        !isset($_POST['comments'])) {
 
        died('Excuses, er is een onverwacht probleem ontstaan. Contacteer karsten.');       
 
    }
 
     
 
    $first_name = $_POST['first_name']; // required
 
    $last_name = $_POST['last_name']; // required
 
    $email_from = $_POST['email']; // required
 
    $telephone = $_POST['telephone']; // not required
 
    $comments = $_POST['comments']; // required
 
     
 
    $error_message = "";
 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
 
    $error_message .= 'Je email adres bestaat niet.<br />';
 
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
 
    $error_message .= 'Je voornaam is niet/niet goed ingevuld. ga terug.<br />';
 
  }
 
  if(!preg_match($string_exp,$last_name)) {
 
    $error_message .= 'Je achternaam is niet/niet goed ingevuld. ga terug.<br />';
 
  }
 
  if(strlen($comments) < 2) {
 
    $error_message .= 'Je hebt geen plugin idee ingevuld.<br />';
 
  }
 
  if(strlen($error_message) > 0) {
 
    died($error_message);
 
  }
 
    $email_message = "Details:\n\n";
 
     
 
    function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:","cc:","href");
 
      return str_replace($bad,"",$string);
 
    }
 
     
 
    $email_message .= "Voornaam: ".clean_string($first_name)."\n";
 
    $email_message .= "Achternaam: ".clean_string($last_name)."\n";
 
    $email_message .= "Email: ".clean_string($email_from)."\n";
 
    $email_message .= "Plugin naam: ".clean_string($telephone)."\n";
 
    $email_message .= "Plugin idee: ".clean_string($comments)."\n";
 
     
 
     
 
// create email headers
 
$headers = 'From: '.$email_from."\r\n".
 
'Reply-To: '.$email_from."\r\n" .
 
'X-Mailer: PHP/' . phpversion();
 
@mail($email_to, $email_subject, $email_message, $headers);  
 
?>
 
 
 
<!-- include your own success html here -->
 
 
 
Bedankt voor dit idee!
Ik zal je binnenkort een email sturen of het mogelijk is en of/hoeveel het geld gaat kosten.
 
 
 
<?php
 
}
 
?>