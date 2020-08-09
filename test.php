<?php
require_once('_include.php');

use chetch\Config as Config;
use chetch\Utils as Utils;
use chetch\api\APIMakeRequest as APIMakeRequest;

try{
	$lf = "\n";
	$row = array();
	$row['last_name'] = "Thorgerson R B";
	$emp = Employee::createInstance($row);
	print_r($emp->getRowData());


	//var_dump($data);
} catch (Exception $e){
	echo "EXCEPTION: ".$e->getMessage();
}
?>