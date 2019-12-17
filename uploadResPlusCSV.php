<?php

error_reporting(E_ALL & ~E_NOTICE);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
ini_set('display_errors', '1');

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



# create writable directory if not exists
$dir = "userdaten/";
if (!file_exists($dir)){
    $oldmask = umask(0); // for linux Server
    mkdir($dir, 0775);
}

$datum = date("d_m_Y");



# add new row(array) in csv-file
if (isset($_POST['arr1'])) {
//echo "post:";
//print_r($_POST);

    if (isset($_POST["arr5"])){

        $res = $_POST["arr5"];
        $res = json_decode($res,true);
        echo "<br>\n";
        print_r($res);
        echo "<br>\n";

        //    $userId = $res[0];
        //    $shelf = $res[1];
        //    $timestamp = $res[2];
        //    $itemId = $res[3];
        //    $isLast = $res[4];
        foreach ($res as list($userId, $shelf, $timestamp, $itemId, $isLast) ) {
//            list($userId, $shelf, $timestamp, $itemId, $isLast) = $r;
            if($db->saveObjects($userId, $shelf, $timestamp, $itemId, $isLast)) {
                echo "this saved";
            }
            echo $userId . "; " . $shelf. "; " . $timestamp. "; " . $itemId . "; " . $isLast;
        }
        echo "resultsForDB saved";

    } else {
        echo "arr1 is: " . isset($_POST["arr1"]);
        echo " arr5 is: " . isset($_POST["arr5"]);
        echo " resultsForDB not set ";
    }
    // $userid = $db->query("SELECT userid FROM participants WHERE completed = 0 ORDER BY userid DESC LIMIT 1")->fetch();
    // $stmt->execute();
    // $stmt->bind_result($uid);
    // $userid=0;
    // while ($stmt->fetch()) {
    //     $userid= $uid;
    // }

    // $stmt->close();

    // $stmt = $db->query("UPDATE participants SET completed= 1 WHERE userid =:userid");
    //$stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
    //$stmt->execute();
    //$stmt->close();


    $arr = $_POST["arr1"];
    $arr2 = $_POST["arr2"];
    $arr3 = $_POST["arr3"];
    $arr4 = $_POST["arr4"];

    $userid= 00000000;
    if(isset($_SESSION['user_id'])) {
        $userid = $_SESSION['user_id'];
    }
    if(isset($_COOKIE['userID'])) {
        $userid = $_COOKIE['userID'];
    }


    if (count($arr) > 7) {



//        $arr32 = $arr3;
//        $t = array_shift($arr32);
//        $arr42 = $arr4;
//        $t2 = array_shift($arr42);
        $cl = count($arr4);
        for ($i = 0; $i < $cl; $i++) {
            if($db->saveReasons($userid, $arr3[$i], $arr4[$i])) {
                echo 'saved reasons';
            } else {
                echo 'not saved reasons';
            }
        }
//        foreach($arr4 as $index => $r) {
//            if($db->saveReasons($userid, $arr3[$index], $r)) {
//                echo 'saved reasons';
//            }
//        }

        $a1 = array_shift($arr);
        array_unshift($arr, $userid);

        list($userId, $age, $gender, $height, $with_children, $nationality,
            $hours_kitchen, $hours_job, $starttime, $endtime, $time_difference,
            $mouseclicks, $clicksonobjects) = $arr;
//        $db->set_charset("utf8");

        if($db->saveRestData($userId, $age, $gender, $height, $with_children, $nationality,
            $hours_kitchen, $hours_job, $starttime, $endtime, $time_difference,
            $mouseclicks, $clicksonobjects)) {
            echo "saved rest data";
        } else {
            echo "no rest data saved";
        }

        $results = $dir.'userdata.csv';
        chmod($results, 0755);
        $userscore = fopen($results, 'a');
        if (trim(file_get_contents($results)) === false) {
//                    $first = array('Anrede','Alter','Nationalitaet','Stunden am Tag','Stunden in der Woche','Beruf','Startzeit','Endzeit', 'Zeitdifferenz', 'Gesamte Mouseclicks','Klicks auf Gegenstaende');
            $first = array('UserID','Alter','Geschlecht', 'Groesse', 'Mit Kindern', 'Nationalitaet','Stunden in der Kueche','Stunden im Beruf','Startzeit','Endzeit', 'Zeitdifferenz', 'Gesamte Mouseclicks','Klicks auf Gegenstaende');
            fputcsv($userscore, $first);
        }

        fputcsv($userscore, $arr);
        fclose($userscore);
        //chown($userscore, 'strecker');
        //chgrp($userscore, 'WSIstud');
        // if ($db_connection) {
        //   $db_connection->exec("INSERT INTO userscore (gender, age, nationality, hoursday, hourswheek, jobtitle, starttime, endtime, mouseclicks, clicksonobjects)
        //   VALUES ($arr[0],$arr[1],$arr[2],$arr[3], $arr[4],$arr[5],$arr[6],$arr[7],$arr[8],$arr[9])");
        // }
    }

    if (isset($_POST["arr2"])){
        $dir = $dir.$userid.'/';

        if (!file_exists($dir) && !mkdir($dir, 0755) && !is_dir($dir)){
            $oldmask = umask(0); // for linux Server
            mkdir($dir, 0755);
        }


        $fp = fopen($dir.$userid.'__'.$datum.'__'.nicknameToFile($arr[6]).'.csv', 'w');
        chmod($fp, 0775);
        chgrp($fp, 'pkweb');
        fputcsv($fp, $arr3);

        $l = count($arr2);
        for ($i = 0; $i < $l; $i++) {
            fputcsv($fp, $arr2[$i]);
        }

        fclose($fp);

        $fpr = fopen($dir.$userid.'__'.$datum.'__'.nicknameToFile($arr[6]).'_reasons.csv', 'w');
        chmod($fpr, 0775);
        chgrp($fpr, 'pkweb');
        fputcsv($fpr, $arr3);
        fputcsv($fpr, $arr4);

//                $l = count($arr4);
//                for ($i = 0; $i < $l; $i++) {
//                    fputcsv($fpr, $arr4[$i]);
//                }

        fclose($fpr);

        if ($l > 0){
            $fpf = fopen($dir.$userid.'__'.$datum.'__'.nicknameToFile($arr[6]).'_finish.csv', 'w');
            chmod($fpf, 0775);
            chgrp($fp, 'pkweb');
            $a1 = array_shift($arr3);
            $al = array_pop($arr3);
            fputcsv($fpf, $arr3);

            if ($arr2[$l - 1][1] === "FINISH") {
                $l--;
            }

            while ( $arr2[$l - 1][1] === "RESTART" && $l > 1){
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
    chmod($fp, 0775);

    for ($i = 0; $i < $l; $i++) {
        fputcsv($df, $dist[$i]);
    }

    fclose($df);
}


