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
		<h3>Einräumen einer simulierten Küche im Rahmen des Forschungsprojekts <br/>
            "Psychologisch inspirierte Wissensrepräsentation"</h3> <br/>
		<p>Du bist soeben in eine neue Wohnung eingezogen und stehst nun vor der Aufgabe, die noch leere Küche einzuräumen (siehe Abbildung). All deine Küchengegenstände befinden sich auf der rechten Seite des Browserfensters.
Du darfst dabei auch Gegenstände auf den Arbeitsflächen abstellen. Beim Einräumen deiner neuen Küche gibt es kein Richtig oder
            Falsch. Gern darfst du während des Versuchs Gegenstände umplatzieren. Räume ALLE Gegenstände aus dem Depot in die Küche. Du musst dabei aber nicht in jedes Regal etwas einräumen. </p>
        <p>Anschließend sollst du den Inhalt der gefüllten Fächer kurz beschreiben.
Der Versuch ist beendet, sobald du jedes gefüllte Fach kurz beschrieben hast.
            Er wird jedoch spätestens nach 90 Minuten abgebrochen. <!-- TODO: nach Pilottest Zeitlimit von 90 min ggf. anpassen.-->

		</p>
        <img src="img/versuch.jpg" />
		<p>Abbildung: Mögliche Bereiche innerhalb der Küche zum Einräumen der Gegenstände <br />
		</p>
		<p>Wenn du deine Aufgabe verstanden hast, klicke bitte auf "Weiter". </p>

		
		<a href="formular.php"><button>Weiter</button></a>
	</body>

</html>
