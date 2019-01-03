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

    if(!isset($_REQUEST["dtkenntn"]))
    {
      $errorstring.= "Um am Versuch teilnehmen zu können, muss Ihre Muttersprache Deutsch sein. Sollte dies nicht der Fall sein, schließen Sie bitte jetzt das Fenster. Vielen Dank.<br>";
    }
    if(!isset($_REQUEST["vollj"]))
    {
        $errorstring.= "Um am Versuch teilnehmen zu können, muss Sie volljährig sein. Sollte dies nicht der Fall sein, schließen Sie bitte jetzt das Fenster. Vielen Dank.<br>";
    }
    if ($errorstring=="")
      return TRUE;
    else
      return FALSE;
}

function get_form($errorstring = "")
{
      $form = '
        <!DOCTYPE html>
        <html lang="de">
          <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="exp.css" />
            <link rel="stylesheet" href="stylesheets/exp.css" />
            <title>Studie Gruppierung von Küchengegenständen</title>
          </head>
          <body>
            <p>Bitte führen Sie dieses Experiment nur am PC oder Laptop durch.</p>

            <p>Ihre Aufgabe ist, an einem einfachen Experiment teilzunehmen, in welchem Sie Bilder, die verschiedene Küchengegenstände zeigen, in Gruppen sortieren sollen. Anschließend sollen Sie jede Gruppe kurz beschreiben. Um an dieser Studie teilnehmen zu können, müssen Sie ein kleines Java-Programm herunterladen und auf Ihrem Computer ausführen. Der Screenshot unten zeigt das Programm.</p>

            
            <img width="1093" height="600" src="img/CatScan_Main-Trial_web.png" alt="Software-Screenshot Abbildung Küchengegenstände">
            <p><small>Fotos: Vanessa Bernath</small></p>
            
            <form action="exp3.php#demographics" method="POST" id="demographics" class="hl">
                <h3>Teilnahmevoraussetzung: Deutsch als Muttersprache</h3> 
                <span class="error">' . $errorstring . '</span>
                <input type="hidden" name="demogr" value="">
                <p>
                  <input type="checkbox" name="dtkenntn" id="dtkenntn" required>
                  <label for="dtkenntn">Deutsch ist meine Muttersprache</label>
                </p>
                <p>
                  <input type="checkbox" name="vollj" id="vollj" required>
                  <label for="dtkenntn">Ich bin volljährig</label>
                </p>
                <button type="submit">Weiter</button>
            </form>
            
            <hr>
            <span class="footer">Alisa Volkert, M.Sc., Medieninformatik (Arbeitsbereich Mensch-Computer Interaktion & Künstliche Intelligenz)</span>
          </body>

        </html>
      ';
      return $form;
}


if(!isset($_REQUEST["demogr"]))
  echo get_form();
else
{
  if(form_is_correct()) {
    
    // Give me the next page  
    redirect("exp4.php");

  } else {
    
    echo get_form($errorstring);

  }

}

    


?>