<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  session_start();

//  $servername = "localhost";
//  $user = 'prokrep';
//  $pass = 'ShRdLu1968';
//  $dbname = "prokrepdb";

  // Check if ID is set, otherwise something went wrong:
 /* if (!isset($_SESSION["vollj"], $_SESSION['dtkenntn']))
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
  }*/

  // Create connection
//  $conn = new mysqli($servername, $user, $pass, $dbname);
  // Check connection
//  if ($conn->connect_error) {
//      die("Connection failed: " . $conn->connect_error);
//  }

  // Insert user data
//  $sql = "INSERT INTO participants (email)
//          VALUES ('$email')";
//
//  if ($conn->query($sql) === TRUE) {
//      $last_id = $conn->insert_id;
//  } else {
//      echo "Error: " . $sql . "<br>" . $conn->error;
//  }

//  $conn->close();

//  session_destroy();


if(isset($_REQUEST["demogr"],$_REQUEST["dtkenntn"],$_REQUEST["vollj"])):
    $_SESSION['vollj'] = $_REQUEST["vollj"];
    $_SESSION['dtkenntn'] = $_REQUEST["dtkenntn"];
    header('Location: versuchsanleitung.php', true, 303);
/*else:
        echo 'Der Versuch wurde nicht ordnungsgemäß ausgeführt, oder es ist ein Fehler aufgetreten. Bitte beginnen Sie den Versuch <a href="index.php">erneut</a>.';
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
        die();*/
endif;

?>
<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheets/exp.css" />
    <title>Einräumen einer simulierten Küche</title>
  </head>
  <body>
    
  	<p>Der Versuch dauert ungefähr 30-45 Minuten. Eine genaue Anleitung findest du auf der nächsten Seite.</p>

  	<p>Um den Versuch durchzuführen, muss die Auflösung deines Bildschirms mindestens 1200x700 Pixel betragen. </p>


    <p>Wer das Experiment gewissenhaft durchgeführt hat, kann an einer Verlosung von 10 Gutscheinen à 20 Euro für den Tübinger Einzelhandel teilnehmen. Dies ist nur einmal möglich.
       Alternativ können wir eine (halbe) Versuchspersonenstunde ausstellen.  </p> <!-- TODO: nach Pilottest entscheiden, ob halbe oder ganze VP-Stunde ausstellen.-->

    <p>Alle Angaben zu deiner Person werden anonym gespeichert, sodass kein Rückschluss auf deine Person möglich ist. Die Teilnahme an dieser Studie ist freiwillig. Wenn du nicht einwilligst, schließe bitte dieses Fenster in deinem Browser.
       Mit der Teilnahme an der Studie gehst du weder Risiken ein, noch profitierst du davon persönlich (mit der Ausnahme, für den Fall, dass du einen Einkaufsgutschein gewinnst oder eine Versuchspersonenstunde erhälst).</p>

    <form action="exp4.php#demographics" method="POST" id="demographics" class="hl">
        <h3>Teilnahmevoraussetzungen:</h3>
<!--        <span class="error">' . $errorstring . '</span>-->
        <input type="hidden" name="demogr" value="">
        <p>
            <input type="checkbox" name="dtkenntn" id="dtkenntn" value="1" required>
            <label for="dtkenntn">Deutsch ist meine Muttersprache</label>
        </p>
        <p>
            <input type="checkbox" name="vollj" id="vollj" value="1" required>
            <label for="vollj">Ich bin volljährig</label>
        </p>
        <button type="submit">Weiter</button>
    </form>
                                                                                   <!--    <p><a target="_blank" href="java.htm">So finden Sie heraus</a>, ob Sie Java installiert haben.</p>-->

<!--  	<span><i>Schritt-für-Schritt-Anleitung:</i></span> -->
<!--  	<ol>-->
  		<!--<li>Laden Sie das Java-Programm <a href="assets/kitchen.jar">“kitchen.jar”</a> herunter und speichern Sie es auf Ihrem Computer. </li>
  		<li>Starten Sie das Programm durch einen Doppelklick auf die Datei “kitchen.jar” (Windows und macOS<sup><a href="#macos">[1]</a></sup>) oder von der Kommandozeile (Linux und macOS<sup><a href="#macos">[1]</a></sup>) in dem Ordner, in dem Sie “kitchen.jar” gespeichert haben mit dem Befehl "java -jar kitchen.jar". </li>
  		<li>Füllen Sie den kurzen Umfragebogen zu Beginn des Versuchs aus und geben Sie folgende Teilnahmenummer <span class="tnnummer">-->
<?php
//      echo "<form action=''><h3><strong>$last_id</strong></h3></form>";
      
?>
     <!-- </span> ein.</li>
  		<li>Folgen Sie den Anleitungen, die Ihnen das Programm gibt, um den Versuch durchzuführen. </li>
  		<li>Zuletzt wird Sie das Programm fragen, wo die Zip­da­tei gespeichert werden soll. Wählen Sie einen geeigneten Ordner aus, um die Zip­da­tei zu speichern.</li>
  		<li>Versenden Sie die Zip­da­tei per Mail an <span class="mailadr">alisa.volkert (@) uni-tuebingen.de</span>. Verwenden Sie bitte als Betreff <b>&lt;Küchenobjekte: &lt;Ihre Teilnahmenummer&gt;&gt;</b>. Sofern Sie an der Verlosung der Einkaufsgutscheine teilnehmen möchten, teilen Sie uns dies bitte in Ihrer Mail mit.</li>-->


<!--  	</ol>-->

<!--    <a href="./versuchsanleitung.php"><button>Weiter</button></a>-->
  	<br><br>
    <hr>
<!--    <span id="macos"><sup>[1]</sup> Etwaige Sicherheitsabfrage bestätigen, dann in den Systemeinstellungen auf "Sicherheit" klicken. Dort auf App "Dennoch öffnen" klicken.<span><br><br>-->
  	<span class="footer">Alisa Volkert, M.Sc., Medieninformatik (Arbeitsbereich Mensch-Computer Interaktion & Künstliche Intelligenz)</span><br>
    <span class="footer2"><a href="impressum.php">Impressum</a> | <a href="datenschutzerklaerung.php">Datenschutz</a></span>
  </body>

</html>
<?php
  // $dbh = null;
?>
