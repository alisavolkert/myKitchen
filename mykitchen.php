<?php
error_reporting(E_ALL & ~E_NOTICE);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
ini_set('display_errors', '1');
date_default_timezone_set('Europe/Berlin');
header('Content-type: text/html; charset=utf-8');

require_once('./db/database.php');
$db = new Database();

?>

<!DOCTYPE html>
<html>

<head>

    <title>mykitchen</title>
    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href="stylesheets/mykitchen.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"/>

<!--    <script type="text/javascript" src="https://code.jquery.com/jquery-1.10.2.js"></script>-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
    <script type="text/javascript" src="js/html2canvas.min.js"></script>
    <script type="text/javascript" src="js/mykitchen.js"></script>
<!--    <script type="text/javascript" src="js/multiselect.js"></script>-->

</head>

<body>
<script type="text/javascript">
    var data = <?php echo json_encode($_POST, JSON_UNESCAPED_UNICODE) ?>;

    // var beruf;


    // var row = [data.nickname, data.anrede, data.age, data.nationality, data.hours1, data.hours2, beruf];

    var row = [data.age, data.gender, data.bodyheight, data.withKids,  data.nat, data.hoursKitchen, data.hoursWork];


    // lupe
    /*
    $(document).ready(function() {
      $('.objekte')
      .mouseover(function() {
        $('#lupe').css({'background-image': 'url('+ $(this).attr('src') +')', 'left' : ($(this).offset().left - 100)+'px', 'top' : ($(this).offset().top - 170)+'px', 'display':(($(this).parent().attr('id') === 'obj')? 'none' : 'block')});
      })
      .mouseout(function() {
        $( '#lupe' ).css({'display': 'none', 'background-image': 'url()'});
      });
    });
    */
</script>

<noscript>Your browser does not support JavaScript!</noscript>

<h3 class="hidden">Vielen Dank f&uuml;r Ihre Teilnahme! ;) </h3>

<div class="all">
    <div id="lupe"></div>
    <div class="but">
<!--        <button id="back" class="small" style="font-size: 18px; width: 35px;" disabled><</button>-->
<!--        <button id="next" class="small" style="font-size: 18px; width: 35px;" disabled>></button>-->
        <button id="help" class="small" style="font-size: 18px; width: 35px;">?</button>
        <button id="open"  class="big">Alle öffnen</button>
        <button id="close" class="big">Alle schließen</button>
        <button id="refresh" class="big">Neustart</button>
        <button id="finish" class="big" disabled>Weiter</button>
    </div>



    <div class="kitchen" id="gkitchen">

        <div id="info">
            <button class="closeAnzeige" id="close-hilfe">
                <h4>X</h4>
            </button>
            <!--<h4>Hilfe</h4>
            Im folgenden Versuch finden Sie mehrere Kisten mit verschiedenen Küchengegenständen vor.
            Ihre Aufgabe wird es sein, diese in die gegebenen Regale einzuordnen (siehe Abbildung).
            Sie dürfen dabei auch Gegenstände auf den Arbeitsflächen abstellen.
            Räumen Sie die Küche so ein, wie Sie es auch bei Ihnen zu Hause tun würden: Es gibt dabei kein Richtig oder Falsch.
            Gern dürfen Sie während des Versuchs Gegenstände umplatzieren.
            Der Versuch ist beendet, sobald alle Gegenstände in der Küche platziert wurden. Es gibt kein Zeitlimit.
            Außerdem muss nicht jedes Regal gefüllt werden.
            <br><br>
            Abbildung: Mögliche Bereiche innerhalb der Küche zum Einräumen der Gegenstände
            <div id="info-bild"></div>-->

            <h2>Versuchsablauf</h2>
            <h4>Einräumen einer simulierten Küche im Rahmen des Forschungsprojekts <br/>
                "Psychologisch inspirierte Wissensrepräsentation"</h4>
            <p>Du bist soeben in eine neue Wohnung eingezogen und stehst nun vor der Aufgabe, die noch leere Küche einzuräumen (siehe Abbildung). All deine Küchengegenstände befinden sich auf der rechten Seite des Browserfensters.
                Du darfst dabei auch Gegenstände auf den Arbeitsflächen abstellen. Beim Einräumen deiner neuen Küche gibt es kein Richtig oder
                Falsch. Gern darfst du während des Versuchs Gegenstände umplatzieren. Räume ALLE Gegenstände aus dem Depot in die Küche. Du musst dabei aber nicht in jedes Regal etwas einräumen. </p>
            <p>Anschließend sollst du den Inhalt der gefüllten Fächer kurz beschreiben.
                Der Versuch ist beendet, sobald du jedes gefüllte Fach kurz beschrieben hast.
                Er wird jedoch spätestens nach 60 Minuten abgebrochen.
            </p>

            <div id="info-bild"></div>
            Abbildung: Mögliche Bereiche innerhalb der Küche zum Einräumen der Gegenstände
        </div>
        <div id="test2">
            <div class="testUpAndDown">
                <button id="testUp"><h4>↑</h4></button><br>
                <button id="testDown"><h4>↓</h4></button>
            </div>
            <button class="closeAnzeige" id="close-anzeige">
                <h4>X</h4>
            </button>
        </div>
      <!--  S1
        S2
        S3
        S4
        S5-->
