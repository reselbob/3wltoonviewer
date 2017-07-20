<?php

require_once('../serverlib/jsonizer.php');
$configs = include('../configs.php');
define("ROOT",dirname( dirname(__FILE__) )."/");
error_reporting(E_ALL);


$nextindex = 0;
$http_method =  $_SERVER['REQUEST_METHOD'];
$image_id = null;
if(isset($_GET["id"]))$image_id = $_GET["id"];

if($http_method != 'GET'){
    http_response_code(405);
    echo $http_method. " not supported";
    exit;
}


$pageSize = $configs['pageSize'];
$showall = false;


if(isset($_GET['showall'])){$showall=$_GET['showall'];}
if(isset($_GET['nextindex'])){$nextindex=$_GET['nextindex'];}

$jsonizer = new Jsonizer();
session_start();

/*
if(!isset($_SESSION["photos"])){
    $_SESSION["photos"] = $jsonizer->getFilesAsArray(ROOT .$configs['imagesDir']);
}
$photos = $_SESSION["photos"];
*/

$photos = $jsonizer->getFilesAsArray(ROOT .$configs['imagesDir']);

$found = $jsonizer->putSelectedImageOnTop($photos,$image_id);
$photoData = $found;

if(!$showall){
    $photoData = array_slice($found, $nextindex, $pageSize);
}

header('Content-Type: application/json');
echo json_encode($photoData, JSON_UNESCAPED_SLASHES);
?>