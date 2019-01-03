<!DOCTYPE html>
<html>

<head>

    <title>mykitchen</title>
    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href="stylesheets/mykitchen.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"/>

    <script type="text/javascript" src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script type="text/javascript" src="js/mykitchen.js"></script>

</head>

<body>
<script type="text/javascript">
    var data = <?php echo json_encode($_POST) ?>;

    var beruf;


    var row = [data.nickname, data.anrede, data.age, data.nationality, data.hours1, data.hours2, beruf];


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
        <button id="back" style="font-size: 18px; width: 35px;"><</button>
        <button id="next" style="font-size: 18px; width: 35px;">></button>
        <button id="open">Open</button>
        <button id="close">Close</button>
        <button id="refresh">Restart</button>
        <button id="finish">Finish</button>
    </div>

    <div class="kitchen" id="gkitchen">
        <!--        <div class="door" id="d1">S1</div>  ondblclick="openDoor()"-->
        <!--        			<div class="door" id="d4">S4</div>-->
        <!--        			<div class="door" id="d2">S2</div>-->
        <!--        			<div class="door" id="d3">S3</div>-->
        <!--        			<div class="door" id="d5">S5</div> -->
        <div class="door" id="d1-1">S1-1</div>
        <div class="door" id="d1-2">S1-2</div>
        <div class="door" id="d2-1">S2-1</div>
        <div class="door" id="d2-2">S2-2</div>
        <div class="door" id="d3-1">S3-1</div>
        <div class="door" id="d3-2">S3-2</div>
        <div class="door" id="d4-1">S4-1</div>
        <div class="door" id="d4-2">S4-2</div>
        <div class="door" id="d5-1">S5-1</div>
        <div class="door" id="d5-2">S5-2</div>

        <div class="door" id="d6-1">S6-1</div>
        <div class="door" id="d6-2">S6-2</div>
        <div class="door" id="d6-3">S6-3</div>
        <div class="door" id="d6-4">S6-4</div>
        <div class="door" id="d6-5">S6-5</div>

        <div class="door" id="d7">S7</div>
        <div class="door" id="d8">S8</div>

        <div class="door" id="d9-1">S9-1</div>
        <div class="door" id="d9-2">S9-2</div>
        <div class="door" id="d9-3">S9-3</div>

        <div class="door" id="d10-1">S10-1</div>
        <div class="door" id="d10-2">S10-2</div>
        <div class="door" id="d10-3">S10-3</div>


        <div class="schrank" id="s1-1">
            <div class="regal" id="sv1-1"></div>
        </div>
        <div class="schrank" id="s1-2">
            <div class="regal" id="sv1-2"></div>
        </div>

        <div class="schrank" id="s2-1">
            <div class="regal" id="sv2-1"></div>
        </div>
        <div class="schrank" id="s2-2">
            <div class="regal" id="sv2-2"></div>
        </div>

        <div class="schrank" id="s3-1">
            <div class="regal" id="sv3-1"></div>
        </div>
        <div class="schrank" id="s3-2">
            <div class="regal" id="sv3-2"></div>
        </div>

        <div class="schrank" id="s4-1">
            <div class="regal" id="sv4-1"></div>
        </div>
        <div class="schrank" id="s4-2">
            <div class="regal" id="sv4-2"></div>
        </div>

        <div class="schrank" id="s5-1">
            <div class="regal" id="sv5-1"></div>
        </div>
        <div class="schrank" id="s5-2">
            <div class="regal" id="sv5-2"></div>
        </div>


        <div class="schrank" id="s6-1">
            <div class="regal" id="sv6-1"></div>
        </div>
        <div class="schrank" id="s6-2">
            <div class="regal" id="sv6-2"></div>
        </div>
        <div class="schrank" id="s6-3">
            <div class="regal" id="sv6-3"></div>
        </div>
        <div class="schrank" id="s6-4">
            <div class="regal" id="sv6-4"></div>
        </div>
        <div class="schrank" id="s6-5">
            <div class="regal" id="sv6-5"></div>
        </div>

        <div class="schrank" id="s7">
            <div class="regal" id="sv7"></div>
        </div>

        <div class="schrank" id="s8">
            <div class="regal" id="sv8"></div>
        </div>

        <div class="schrank" id="s9-1">
            <div class="regal" id="sv9-1"></div>
        </div>
        <div class="schrank" id="s9-2">
            <div class="regal" id="sv9-2"></div>
        </div>
        <div class="schrank" id="s9-3">
            <div class="regal" id="sv9-3"></div>
        </div>

        <div class="schrank" id="s10-1">
            <div class="regal" id="sv10-1"></div>
        </div>
        <div class="schrank" id="s10-2">
            <div class="regal" id="sv10-2"></div>
        </div>
        <div class="schrank" id="s10-3">
            <div class="regal" id="sv10-3"></div>
        </div>


        <div class="regal" id="obfl1">Obfl1</div>
        <div class="regal" id="obfl2">Obfl2</div>
        <div class="regal" id="obfl3">Obfl3</div>
        <div class="regal" id="obfl4">Obfl4</div>
        <div class="regal" id="obfl5">Obfl5</div>
    </div>

    <div id="obj" class="regal">
        <?php
        //mb_internal_encoding('UTF-8');
        function setOffset($height, $width, $depth){
            $height = round(number_format($height));
            $width = round(number_format($width));
            $depth = round(number_format($depth));

            $result = "min-height:".$height."px;"."min-width:".$width."px;"."perspective:".$depth."px;";

            return $result;
        }

        function nicknameToFile($str){
            $replace_array = array(
                '-' => '_',
                ' ' => '_',
                ':' => '_',
                '.' => '_',
                ';' => '_',
                'Ä' => 'Ae',
                'Ö' => 'Oe',
                'Ü' => 'Ue',
                'ä' => 'ae',
                'ö' => 'oe',
                'ü' => 'ue',
                'ß' => 'ss');
            $result = strtr($str,$replace_array);
            return $result;
        }

        require('connect.php');

        # SQL-Statements
        $select_elem_mk = $db->query('SELECT name, picture, width, height, depth FROM mykitchen2')->fetchAll();

