<?php

class Employee extends \chetch\db\DBObject{
	
	public static function initialise(){
		$t = \chetch\Config::get('EMPLOYEES_TABLE', 'employees');
		self::setConfig('TABLE_NAME', $t);
		
		$sql = "SELECT *, ";
		$sql.= "IF(last_name IS NULL, first_name, CONCAT(first_name, ' ', last_name)) AS full_name, ";
		$sql.= "IF(aka IS NULL, first_name, aka) AS known_as ";
		$sql.= "FROM $t";
		self::setConfig('SELECT_SQL', $sql);
		
		self::setConfig('SELECT_ROW_FILTER',  "employee_id=:employee_id");
	}
	
	public static function createFromEmployeeID($eid){
		return parent::createInstance(array('employee_id'=>$eid));
	}

	public function __construct($rowdata){
		parent::__construct($rowdata);
	}

	public function getEmployeeID(){
		return $this->get('employee_id');
	}

	public function getKnownAs(){
		return $this->get('known_as');
	}

	public function getFullName(){
		return $this->get('full_name');
	}

	public function getFirstName(){
		return $this->get('first_name');
	}
}