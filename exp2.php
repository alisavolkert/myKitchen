<?php

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  session_start();

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
      $errorstring.= "Bitte geben Sie eine gültige E-Mail-Adresse ein.<br>";
    }

    if(!isset($_REQUEST["agreement"]))
    {
      $errorstring.= "Ihre Einwilligung ist für die Teilnahme am Versuch erforderlich.<br>";
    }


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
            <h2>Einwilligungserklärung zur 
        Erhebung und Verarbeitung
        personenbezogener Daten für ein Gruppierungsexperiment 
        </h2>

            <h3>A. Gegenstand des Forschungsprojekts und Grundlage der Einwilligungserklärung</h3>
            <ol>

              <li> Forschungsprojekt: Experiment zur Gruppierung von Küchengegenständen</li>
              <li> Beschreibung des Forschungsprojekts: Bei diesem Forschungsprojekt handelt es sich um ein Experiment, bei dem Sie Gruppen von Küchengegenständen erstellen sollen. Ziel ist dabei, herauszufinden, welche Gegenstände jeweils in dieselbe Gruppe sortiert werden.
          Am Ende des Experiments erstellt das Programm, mit dem Sie das Experiment auf Ihrem Computer durchführen, eine Zip­da­tei. Diese Datei senden Sie bitte per Mail an alisa.volkert@uni-tuebingen.de.</li>
              <li> Durchführende Institution:<br>
          Universität Tübingen<br>
          Fachbereich Informatik<br>
          Medieninformatik (Mensch-Computer-Interaktion & Künstliche Intelligenz)<br>
          Sand 14<br>
          72076 Tübingen</li>

              <li>Projektleitung: Alisa Volkert, M.Sc.</li>
              <li>Datum des Experiments: vom 20.12.18 bis 7.1.2019 

              <li>Art der personenbezogenen Daten:
                <ul>
                    <li> E-Mail-Adresse,</li>
                    <li> Alter, </li>
                    <li> Geschlecht</li>
                    <li> ggf. Fach des Hochschulabschlusses</li>
                    <li> Muttersprache</li>
                    <li> Land des Wohnortes</li>
                    <li> Herkunftsland</li>
                    <li> eine laufende Teilnahmenummer</li>
                </ul>
              Aufnahmen, nämlich
                <ul>
                    <li>Anzahl der getätigten Klicks und</li>
                    <li>Dauer des Experiments</li>
                </ul>
              </li>
          </ol>
          <h3>B. Einwilligungserklärung und Information über die Erhebung personenbezogener Daten</h3>
          <ol>
            <li>Einwilligungserklärung<br><br>
              Hiermit willige ich ein, dass die im Rahmen des unter A. beschriebenen Forschungsprojekts erhobenen personenbezogenen Daten meiner Person, an
              <ul><li><b>Alisa Volkert (nachfolgend: „Projektleitung“)</b></li></ul>

              für die <b>Datenauswertung und Publikation</b> gemäß Ziff. 2 verarbeitet werden dürfen. Sofern ich besondere Kategorien von personenbezogenen Daten angebe bzw. angegeben habe, sind diese von der Einwilligungserklärung umfasst. <br><br>
              Ihre Einwilligung ist freiwillig. Sie können die Einwilligung ablehnen, ohne dass Ihnen dadurch irgendwelche Nachteile entstehen.
              Ihre Einwilligung können Sie jederzeit gegenüber der Projektleitung widerrufen, mit der Folge, dass die Verarbeitung Ihrer personenbezogenen Daten, nach Maßgabe Ihrer Widerrufserklärung, durch diesen für die Zukunft unzulässig wird. Dies berührt die Rechtmäßigkeit der aufgrund der Einwilligung bis zum Widerruf erfolgten Verarbeitung jedoch nicht.<br><br>
                
              Relevante Definitionen der verwendeten datenschutzrechtlichen Begriffe sind in der <a href="anlage.html" target="_blank">Anlage Begriffsbestimmungen</a> enthalten.
            </li>
            <li id="zweckdat">Zweck der Datenverarbeitung / Ziel des Projekts<br><br>
                Die Ergebnisse des von Ihnen durchgeführten Experiments werden in einer Zip­da­tei mit der Teilnahmenummer als Dateiname gespeichert. Diese Datei senden Sie per Mail an alisa.volkert@uni-tuebingen.de . Sobald wir Ihre Mail erhalten haben, speichern wir die Datei getrennt vom E-Mail-Programm. So ist eine Verknüpfung mit Ihrer E-Mail-Adresse nicht möglich. Nach dem Speichervorgang wird Ihre E-Mail unverzüglich gelöscht.
            </li>
            <li>Kontaktdaten der Datenschutzbeauftragten<br><br>
              Universität Tübingen<br>
              Datenschutzbeauftragter<br>
              Geschwister-Scholl-Platz<br>
              72074 Tübingen<br>
              datenschutz@uni-tuebingen.de<br>
              Tel. +49 7071 29 0
            </li>
            <li> Rechtsgrundlage <br><br>
            Die Projektleitung verarbeitet die von Ihnen erhobenen personenbezogene Daten auf Basis Ihrer Einwilligung gemäß Art. 6 Abs. 1 S. 1 lit. a DSGVO. Sofern besondere Kategorien personenbezogener Daten betroffen sind, verarbeitet die Projektleitung die von Ihnen erhobenen personenbezogenen Daten auf Basis Ihrer Einwilligung gemäß Art. 9 Abs. 2 lit. a DSGVO.
            </li>
            <li>Empfänger oder Kategorien von Empfängern / Drittstaatenübermittlung<br><br>

            An folgende Empfänger oder Kategorien von Empfängern werden Ihre personenbezogenen Daten durch die Projektleitung übermittelt oder können übermittelt werden, sofern Sie einen Gutschein gewinnen:<br>
            <ul>
              <li>Sekretariat Fachbereich Informatik der Universität Tübingen</li>
              <li>Universitätskasse der Universität Tübingen</li>
            </ul>
            </li>

            <li>Dauer, für die die personenbezogenen Daten gespeichert werden / Kriterien für die Festlegung der Dauer<br><br>
              s. 2. <a href="#zweckdat">Zweck der Datenverarbeitung / Ziel des Projekts</a>
            </li>
            
            <li>
              Ihre Rechte<br><br>
              <ul>
                    <li> Bestätigung, ob Sie betreffende personenbezogenen Daten durch  die Projektleitung verarbeitet werden,</li>
                    <li> Auskunft über diese Daten und die Umstände der Verarbeitung,</li>
                    <li> Berichtigung, soweit diese Daten unrichtig sind, </li>
                    <li> Löschung, soweit für die Verarbeitung keine Rechtfertigung und keine Pflicht zur Aufbewahrung (mehr) besteht,</li>
                    <li> Einschränkung der Verarbeitung in besonderen gesetzlich bestimmten Fällen und</li>
                    <li> Übermittlung Ihrer personenbezogenen Daten – soweit Sie diese bereitgestellt haben – an Sie oder einen Dritten in einem strukturierten, gängigen und maschinenlesbaren Format.</li>
              </ul>
            

            Darüber hinaus haben Sie das Recht, Ihre Einwilligung jederzeit gegenüber der Projektleitung zu widerrufen, mit der Folge, dass die Verarbeitung Ihrer personenbezogenen Daten, nach Maßgabe 
            Ihrer Widerrufserklärung, durch diesen für die Zukunft unzulässig wird. Dies berührt die Rechtmäßigkeit der aufgrund der Einwilligung bis zum Widerruf erfolgten Verarbeitung jedoch nicht. <br>
            Schließlich möchten wir Sie auf Ihr Beschwerderecht bei der Aufsichtsbehörde<br><br>
            Landesbeauftragter für Datenschutz und Informationsfreiheit Baden-Württemberg<br>
            Königstr. 10<br>
            70173 Stuttgart<br><br>
            hinweisen.<br>
            </li>
            <li>Keine automatisierte Entscheidungsfindung (inklusive Profiling)<br><br>
              Eine Verarbeitung Ihrer personenbezogenen Daten zum Zweck einer automatisierten Entscheidungsfindung (einschließlich Profiling) gemäß Art. 22 Abs. 1 und Abs. 4 DSGVO findet nicht statt.


                <form action="exp2.php#personaldata" method="POST" id="personaldata" class="hl">
                      <h3>Einwilligung zur Erklärung zur Erhebung und Verarbeitung personenbezogener Daten</h3>
                      <p>Zur Verknüpfung Ihrer Entscheidung mit Ihrer Person benötigen wir Ihre Mailadresse.</p>
                      <span class="error">' . $errorstring . '</span>
                      <p>
                        <label for="email" >Mailadresse:</label>
                        <input type="email" name="email" id="email" size="50" maxlength="100" value="' . $email . '" required>
                        
                      </p>
                      <p>
                        <input type="checkbox" name="agreement" id="agreement">
                        <label for="agreement">Ich willige der Erklärung zur Erhebung und Verarbeitung meiner personenbezogenen Daten ein.</label>
                      </p>
                      
                      <button type="submit">Weiter</button>
                </form>

                <p>
                 Die Teilnahme an dieser Studie ist freiwillig. Wenn Sie nicht einwilligen, schließen Sie bitte dieses Fenster in Ihrem Browser.
                 Mit der Teilnahme an der Studie gehen Sie weder Risiken ein noch profitieren Sie davon persönlich (mit der Ausnahme, für den Fall, dass Sie einen Einkaufsgutschein gewinnen). Vielleicht möchten Sie eine Kopie dieser Informationen für Ihre Unterlagen oder spätere Verwendung erstellen.</p>
            </li>
            </ol>
            <p>
            
          	<hr>
          	<span class="footer">Alisa Volkert, M.Sc., Medieninformatik (Arbeitsbereich Mensch-Computer Interaktion & Künstliche Intelligenz)</span>

        </body>

      </html>
      ';
      return $form;
}


if(!isset($_REQUEST["email"]))
  echo get_form();
else
{
  if(form_is_correct()) {
    // Save mail to session
    
    // email
    $email = (isset($_REQUEST["email"])) ? stripslashes( strip_tags( trim( $_REQUEST["email"] ))) : "";
    $_SESSION["email"]=$email;

    // Give me the next page  
    redirect("exp3.php");

  } else {
    
    $email = (isset($_REQUEST["email"])) ? stripslashes( strip_tags( trim( $_REQUEST["email"] ))) : "";
    echo get_form($errorstring, $email);

  }

}

    


?>
