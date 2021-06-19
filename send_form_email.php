<?php
include "pages/head.php";
include "pages/header.php";
if(isset($_POST['email'])) {
 
    $emailKorisnika = $_POST['email'];
    $email_to = "$emailKorisnika"; // naziv poslovne mejl adrese (npr. info@nescafe.com)
    $email_subject = "Naručena karta";
 
    function died($error) {
        // error kod 
        echo "<h2 class='h2'>Zao nam je, ali pojavio se problem sa izvrsavanjem ove forme.</h2><br/>";
        echo $error."<br /><br />";
        echo "Vratite se nazad i pokusajte da ispravite problem.<br /><br />";
        die();
    }
 
 
    // validaciona provera parametara
    if(!isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['phone']) ||
        !isset($_POST['comments'])) {
        died('Greska.');       
    }
 
     
 
    $first_name = $_POST['name']; // required
    //$last_name = $_POST['last_name']; // required
    $email_from = $_POST['email']; // required
    $telephone = $_POST['phone']; // required 
    $comments = $_POST['comments']; // required 
 
    $error_message = "";
    // $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    $reFirstLastName = "/^[A-Z][a-z]{2,14}(\s[A-Z][a-z]{2,14})*$/";
    
    $reUsername = "/^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/";
    $rePassword="/^(?=.[A-Za-z])(?=.\d)(?=.[@$!%#?&])[A-Za-z\d@$!%*#?&]{8,}$/";
    $reMail="/^[a-z][a-z\d\_\.\-]+\@[a-z\d]+(\.[a-z]{2,4})+$/";
    $rePhone = "/^(060|061|062|063|064|065|066|069)([0-9]{6,7})$/";

  if(!preg_match($reMail,$email_from)) {
    $error_message .= 'Uneta email adresa nije validna<br/>';
  }
 
    // $string_exp = "/^[A-ZŽŠČĆĐa-zžščćđ .'-]+$/";
 
  if(!preg_match($reFirstLastName,$first_name)) {
    $error_message .= 'Niste lepo upisali ime.<br/>';
  }

  if(!preg_match($rePhone, $telephone))
  {
    $error_message .= 'Niste lepo upisali telefon<br/>';
  }
 
  if(strlen($comments) < 2) {
    $error_message .= 'Komentar mora imati 3 karaktera.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Form details below.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
    $email_message .= "Uspešno ste naručili kartu za BRE žurku.". "\n";
    $email_message .= "Ime: ".clean_string($first_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Broj telefona: ".clean_string($telephone)."\n";
    $email_message .= "Komentar: ".clean_string($comments)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- include your own success html here -->
 
Uspešno ste poručili kartu. Nadamo se da ćete se lepo provesti.<br/>

<?php 
echo $email_to;
echo "<br/><br/>";
echo "Ime: ".$first_name;
echo "<br/>Broj telefona: ".$telephone;
//echo "<br/>Lastname: ".$last_name;
echo "<br/>Vas komentar: ".$comments;
?>
 
<?php
 
}
else
{
  echo "<h1>Niste popunili prijavu</h1><br/><a href='index.php'>Vratite se na početnu</a>";
}
include "pages/footer.php";
?>