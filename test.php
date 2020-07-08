<?php
require_once('_include.php');

use chetch\Config as Config;
use chetch\Utils as Utils;
use chetch\api\APIMakeRequest as APIMakeRequest;

try{
	$lf = "\n";
	$payload = array();
	$payload["employee_id"] = "88200";
	$payload["first_name"] = "Billy";
	$payload["last_name"] = "Bob";
	$payload["position_id"] = 1;
	 
	//$req = APIMakeRequest::createPutRequest("http://127.0.0.1:8004/api", "employee", $payload);
	//$data = $req->request();

	$data = Employee::createFromEmployeeID("88102");

	var_dump($data);
} catch (Exception $e){
	echo "EXCEPTION: ".$e->getMessage();
}
?>