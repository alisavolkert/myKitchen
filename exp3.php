<?php

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  session_start();




// Check if email is set, otherwise something went wrong:
//if (isset($_SESSION["email"]))
//{
//    $email = $_SESSION["email"];
//} else {
//    echo 'Der Versuch wurde nicht ordnungsgemäß ausgeführt, oder es ist ein Fehler aufgetreten. Bitte beginnen Sie den Versuch <a href="index.php">erneut</a>.';
//    die();
//}

/*function form_is_correct()
{
    global $errorstring;
    $errorstring = "";

    if(!isset($_REQUEST["dtkenntn"]))
    {
      $errorstring.= "Um am Versuch teilnehmen zu können, muss Ihre Muttersprache Deutsch sein. Sollte dies nicht der Fall sein, schließen Sie bitte jetzt das Fenster. Vielen Dank.<br>";
        return FALSE;
    } else {
        $_SESSION['dtkenntn'] = $_REQUEST["dtkenntn"];
    }
    if(!isset($_REQUEST["vollj"]))
    {
        $errorstring.= "Um am Versuch teilnehmen zu können, muss Sie volljährig sein. Sollte dies nicht der Fall sein, schließen Sie bitte jetzt das Fenster. Vielen Dank.<br>";
        return FALSE;
    } else {
        $_SESSION['vollj'] = $_REQUEST["vollj"];
    }





//    if ($errorstring=="")
      return TRUE;
//    else
//      return FALSE;
}*/

/*function get_form($errorstring = "")
{
      $form = '*/
?>
        <!DOCTYPE html>
        <html lang="de">
          <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="exp.css" />
            <link rel="stylesheet" href="stylesheets/exp.css" />
            <title>Einräumen einer simulierten Küche</title>
          </head>
          <body>
            <p>Bitte führe dieses Experiment nur am PC oder Laptop durch.</p>

            <p>Deine Aufgabe ist, an einem einfachen Experiment teilzunehmen, in welchem du Bilder, die verschiedene Küchengegenstände zeigen, in eine simulierte Küche einräumen sollst. Anschließend sollst du den Inhalt jedes gefüllten Fachs kurz beschreiben. Der Screenshot unten zeigt die simulierte Küche.
               </p>
                <img src="./img/Kitchen_Simulation.png" width="900" alt="Screenshot der Küchensimulation">
            
            <!-- <img width="1093" height="600" src="img/CatScan_Main-Trial_web.png" alt="Software-Screenshot Abbildung Küchengegenstände"> -->
            <p style="float:right;display: block;margin: 0;"><small>Fotos: Vanessa Bernath</small></p> 
            <div style="clear:both;"></div>

            <a href="./exp4.php"><button>Weiter</button></a>
            <hr>
            <span class="footer">Alisa Volkert, M.Sc., Medieninformatik (Arbeitsbereich Mensch-Computer Interaktion & Künstliche Intelligenz)</span>
            <span class="footer2"><a href="impressum.php">Impressum</a> | <a href="datenschutzerklaerung.php">Datenschutz</a></span>
          </body>

        </html>
      <!--';
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
-->
