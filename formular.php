<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["email"]))
{
    $email = $_SESSION["email"];
} else {
    echo 'Der Versuch wurde nicht ordnungsgemäß ausgeführt, oder es ist ein Fehler aufgetreten. Bitte beginnen Sie den Versuch <a href="./index.php">erneut</a>.';
    die();
}
?>

<!DOCTYPE html>
<html>

  <head>

    <title>myKitchen</title>
    <meta charset="utf-8">

	  <link rel="stylesheet" type="text/css" href="stylesheets/style.css">

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.js"></script>
  	<script type="text/javascript" src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script type="text/javascript">
      // Eingabefelder überprüfen
      function checkInput(form){
        // Name - kein leeres Feld
        if (form.name.value == "") {
          alert("Bitte geben Sie Ihren Nicknamen ein!");
          form.name.focus();
          return false;
        }

        // Ã„lter soll ein Zahl zwischen 0 und 100 sein
        var age = form.age.value;
        age = Number(age);
        if (isNaN(form.age.value) || age == 0) {
          alert("Bitte Ihr Alter eingeben!");
          form.age.focus();
          return false;
        }
		//alter
        if (age < 0 || age > 100) {
          alert("Sind Sie ernsthaft " + age + " Jahre alt?");
          form.age.focus();
          return false;
        }
		
        if (Number(form.hours1.value) < 0) {
          alert("Zahl soll positiv sein");
          form.hours1.focus();
          return false;
        }
		//wie lange Küche
        var hours2 = form.hours2.value;
        if (isNaN(hours2) || hours2 == "" || Number(hours2) < 0) {
          alert("Bitte geben Sie an, wie viele Stunden die Woche Sie in der K&uuml;che verbringen");
          form.hours2.focus();
          return false;
        }

        return true;
      }
  </script>

  </head>

  <body onload="document.kontaktformular.name.focus();">
    <h1>K&uuml;chensimulation</h1>

    <p>Bitte machen Sie folgende Angaben: </p>
    <div class="all">
      <form id="kontaktformular" name="kontaktformular" action="mykitchen.php" method="post" onsubmit="return checkInput(this)">
        <table>
          <tr>
            <td>
				Nickname:
			</td>
            <td class="abstand">
				<input type="text" name="nickname" id="name" required/>
			</td>
          </tr>
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
				Welcher Kultur fühlen Sie sich am ehesten verbunden:
			</td>
            <td class="abstand">
				<input type="checkbox" name="nat_de" id="nat_de"> deutsch </input><br />
				<input type="checkbox" name="nat_fr" id="nat_fr"> französisch </input><br />
				<input type="checkbox" name="nat_other" id="nat_other"> Sonstiges: <input type="text" name="nationality" id="nationality" /></input>
			</td>
          </tr>
		  
		  <tr>
            <td>
				Beschäftigung:
			</td>
            <td class="abstand">
				<input type="text" id="job" name="job"/><br />
				<input type="checkbox" name="job_full" id="job_full"> Vollzeit </input><br />
				<input type="checkbox" name="job_part" id="job_part"> Teilzeit </input>
			</td>
          </tr>
		  
          <tr>
            <td>Wie viele Stunden haben Sie an dem letzten Werktag in <br />der K&uuml;che verbracht?</td>
            <td class="abstand"><input type="number" min="0" id="hours1" name="hours1"/></td>
          </tr>
          <tr>
            <td>Wie viele Stunden haben Sie nach eigener Einsch&aumltzung <br />vergangene Woche in Ihrer K&uuml;che zu Hause gearbeitet?</td>
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