<!--        <div class="door" id="d1"></div>  ondblclick="openDoor()"-->
        <div class="door opendoorrightClosed" id="d2"></div>
        <div class="door opendoorrightClosed" id="d3"></div>
        <div class="door" id="d4"></div>
        <div class="door opendoorrightClosed" id="d5"></div>
        <!--S1-1
        S1-2
        S2-1
        S2-2
        S3-1
        S3-2
        S4-1
        S4-2
        S5-1
        S5-2-->
<!--        <div class="door" id="d1-1"></div>-->
<!--        <div class="door" id="d1-2"></div>-->

<!--        <div class="door" id="d2-1"></div>-->
<!--        <div class="door" id="d2-2"></div>-->
<!---->
<!--        <div class="door" id="d3-1"></div>-->
<!--        <div class="door" id="d3-2"></div>-->
<!---->
<!--        <div class="door" id="d4-1"></div>-->
<!--        <div class="door" id="d4-2"></div>-->
<!---->
<!--        <div class="door" id="d5-1"></div>-->
<!--        <div class="door" id="d5-2"></div>-->

        <!--S6-1-->
        <!--S6-2-->
        <!--S6-3-->
        <!--S6-4-->
        <!--S6-5-->
        <div class="door" id="d6-1"></div>
        <div class="door" id="d6-2"></div>
        <div class="door" id="d6-3"></div>
        <div class="door" id="d6-4"></div>
        <div class="door" id="d6-5"></div>

        <div id="gray"></div>
        <!--S7-->
        <!--S8-->
        <div class="door" id="d7"></div>
        <div id="gray2"></div>
        <div class="door opendoordownClosed" id="d8"></div>
        <!--S9-1-->
        <!--S9-2-->
        <!--S9-3-->
        <div class="door" id="d9-1"></div>
        <div class="door" id="d9-2"></div>
        <div class="door" id="d9-3"></div>
        <!--S10-1-->
        <!--S10-2-->
        <!--S10-3-->
        <div class="door" id="d10-1"></div>
        <div class="door" id="d10-2"></div>
        <div class="door" id="d10-3"></div>


        <div class="schrank" id="s1">
            <div class="regal regalSort oben" id="sv1-1"></div>
            <div class="regal regalSort oben" id="sv1-2"></div>
        </div>
        <!--<div class="schrank" id="s1-2">
            <div class="regal oben" id="sv1-2"></div>
        </div>-->

        <div class="schrank" id="s2">
            <div class="regal oben" id="sv2-1"></div>
            <div class="regal oben" id="sv2-2"></div>
        </div>
<!--        <div class="schrank" id="s2-2">-->
<!--            <div class="regal oben" id="sv2-2"></div>-->
<!--        </div>-->

        <div class="schrank" id="s3">
            <div class="regal oben" id="sv3-1"></div>
            <div class="regal oben" id="sv3-2"></div>
        </div>
<!--        <div class="schrank" id="s3-2">
            <div class="regal oben" id="sv3-2"></div>
        </div>-->

        <div class="schrank" id="s4">
            <div class="regal oben" id="sv4-1"></div>
            <div class="regal oben" id="sv4-2"></div>
        </div>
        <!--<div class="schrank" id="s4-2">
            <div class="regal oben" id="sv4-2"></div>
        </div>-->

        <div class="schrank" id="s5">
            <div class="regal oben" id="sv5-1"></div>
            <div class="regal oben" id="sv5-2"></div>
        </div>
       <!-- <div class="schrank" id="s5-2">
            <div class="regal oben" id="sv5-2"></div>
        </div>-->


        <div class="schrank" id="s6-1">
            <div class="regal unten" id="sv6-1"></div>
        </div>
        <div class="schrank" id="s6-2">
            <div class="regal unten" id="sv6-2"></div>
        </div>
        <div class="schrank" id="s6-3">
            <div class="regal unten" id="sv6-3"></div>
        </div>
        <div class="schrank" id="s6-4">
            <div class="regal unten" id="sv6-4"></div>
        </div>
        <div class="schrank" id="s6-5">
            <div class="regal unten" id="sv6-5"></div>
        </div>

        <div class="schrank" id="s7">
            <div class="regal unten" id="sv7"></div>
        </div>

        <div class="schrank" id="s8">
            <div class="regal unten" id="sv8"></div>
        </div>

        <div class="schrank" id="s9-1">
            <div class="regal unten" id="sv9-1"></div>
        </div>
        <div class="schrank" id="s9-2">
            <div class="regal unten" id="sv9-2"></div>
        </div>
        <div class="schrank" id="s9-3">
            <div class="regal unten" id="sv9-3"></div>
        </div>

        <div class="schrank" id="s10-1">
            <div class="regal unten" id="sv10-1"></div>
        </div>
        <div class="schrank" id="s10-2">
            <div class="regal unten" id="sv10-2"></div>
        </div>
        <div class="schrank" id="s10-3">
            <div class="regal unten" id="sv10-3"></div>
        </div>

        <!--Obfl1-->
        <!--Obfl2-->
        <!--Obfl3-->
        <!--Obfl4-->
        <!--Obfl5-->
        <div class="regal regalSort unten obfl" id="obfl1"></div>
        <div class="regal regalSort unten obfl" id="obfl2"></div>
        <div class="regal regalSort unten obfl" id="obfl3"></div>
        <div class="regal regalSort unten obfl" id="obfl4"></div>
        <div class="regal regalSort oben obfl" id="obfl5"></div>

        <div id="flaecheOben"></div>
        <div id="arbeitsflache"></div>
    </div>

    <div id="obj" class="regal regalSort">
        <div id="myModalObj" class="modal">
            <span class="close" id="close2">&times;</span>
            <img class="modal-content" id="img02">
