<?php
$pr_proceso = $_GET[1];
$file = $_GET[2];

// echo $pr_proceso , $file;

// die();

$file_down = new ArchivoBajar;
$file_down->nombreArchivo($file);
$file_down->directorio( '../upload_files/' . $pr_proceso . '/' );



$file_down->bajar();



// die('--FIN--DEBUGEO----');            