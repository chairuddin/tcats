<?php

/*Tell the browser that we want to display an image*/
 header('Content-Type: image/jpeg');


/*Create a new ZIP archive object*/
    $zip = new ZipArchive;

    /*Open the received archive file*/
    if (true === $zip->open($_GET['filename'])) {


/*Get the content of the specified index of ZIP archive*/
 echo $zip->getFromIndex($_GET['index']);
 }

 $zip->close();
?>
