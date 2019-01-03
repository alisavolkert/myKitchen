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
		<link rel="stylesheet" type="text/css" href="stylesheets/style2.css">
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	</head>

	<body>
		<h1>Versuchsablauf</h1> <br/>
		<h3>Titel der Studie: Psychologisch inspirierte Wissensrepräsentation</h3> <br/>
		<p>Im folgenden Versuch finden Sie mehrere Kisten mit verschiedenen Küchengegenständen
vor. Ihre Aufgabe wird es sein, diese in die gegebenen Regale einzuordnen (siehe Abbildung).
Sie dürfen dabei auch Gegenstände auf den Arbeitsflächen abstellen. Räumen Sie die Küche
so ein, wie Sie es auch bei Ihnen zu Hause tun würden: Es gibt dabei kein Richtig oder
Falsch. Gern dürfen Sie während des Versuchs Gegenstände umplatzieren.
Der Versuch ist beendet, sobald alle Gegenstände in der Küche platziert wurden. Es gibt kein
Zeitlimit. Außerdem muss nicht jedes Regal gefüllt werden.
		</p>
		<p>Abbildung: Mögliche Bereiche innerhalb der Küche zum Einräumen der Gegenstände <br />
		<img src="img/versuch.jpg" />
		</p>
		<p>Wenn Sie alles gelesen haben, melden Sie sich bitte beim Versuchsleiter. Da während des
Versuchs keine Fragen beantwortet werden können, sollten Sie diese jetzt stellen. Eventuelle
Fragen zum Hintergrund der Studie werden Ihnen gern nach dem Versuch beantwortet.</p>
<p> Vielen Dank für ihre Teilnahme!</p>
		
		<a href="formular.php"><button>Weiter</button></a>
	</body>

</html>
