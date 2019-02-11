<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["vollj"], $_SESSION['dtkenntn']))
{
    echo 'Der Versuch wurde nicht ordnungsgemäß ausgeführt, oder es ist ein Fehler aufgetreten. Bitte beginnen Sie den Versuch <a href="index.php">erneut</a>.';
    die();
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Einräumen einer simulierten Küche</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="stylesheets/style2.css">
<!--		<script type="text/javascript" src="https://code.jquery.com/jquery-1.10.2.js"></script>-->
<!--		<script type="text/javascript" src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>-->
	</head>

	<body>
		<h1>Versuchsablauf</h1> <br/>
		<h3>Titel der Studie: Einräumen einer simulierten Küche im Rahmen des Forschungsprojekts "Psychologisch inspirierte Wissensrepräsentation"</h3> <br/>
		<p>Sie sind soeben in eine neue Wohnung eingezogen, und stehen nun vor der Aufgabe, die noch leere Küche einzuräumen (siehe Abbildung). All Ihre Küchengegenstände befinden sich auf der rechten Seite des Browserfensters.
Sie dürfen dabei auch Gegenstände auf den Arbeitsflächen abstellen. Beim Einräumen Ihrer neuen Küche gibt es kein Richtig oder
Falsch. Gern dürfen Sie während des Versuchs Gegenstände umplatzieren.
Der Versuch ist beendet, sobald alle Gegenstände in der Küche platziert wurden. Der Versuch wird spätestens nach 90 Minuten abgebrochen. <!-- TODO: nach Pilottest Zeitlimit von 90 min ggf. anpassen.-->
            Außerdem muss nicht jedes Regal gefüllt werden.
		</p>
		<p>Abbildung: Mögliche Bereiche innerhalb der Küche zum Einräumen der Gegenstände <br />
		<img src="img/versuch.jpg" />
		</p>
		<p>Wenn Sie Ihre Aufgabe verstanden haben, klicken Sie bitte auf "Weiter". </p>

		
		<a href="formular.php"><button>Weiter</button></a>
	</body>

</html>