<!--            <div id="caption2"></div>-->
        </div>
<?php
        //mb_internal_encoding('UTF-8');
        function setOffset($height, $width, $depth){
            $height = round(number_format($height));
            $width = round(number_format($width));
            $depth = round(number_format($depth));

            $result = "min-height:" .$height. "px; min-width:" .$width."px; perspective:".$depth."px;";

            return $result;
        }




        //require('connect.php');

        # SQL-Statements
        //$select_elem_mk = $db->query('SELECT name, picture, width, height, depth FROM mykitchen2')->fetchAll();

$select_elem_mk = $db->getAllImages();
$result_mk = $db->getAllImagesWithData();

        //print_r($select_elem_mk);
//        $result_mk = $db->query('SELECT * FROM mykitchen2 ORDER BY RAND()');

       // $stmt = $db->query('SELECT * FROM mykitchen2 ORDER BY RAND()');
        //$stmt->execute();
        //$result_mk  = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $js_array_mk = array();

        if (count($result_mk) > 0) {
//            echo "Datenbanktabelle ist nicht leer";
//              print_r($result_mk);
//            while($row = $result_mk->fetch()) {
           $i=0;
             foreach ($result_mk as $row) {
                 if ($i < 5) {
                     $image = $row['picture'];
                     if ($image === 0) {
                         $image = "default.jpeg";
                     }
                     $offset = setOffset($row['height'], $row['width'], $row['depth']);

                     echo '<img class="objekte" id="' . $row['id'] . '" src="150px_Bilder/' . $image . '" alt="' . $row['name'] . '" style="' . $offset . '"/>';

//                echo "<img class=\"objekte\" id=\"".$row[0]."\" src=\"150px_Bilder/".$image."\" alt=\"".utf8_encode($row['name'])."\" style=\"".$offset."\"/>";

//                echo "img set";
                     $js_array_mk[] = array($row['id'], $row['name'], $row['picture'], $row['height'], $row['width'], $row['depth']);
                 }
                $i++;
             }
        } else {
            echo "Datenbanktabelle ist leer";
        }
//        print_r($result_mk);

    require 'uploadResPlusCSV.php';


?>
       <!-- <div id="mehrereObjekte">
            <p>mehrere Objekte: SHIFT + Klick(s)</p>
        </div>-->
    </div>

    <script type="text/javascript">
        <?php
        echo "var daten = ", json_encode($js_array_mk), ";";
        echo 'var userid = '. json_encode($_COOKIE['userID']) . ';';
        ?>
    </script>

    <div class="resultate-kueche">
        <ul class="resultate-list"></ul>
    </div>
    <div id="test"></div>
<!--    <div id="test2">-->
<!--        <button class="closeAnzeige" id="close-anzeige">-->
<!--            <h4>X</h4>-->
<!--        </button>-->
<!--    </div>-->

    <div id="myModalKitchen" class="modal">
        <span class="close" id="close1">&times;</span>
        <img class="modal-content" id="img01">
<!--        <div id="caption1"></div>-->
    </div>

    <div id="myModalAlert" class="modal">
<!--        <span class="close" id="close3">&times;</span>-->
        <div>
            <p id="alertText"></p>
            <button id="closeAlert">Ok</button>
        </div>

<!--        <img class="modal-content" id="img01">-->
        <!--        <div id="caption1"></div>-->
    </div>


    <p id="foto-src"><small>Fotos: Vanessa Bernath</small></p>
</div>

</body>

</html>
