<?php
require_once('../serverlib/jsonizer.php');
$configs = include('../configs.php');
define("ROOT", __DIR__ ."/");
error_reporting(E_ALL);
$jsonizer = new Jsonizer();

$curDir =  dirname( __FILE__, 2 );

$photos = $jsonizer->getFilesAsArray($curDir ."/" . $configs['imagesDir']);


echo realpath(__DIR__ . DIRECTORY_SEPARATOR . '..');

?>