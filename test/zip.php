<?php
$zip = new ZipArchive;
$res = $zip->open('test.zip', ZipArchive::CREATE);
$zip->addFromString('test.txt', 'file content goes here');
//$zip->addFile('data.txt', 'entryname.txt');
$zip->close();
?>