<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  session_start();

//  $servername = "localhost";
//  $user = 'prokrep';
//  $pass = 'ShRdLu1968';
//  $dbname = "prokrepdb";

  // Check if email is set, otherwise something went wrong:
  if (isset($_SESSION["email"]))
  {
    $email = $_SESSION["email"];
  } else {
    echo 'Der Versuch wurde nicht ordnungsgemäß ausgeführt, oder es ist ein Fehler aufgetreten. Bitte beginnen Sie den Versuch <a href="./index.php">erneut</a>.';
    die();
  }

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
?>
<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheets/exp.css" />
    <title>Studie Gruppierung von Küchengegenständen</title>
  </head>
  <body>
    
  	<p>Der Versuch dauert ungefähr 30-45 Minuten. Technische Voraussetzungen und eine genaue Anleitung finden Sie unten. Nachdem Sie den Versuch beendet haben, wird das Programm eine kleine Zip­da­tei erstellen, die Sie auf Ihrem Computer speichern müssten. Diese müssen Sie dann per Mail an unten stehende Adresse versenden, um den Versuch vollständig abzuschließen.</p>

  	<p>Wer das Experiment gewissenhaft durchgeführt hat, kann an einer Verlosung von 10 Gutscheinen à 20 Euro für den Tübinger Einzelhandel teilnehmen. Dies ist nur einmal möglich.</p>

    <p>Um den Versuch durchzuführen, muss die Auflösung Ihres Bildschirm mindestens 800x600 Pixel betragen und Java Runtime Environment (JRE) muss auf Ihrem Rechner installiert sein. Sofern Sie keine oder eine ältere Version (vor 1.6d) von Java auf Ihrem Computer installiert haben, installieren Sie bitte eine aktuelle Version (min. 1.6d). Diese finden Sie auf <a href="https://www.java.com/de/download/" target="_blank">Java</a> (min. 1.6d).</p>

    <p><a target="_blank" href="java.htm">So finden Sie heraus</a>, ob Sie Java installiert haben.</p>

  	<span><i>Schritt-für-Schritt-Anleitung:</i></span>
  	<ol>
  		<li>Laden Sie das Java-Programm <a href="assets/kitchen.jar">“kitchen.jar”</a> herunter und speichern Sie es auf Ihrem Computer. </li>
  		<li>Starten Sie das Programm durch einen Doppelklick auf die Datei “kitchen.jar” (Windows und macOS<sup><a href="#macos">[1]</a></sup>) oder von der Kommandozeile (Linux und macOS<sup><a href="#macos">[1]</a></sup>) in dem Ordner, in dem Sie “kitchen.jar” gespeichert haben mit dem Befehl "java -jar kitchen.jar". </li>
  		<li>Füllen Sie den kurzen Umfragebogen zu Beginn des Versuchs aus und geben Sie folgende Teilnahmenummer <span class="tnnummer">
<?php
//      echo "<form action=''><h3><strong>$last_id</strong></h3></form>";
      
?>
      </span> ein.</li>
  		<li>Folgen Sie den Anleitungen, die Ihnen das Programm gibt, um den Versuch durchzuführen. </li>
  		<li>Zuletzt wird Sie das Programm fragen, wo die Zip­da­tei gespeichert werden soll. Wählen Sie einen geeigneten Ordner aus, um die Zip­da­tei zu speichern.</li>
  		<li>Versenden Sie die Zip­da­tei per Mail an <span class="mailadr">alisa.volkert (@) uni-tuebingen.de</span>. Verwenden Sie bitte als Betreff <b>&lt;Küchenobjekte: &lt;Ihre Teilnahmenummer&gt;&gt;</b>. Sofern Sie an der Verlosung der Einkaufsgutscheine teilnehmen möchten, teilen Sie uns dies bitte in Ihrer Mail mit.</li>

      <li>Wenn Sie die Datei versendet haben, schließen Sie bitte das Fenster, um das Experiment zu beenden.</li>
  	</ol>

    <a href="./versuchsanleitung.php"><button>Weiter</button></a>
  	<br><br>
    <hr>
    <span id="macos"><sup>[1]</sup> Etwaige Sicherheitsabfrage bestätigen, dann in den Systemeinstellungen auf "Sicherheit" klicken. Dort auf App "Dennoch öffnen" klicken.<span><br><br>
  	<span class="footer">Alisa Volkert, M.Sc., Medieninformatik (Arbeitsbereich Mensch-Computer Interaktion & Künstliche Intelligenz)</span><br>
  </body>

</html>
<?php
  // $dbh = null;
?>