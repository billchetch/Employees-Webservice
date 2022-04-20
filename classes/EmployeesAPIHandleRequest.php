<?php
use chetch\api\APIException as APIException;

class EmployeesAPIHandleRequest extends chetch\api\APIHandleRequest{
	
	
	protected function addResourePaths(&$resourcePaths, $resourcePathBase, $resourceType, $resourceDirectory, $resourceID){
		switch($resourceDirectory){
			case 'profile-pics':
				//resourceID should be employeeID
				$emp = Employee::createFromEmployeeID($resourceID);
				if($emp && $emp->getEmployeeID()){
					array_push($resourcePaths, $resourcePathBase.$emp->getEmployeeID());
					array_push($resourcePaths, $resourcePathBase.$emp->getKnownAs());
					array_push($resourcePaths, $resourcePathBase.str_replace(' ', '_', $emp->getFullName()));
					array_push($resourcePaths, $resourcePathBase.'anonymous');
				}
				break;
		}
	}

	protected function processGetRequest($request, $params){
		$data = array();
		$requestParts = explode('/', $request);
		switch($requestParts[0]){
			case 'test':
				$data = array('response'=>"Employees test Yeah baby");
				break;
				
			case 'test-error':
				throw new Exception("Testing error");
				break;

			case 'about':
				$data = static::about();
				$data['number_test'] = 10;
				break;

			case 'active-employees':
			case 'employees':
				$filter = $request == 'active-employees' ? 'active=1' : '';
				if(isset($params['position_id']) && $params['position_id'] > 0){
					$filter.= ($filter ? ' AND ' : '').'position_id=:position_id'; //.$params['position_id'];
				}
				$data = Employee::createCollectionAsRows($params, $filter, "known_as");
				break;

			case 'resource':
				$this->processGetResourceRequest($request, $params);
				break;

			default:
				print_r($requestParts); die;
				break;
			
		}
		return $data;
	}

	protected function processPutRequest($request, $params, $payload){
		$data = array();
		$requestParts = explode('/', $request);
		
		switch($requestParts[0]){
			case 'employee':
				$emp = Employee::createInstance($payload);
				$emp->write(true);
				$data = $emp->getRowData();
				break;
		}

		return $data;
	}

	protected function processDeleteRequest($request, $params){
		$data = array();
		$requestParts = explode('/', $request);
		
		switch($requestParts[0]){
			case 'employee':
				$data = Employee::deleteByID($requestParts[1]);
				break;
		}

		return $data;
	}
}
?>