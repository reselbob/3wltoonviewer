<?php
require_once('../serverlib/jsonizer.php');
$configs = include('../configs.php');
define("ROOT", __DIR__ ."/");
error_reporting(E_ALL);
$jsonizer = new Jsonizer();

class JsonizerTest extends PHPUnit_Framework_TestCase
{
}
