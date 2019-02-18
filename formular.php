<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL|E_STRICT);
require_once('./db/database.php');
$db = new Database();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["vollj"], $_SESSION['dtkenntn']))
{
    echo 'Der Versuch wurde nicht ordnungsgemäß ausgeführt, oder es ist ein Fehler aufgetreten. Bitte beginnen Sie den Versuch <a href="index.php">erneut</a>.';
    die();
} else {

//    setcookie("email", $email, time() + 7200);
    $dk = (int) $_SESSION["dtkenntn"];
    $vj = (int) $_SESSION["vollj"];


//    $newID = mt_rand(20000000, 30000000);
//    $db->addEmptyRow();
//    if ($db->getLastUserId()) {$newID = $db->getLastUserId();}
//    $_SESSION['id'] = $newID;
//    setcookie('id', $newID, time() + 7200);

    if ($db->saveUserData($dk,$vj)) {


        $userid = $db->getLastUserId();
        $_SESSION['user_id'] = $userid;
        setcookie("userID", $userid, time() + 7200);

        unset($_SESSION["dtkenntn"]);
        unset($_SESSION["vollj"]);
//            echo "saved";
//        }
    } else {
        die("Errormessage: ". $db->saveUserData($dk,$vj));
    }

//} else {
//    echo 'Der Versuch wurde nicht ordnungsgemäß ausgeführt, oder es ist ein Fehler aufgetreten. Bitte beginnen Sie den Versuch <a href="index.php">erneut</a>.';
//    die();
}
?>

<!DOCTYPE html>
<html>

  <head>

    <title>Einräumen einer simulierten Küche</title>
    <meta charset="utf-8">

	  <link rel="stylesheet" type="text/css" href="stylesheets/style.css">

    <script type="text/javascript" src="https://code.jquery.com/jquery-1.10.2.js"></script>
  	<script type="text/javascript" src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script type="text/javascript">
      // Eingabefelder überprüfen
      function checkInput(form){
        // Name - kein leeres Feld
        // if (form.name.value == "") {
        //   alert("Bitte geben Sie Ihren Nicknamen ein!");
        //   form.name.focus();
        //   return false;
        // }

        // Ã„lter soll ein Zahl zwischen 0 und 100 sein
        var age = form.age.value;
        age = Number(age);
        if (isNaN(form.age.value) || age == 0) {
          alert("Bitte gib dein Alter an!");
          form.age.focus();
          return false;
        }
		//alter
        if (age < 0 || age > 100) {
          alert("Bist du ernsthaft " + age + " Jahre alt?");
          form.age.focus();
          return false;
        }
		
        if (Number(form.hours1.value) < 0) {
          alert("Die Zahl sollte positiv sein");
          form.hours1.focus();
          return false;
        }
		//wie lange Küche
        var hours2 = form.hours2.value;
        if (isNaN(hours2) || hours2 == "" || Number(hours2) < 0) {
          alert("Bitte gib an, wie viele Stunden du letzte Woche in der K&uuml;che verbracht hast.");
          form.hours2.focus();
          return false;
        }

        return true;
      }
  </script>

  </head>

  <body onload="document.kontaktformular.name.focus();">
    <h1>K&uuml;chensimulation</h1>

    <p>Bitte mach folgende Angaben: </p>
    <div class="all">
      <form id="kontaktformular" name="kontaktformular" action="mykitchen.php" method="post" onsubmit="return checkInput(this)">
        <table>
<!--          <tr>-->
<!--            <td>-->
<!--				Nickname:-->
<!--			</td>-->
<!--            <td class="abstand">-->
<!--				<input type="text" name="nickname" id="name" required/>-->
<!--			</td>-->
<!--          </tr>-->
          <tr>
            <td>
				Anrede:
			</td>
            <td class="abstand">
              <select id="anrede" name="anrede" size="1" required>
                  <option value="" disabled selected>Wählen Sie eine Option</option>
                  <option>Frau</option>
                  <option>Herr</option>
              </select>
          </tr>
          <tr>
            <td>
				Alter:
			</td>
            <td class="abstand">
				<input type="number" min="18" max="100" name="age" id="age" required/>
			</td>
          </tr>
		  
		  <tr>
            <td>
				K&ouml;rpergr&ouml;&szlig;e (cm):
			</td>
            <td class="abstand">
				<input type="number" min="0" max="250" name="bodyheight" id="bodyheight" required/>
			</td>
          </tr>
		  
          <tr>
            <td>
				Welcher Kultur fühlst du dich am ehesten verbunden:
			</td>
            <td class="abstand">
				<input type="checkbox" name="nat_de" id="nat_de"> deutsch </input><br />
				<input type="checkbox" name="nat_fr" id="nat_fr"> französisch </input><br />
				<input type="checkbox" name="nat_other" id="nat_other"> Sonstiges: <input type="text" name="nationality" id="nationality" /></input>
			</td>
          </tr>
		  
		  <tr>
            <td>
				Beschäftigung: <!-- TODO: Hier bitte nach Wochenarbeitszeit fragen. -->
			</td>
            <td class="abstand">
				<input type="text" id="job" name="job"/><br />
				<input type="checkbox" name="job_full" id="job_full"> Vollzeit </input><br />
				<input type="checkbox" name="job_part" id="job_part"> Teilzeit </input>
			</td>
          </tr>
		  
          <tr>
            <td>Wie viele Stunden hast du am letzten Werktag in <br />der K&uuml;che verbracht?</td>
            <td class="abstand"><input type="number" min="0" id="hours1" name="hours1"/></td>
          </tr>
          <tr>
            <td>Wie viele Stunden hast du nach eigener Einsch&aumltzung <br />vergangene Woche in der K&uuml;che zu Hause gearbeitet?</td>
            <td class="abstand"><input type="number" min="0" id="hours2" name="hours2" required/></td>
          </tr>
          <tr>
            <td></td>
            <td class="abstand"><input id="but" type="submit" value="Zur K&uuml;chensimulation" required/></td>
          </tr>
        </table>
      </form>
    </div>

	</body>

</html>
