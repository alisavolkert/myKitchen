# Copyright 2019 University of Tuebingen

# Landing page
# Experiment ProKRep Küchensimulation
# authors: Jannis Strecker
# supervised by: Alisa Volkert
<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheets/exp.css" />
    <link rel="stylesheet" href="stylesheets/cookie.css" />
    <title>Studie Einräumen einer simulierten Küche</title>
  </head>
  <body>   
    <img src="img/logo_web.png" id="logo"> 
  	<p id="expstart"><b>Vielen Dank</b> für dein Interesse an unserer Studie!</p>
    <br>
<!--    <p><b>Die Studie ist beendet.</b></p>-->


    <p>Bitte lies die Informationen auf den nächsten Seite sorgfältig durch und entscheide dich dann,
        ob du an dieser Studie teilnehmen möchtest. Falls du weitere Fragen zur Studie haben solltest, beantworten wir dir diese gern.</p>
    <br>
    Ansprechpartnerin: <br>
    Alisa Volkert, M.Sc.<br>
    E-Mail: <span class="mailadr">alisa.volkert (@) uni-tuebingen.de</span><br>

    <br>
    <button id="weiter">WEITER</button>
<!--    <b><a href="exp3.php">WEITER</a></b>-->
    <br>
    <br>

  	<hr>
  	<span class="footer">Alisa Volkert, M.Sc., Medieninformatik (Arbeitsbereich Mensch-Computer Interaktion & Künstliche Intelligenz)</span>
    <span class="footer2"><a href="impressum.php">Impressum</a> | <a href="datenschutzerklaerung.php">Datenschutz</a></span>

    <div id="myModalAlert" class="modal">
        <div style="width: 300px;height: 225px;">
            Der Versuch kann nur durchgeführt werden, wenn du Cookies akzeptierst.<br>
            Es werden keinerlei Tracking-Cookies oder Analytic-Cookies eingesetzt.<br><br>
            Die eingesetzten Cookies gewährleisten lediglich, dass die Versuchsergebnisse korrekt gespeichert werden können.<br><br>
            <button id="closeAlert">Ok, verstanden.</button>
        </div>
    </div>
<?php require 'cookieFooter.php'?>
  <script>

      // Internet Explorer 6-11
      let isIE = /*@cc_on!@*/false || !!document.documentMode;

      if(isIE) {
          alert('Bitte nutze einen anderen Browser um das Experiment durchzuführen! \n' +
              'z.B. Google Chrome, Mozilla Firefox oder Safari');
      }

      document.addEventListener('DOMContentLoaded', function() {
          document.getElementById('weiter').addEventListener('click',function () {
              if(!getCookie('cookiesAccepted')) {
                  document.getElementById('myModalAlert').style.visibility = 'visible';
                  setTimeout(function() {
                      document.getElementById('myModalAlert').style.display = 'block';
                  }, 300);
              } else {
                  window.location = "./exp3.php";
              }
          });
          document.getElementById('closeAlert').addEventListener('click',function () {
              document.getElementById('myModalAlert').style.visibility = 'hidden';
              setTimeout(function() {
                  document.getElementById('myModalAlert').style.display = 'none';
              }, 300);

          });


      }, false);

  </script>
  </body>

</html>
