<?php
/*
 * Function: Extract Zip to $target destination.
 * src: https://stackoverflow.com/questions/2314285/server-to-server-retrieve-and-extract-a-remote-zip-file-to-local-server-direct
*/
function openZip($file_to_open, $target, $debug = false) {
    $file = ABSPATH . '/tmp/'.md5($file_to_open).'.zip';
    $client = curl_init($file_to_open);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);  //fixed this line
    $fileData = curl_exec($client);
    file_put_contents($file, $fileData);
    $zip = new ZipArchive();
    $x = $zip->open($file);
    if($x === true) {
        $zip->extractTo($target);
        $zip->close();
        unlink($file);
        return true;
    } else {
        if($debug !== true) {
            unlink($file);
        }
        return false;
        //die("There was a problem. Please try again!");

    }
}
