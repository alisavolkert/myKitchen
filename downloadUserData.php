<?php require('typeprotect.php'); ?>
<!DOCTYPE html>
<html>

<head>

    <title>User Data - mykitchen</title>
    <meta charset="utf-8">

</head>

<body>
<br>


<?php

$files1 = scandir('userdaten',SCANDIR_SORT_NONE);

foreach($files1 as &$file)
{
    if (!is_dir($file))
    {
        $file =  'userdaten/' . $file;
    }
}
$datum = date("Y_m_d");
$path = 'userdaten/user-data_'.$datum.'.zip';
$zip = new ZipArchive();
if (file_exists($path)) {
    $zip->open($path, ZipArchive::OVERWRITE);
} else {
    $zip->open($path, ZipArchive::CREATE);
}

$zip->open($path, ZipArchive::CREATE);
foreach($files1 as $file)
{
    if (!is_dir($file) && file_exists($file))
    {
        $zip->addFile($file);
    }
}
$zip->close();
echo "Archive for User Data created successfully. <a href='",$path,"' rel='nofollow'>click to download</a>";


?>
<br>
<br>

<a href="typeprotect.php?signout=1">Sign Out</a>

</body>

</html>
