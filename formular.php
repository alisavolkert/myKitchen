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
//    echo 'Der Versuch wurde nicht ordnungsgemäß ausgeführt, oder es ist ein Fehler aufgetreten. Bitte beginnen Sie den Versuch <a href="index.php">erneut</a>.';
    echo '<head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="stylesheets/exp.css" />
                <title>Einräumen einer simulierten Küche</title>
            </head>
            <body>
                <div style="width: 900px; margin: 0 auto;">
                <img src="img/logo_web.png" id="logo">
                <br><br>
                <p id="expstart"><b>Der Versuch wurde nicht ordnungsgemäß ausgeführt, oder es ist ein Fehler aufgetreten.</b><br><br>
                Bitte beginne den Versuch <a href="index.php">erneut</a>.</p><br><br>
                <hr>
                <span class="footer">Alisa Volkert, M.Sc., Medieninformatik (Arbeitsbereich Mensch-Computer Interaktion & Künstliche Intelligenz)</span>
                <span class="footer2"><a href="impressum.php">Impressum</a> | <a href="datenschutzerklaerung.php">Datenschutz</a></span>
              </div>
            </body>';
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
//        setcookie("userID", $userid, time() + 7200);

        unset($_SESSION["dtkenntn"], $_SESSION["vollj"]);
        $_SESSION["userDataSaved"] = 'saved';
//        unset();
//            echo "saved";
//        }
    } else {
//        die("Errormessage: ". $db->saveUserData($dk,$vj));
        $_SESSION["userDataSaved"] = 'not saved';
        echo '$_SESSION["userDataSaved"]: ' . $_SESSION["userDataSaved"];
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

  </script>

  </head>

  <body >
    <h1>K&uuml;chensimulation</h1>

    <p>Bitte mach folgende Angaben: </p>
    <div class="all">
      <form id="kontaktformular" name="kontaktformular" action="mykitchen.php" method="post">
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
                    Alter:
                </td>
                <td class="abstand">
                    <input type="number" min="18" max="100" name="age" id="age" required/>
                </td>
            </tr>
          <tr>
            <td>
				Geschlecht:
			</td>
            <td class="abstand">
              <select id="gender" name="gender" size="1" required>
                  <option value="" disabled selected>Wählen Sie eine Option</option>
                  <option>weiblich</option>
                  <option>männlich</option>
                  <option>divers</option>
              </select>
          </tr>

		  
		  <tr>
            <td>
				K&ouml;rpergr&ouml;&szlig;e (cm):
			</td>
            <td class="abstand">
				<input type="number" min="0" max="250" name="bodyheight" id="bodyheight" required/>
			</td>
          </tr>

<!--           TO-DO: korrekt in csv speichern -->
            <tr>
                <td>
                    Wohnst du mit Kindern zusammen
                </td>
                <td class="abstand">
                    <label><input type="radio" name="withKids" id="withKidsYes" value="1" required> ja </label><br />
                    <label><input type="radio" name="withKids" id="withKidsNo" value="0"> nein </label><br />
                </td>
            </tr>

          <tr>
            <td>
				Welcher Kultur fühlst du dich am ehesten verbunden:
			</td>
            <td class="abstand">
				<label><input type="radio" name="nat" id="nat_de" value="deutsch" required> deutsch</label> <br />
				<label><input type="radio" name="nat" id="nat_fr" value="französisch"> französisch</label> <br />
				<label><input type="radio" name="nat" id="nat_other" value=""> Sonstiges:</label> <input type="text" name="nationality" id="nationality" oninput="updateInput()"/>
			</td>
          </tr>
		  <script>
              function updateInput() {
                  document.getElementById("nat_other").value = document.getElementById("nationality").value;
              }

          </script>
<!--		  <tr>-->
<!--            <td>-->
<!--				Beschäftigung:-->
<!--			</td>-->
<!--            <td class="abstand">-->
<!--				<input type="text" id="job" name="job"/><br />-->
<!--				<input type="checkbox" name="job_full" id="job_full"> Vollzeit </input><br />-->
<!--				<input type="checkbox" name="job_part" id="job_part"> Teilzeit </input>-->
<!--			</td>-->
<!--          </tr>-->
		  
<!--          <tr>-->
<!--            <td>Wie viele Stunden haben Sie an dem letzten Werktag in <br />der K&uuml;che verbracht?</td>-->
<!--            <td class="abstand"><input type="number" min="0" id="hours1" name="hours1"/></td>-->
<!--          </tr>-->
          <tr>
            <td>Wie viele Stunden hast du nach eigener Einsch&aumltzung <br />vergangene Woche in deiner K&uuml;che zu Hause gearbeitet?</td>
            <td class="abstand"><input type="number" min="0" id="hoursKitchen" name="hoursKitchen" required/></td>
          </tr>
            <tr>
                <td>Wie viele Stunden arbeitest du pro Woche in deinem Beruf?</td>
                <td class="abstand"><input type="number" min="0" max="150" id="hoursWork" name="hoursWork" required/></td>
            </tr>
          <tr>
            <td></td>
            <td class="abstand"><input id="but" type="submit" value="Zur K&uuml;chensimulation" required/></td>
          </tr>
        </table>
      </form>
<span class="footer2"><a href="impressum.php">Impressum</a> | <a href="datenschutzerklaerung.php">Datenschutz</a></span>
    </div>

	</body>

</html>