//        print_r($select_elem_mk);
//        $result_mk = $db->query('SELECT * FROM mykitchen2 ORDER BY RAND()');

        $stmt = $db->query('SELECT * FROM mykitchen2 ORDER BY RAND()');
        $stmt->execute();
        $result_mk  = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $js_array_mk = array();

        if (count($result_mk) > 0) {
//            echo "Datenbanktabelle ist nicht leer";
//    print_r($result_mk);
//            while($row = $result_mk->fetch()) {
            foreach ($result_mk as $row) {
                $image = $row['picture'];
                if ($image === 0) {
                    $image = "default.jpeg";
                }
                $offset = setOffset($row['height'], $row['width'], $row['depth']);

                echo '<img class="objekte" id="'.$row['id'].'" src="150px_Bilder/'.$image.'" alt="'.$row['name'].'" style="'.$offset.'"/>';

//                echo "<img class=\"objekte\" id=\"".$row[0]."\" src=\"150px_Bilder/".$image."\" alt=\"".utf8_encode($row['name'])."\" style=\"".$offset."\"/>";

//                echo "img set";
                $js_array_mk[] = array($row['id'], $row['name'], $row['picture'], $row['height'], $row['width'], $row['depth']);
            }
        } else {
            echo "Datenbanktabelle ist leer";
        }
//        print_r($result_mk);

        # create writable directory if not exists
        $dir = "userdaten/";
        if (!file_exists($dir)){
            $oldmask = umask(0); // for linux Server
            mkdir($dir, 0755);
        }

        $datum = date("d_m_Y");

        # add new row(array) in csv-file
        if (isset($_POST["arr1"])) {
            $arr = $_POST["arr1"];
            $arr2 = $_POST["arr2"];
            $arr3 = $_POST["arr3"];

            if (count($arr) > 7) {
                $a1 = array_shift($arr);
                $results = $dir.'userdata.csv';
                chmod($results, 0755);
                $userscore = fopen($results, 'a');
                if (trim(file_get_contents($results)) == false) {
                    $first = array('Nickname','Anrede','Alter','Nationalitaet','Stunden am Tag','Stunden in der Woche','Beruf','Startzeit','Endzeit','Gesamte Mouseclicks','Klicks auf Gegenstaende');
                    fputcsv($userscore, $first);
                }
                fputcsv($userscore, $arr);
                fclose($userscore);

                // if ($db_connection) {
                //   $db_connection->exec("INSERT INTO userscore (username, gender, age, nationality, hoursday, hourswheek, jobtitle, starttime, endtime, mouseclicks, clicksonobjects)
                //   VALUES ($arr[0],$arr[1],$arr[2],$arr[3], $arr[4],$arr[5],$arr[6],$arr[7],$arr[8],$arr[9],$arr[10])");
                // }
            }

            if (isset($_POST["arr2"])){
                $dir = $dir.nicknameToFile($arr[0]).'/';
                if (!file_exists($dir)){
                    $oldmask = umask(0); // for linux Server
                    mkdir($dir, 0755);
                }

                $fp = fopen($dir.nicknameToFile($arr[0]).'__'.$datum.'__'.nicknameToFile($arr[7]).'.csv', 'w');
                chmod($fp, 0755);
                fputcsv($fp, $arr3);

                $l = count($arr2);
                for ($i = 0; $i < $l; $i++) {
                    fputcsv($fp, $arr2[$i]);
                }

                fclose($fp);

                if ($l > 0){
                    $fpf = fopen($dir.nicknameToFile($arr[0]).'__'.$datum.'__'.nicknameToFile($arr[7]).'_finish.csv', 'w');
                    chmod($fpf, 0755);

                    $a1 = array_shift($arr3);
                    $al = array_pop($arr3);
                    fputcsv($fpf, $arr3);

                    if ($arr2[$l - 1][1] == "FINISH") {
                        $l--;
                    }

                    while ( $arr2[$l - 1][1] == "RESTART" && $l > 1){
                        $l--;
                    }
                    $a1 = array_shift($arr2[$l - 1]);
                    $al = array_pop($arr2[$l - 1]);
                    fputcsv($fpf, $arr2[$l - 1]);

                    fclose($fpf);
                }
            }
        }

        # save distance-table in folder "userdaten"
        if (isset($_POST["dist"])) {
            $dist = $_POST["dist"];
            $l = count($dist[0]);

            $df = fopen($dir.'distances_'.$datum.'.csv', 'w');
            chmod($fp, 0755);

            for ($i = 0; $i < $l; $i++) {
                fputcsv($df, $dist[$i]);
            }

            fclose($df);
        }
        ?>
    </div>

    <script type="text/javascript">
        <?php
        echo "var daten = ", json_encode($js_array_mk), ";";
        ?>
    </script>

    <div class="resultate-kueche">
        <ul class="resultate-list"></ul>
    </div>
    <div id="test"></div>
    <div id="test2"></div>
</div>

</body>

</html>
