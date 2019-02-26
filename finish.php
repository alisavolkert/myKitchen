<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

require_once('./db/database.php');

if (!isset($_SESSION["user_id"]))
{
    echo 'Der Versuch wurde nicht ordnungsgemäß ausgeführt, oder es ist ein Fehler aufgetreten. Bitte beginn den Versuch <a href="index.php">erneut</a>.';
    die();
} else {
    $db = new Database();
    if ($db->setCompletedById($_SESSION['user_id'])) {
//        unset($_SESSION['user_id']);
    }
}

function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
}



function form_is_correct()
{
    global $errorstring;
    $errorstring = "";

    if(!validate_email($_REQUEST["email"]))
    {
        $errorstring.= "Bitte gib eine gültige Mailadresse ein.<br>";
    }

//    if(!isset($_REQUEST["agreement"]))
//    {
//        $errorstring.= "Ihre Einwilligung ist für die Teilnahme am Versuch erforderlich.<br>";
//    }


    if ($errorstring=="")
        return TRUE;
    else
        return FALSE;
}

function validate_email($temail){
    // Create the syntactical validation regular expression
    $regexp = "/^([_a-z0-9-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/";
    // Presume that the email is invalid
    $valid = 0;
    // Validate the syntax
    if (preg_match($regexp, $temail))
    {
        list($username,$domaintld) = explode("@",$temail);
        $valid = 1;
    }
    return $valid;
}

function get_form($errorstring = "", $email = "")
{
    $form = '

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheets/exp.css" />
    <title>Studie Gruppierung von Küchengegenständen</title>
</head>
<body>
<img src="img/logo_web.png" id="logo">
<br>
<br>
<h3> Vielen Dank für deine Teilnahme!</h3> 
<!--<p id="expstart"><b>Vielen Dank</b> für Ihr Interesse an unserer Studie!</p>-->
<br>




<form action="finish.php#personaldata" method="POST" id="personaldata" class="hl">
    <h4>Teilnahme am Gewinnspiel</h4>
<!--    <p>Zur Verknüpfung Ihrer Entscheidung mit Ihrer Person benötigen wir Ihre Mailadresse.</p>-->

    <p>Wenn du am Gewinnspiel teilnehmen möchtest, um einen von 10 Gutscheinen im Wert von je 20 € für den Tübinger Einzelhandel zu gewinnen, gib bitte deine Mailadresse an.</p>
    <p>Wenn du lieber eine halbe Versuchspersonenstunde ausgestellt haben möchtest, gib bitte deine Matrikelnummer an. </p> <!-- TODO: nach Pilottest entscheiden, ob halbe oder ganze VP-Stunde ausstellen.-->
    <p>Deine Mailadresse und Matrikelnummer werden getrennt von deinen Daten aus dem Experiment gespeichert. So ist kein Rückschluss auf deine Person möglich.
        </p>
    <p>Bitte beachte, dass du nur an der Verlosung teilnehmen kannst, wenn du eine gültige Mailadresse angibst.</p>
    <span class="error">' . $errorstring . '</span>
    <p>
        <label for="email" >Mailadresse:</label>
        <input type="email" name="email" id="email" size="50" maxlength="100" value="' . $email . '" required>

    </p>
   <!-- <p>
        <input type="checkbox" name="agreement" id="agreement">
        <label for="agreement">Ich willige der Erklärung zur Erhebung und Verarbeitung meiner personenbezogenen Daten ein.</label>
    </p>
-->
    <button type="submit">Am Gewinnspiel teilnehmen</button>
</form>

<br>
Ansprechpartnerin: <br>
Alisa Volkert, M.Sc.<br>
E-Mail: <span class="mailadr">alisa.volkert (@) uni-tuebingen.de</span><br>

<br>
<!--<b><a href="exp3.php">WEITER</a></b>-->
<br>

<hr>
<span class="footer">Alisa Volkert, M.Sc., Medieninformatik (Arbeitsbereich Mensch-Computer Interaktion & Künstliche Intelligenz)</span>


</body>

</html>';
      return $form;
}


if(!isset($_REQUEST["email"]))
  echo get_form();
else
{
  if(form_is_correct()) {
    // Save mail to session
    
    // email
      if($db->insertMailAdress($_REQUEST["email"])) {
        echo '<h3>Vielen Danke für Ihre Teilnahme!</h3>';
        echo 'Ihre Mailadresse wurde gespeichert.';
        echo '<br><br> Sie können dieses Browserfenster nun schließen.';
      } else {
          echo 'Something went wrong while saving the mailaddress!';
          echo 'Error: ' . $db->insertMailAdress($_REQUEST["email"]);
          get_form();
      }

//    $email = (isset($_REQUEST["email"])) ? stripslashes( strip_tags( trim( $_REQUEST["email"] ))) : "";
//    $_SESSION["email"]=$email;

    // Give me the next page  
//    redirect("exp3.php");

  } else {

    echo get_form($errorstring, $email);

  }

}

