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

        var hours2 = form.hours2.value;
        if (isNaN(hours2) || hours2 == "" || Number(hours2) < 0) {
          alert("Bitte geben Sie an, wie viele Stunden die Woche Sie in der K&uuml;che verbringen");
          form.hours2.focus();
          return false;
        }

        return true;
      }

      // show joblist
      function showDiv(){
        var i = document.getElementById("beruf").selectedIndex;
        if (i == 22){
          $('#toggle').css('display', 'block');
          $('#but').css('margin-top', '15px');
        } else {
          $('#toggle').css('display', 'none');
          $('#but').css('margin-top', '-10px');
        }
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
            <td>Nickname:</td>
            <td class="abstand"><input type="text" name="nickname" id="name"/></td>
          </tr>
          <tr>
            <td>Anrede:</td>
            <td class="abstand">
              <select id="anrede" name="anrede" size="1">
                <option>Herr</option>
                <option>Frau</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>Alter:</td>
            <td class="abstand"><input type="text" name="age" id="age"/></td>
          </tr>
          <tr>
            <td>Nationalit&auml;t:</td>
            <td class="abstand"><input type="text" name="nationality" id="nationality"/></td>
          </tr>
          <tr>
            <td>Wie viele Stunden haben Sie an dem letzten Werktag in </br>der K&uuml;che verbracht?</td>
            <td class="abstand"><input type="text" id="hours1" name="hours1"/></td>
          </tr>
          <tr>
            <td>Wie viele Stunden die Woche verbringen Sie in der K&uuml;che?</td>
            <td class="abstand"><input type="text" id="hours2" name="hours2"/></td>
          </tr>
          <tr>
            <td>Berufskategorie:</td>
            <td class="abstand">
              <select id="beruf" name="beruf" size="1" onchange="showDiv()">
                <option>keine Angabe</option>
                <option>Student</option>
                <option>Sch&uuml;ler</option>
                <option>Hausfrau/-mann</option>
                <option>Ingenieure und technische Berufe</option>
                <option>Naturwissenschaften und Forschung</option>
                <option>IT</option>
                <option>&Auml;rzte</option>
                <option>Vertrieb und Verkauf</option>
                <option>Pflege, Therapie und Assistenz</option>
                <option>Marketing und Kommunikation</option>
                <option>Bildung und Soziales</option>
                <option>Finanzen</option>
                <option>&Ouml;ffentlicher Dienst</option>
                <option>Banken, Finanzdienstleister und Versicherungen</option>
                <option>Recht</option>
                <option>Einkauf, Materialwirtschaft und Logistik</option>
                <option>Design, Gestaltung und Architektur</option>
                <option>Personal</option>
                <option>Handwerk, Dienstleistung und Fertigung</option>
                <option>Administration und Sekretariat</option>
                <option>F&uuml;hrungskr&auml;fte</option>
                <option>Weitere Berufskategorie</option>
              </select>
            </td>
          </tr>
          <tr>
            <td></td>
            <td class="abstand"><input id="toggle" name="other" type="text"/></td>
          </tr>
          <tr>
            <td></td>
            <td class="abstand"><input id="but" type="submit" value="Zur K&uuml;chensimulation" /></td>
          </tr>
        </table>
      </form>
    </div>

	</body>

</html>
