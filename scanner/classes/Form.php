<?php

class Form{

	private $id;
	private $name;
	private $method;
	private $action;
	private $formNum;

	/*public function __construct(){
		$this->id = '';
		$this->name = '';
		$this->method = '';
		$this->action = '';
	}*/
	
	public function __construct($id, $name, $method, $action, $formNum){
		$this->id = $id;
		$this->name = $name;
		$this->method = $method;
		$this->action = $action;
		$this->formNum = $formNum;
	}
	
	public function setId($id){
		$this->id = $id;
	}
	
	public function setName($name){
		$this->name = $name;
	}
	
	public function setMethod($method){
		$this->method = $method;
	}
	
	public function setAction($action){
		$this->action = $action;
	}
	
	public function setFormNum($formNum){
		$this->formNum = $formNum;
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function getName(){
		return $this->name;
	}
	
	public function getMethod(){
		return $this->method;
	}
	
	public function getAction(){
		return $this->action;
	}
	
	public function getFormNum(){
		return $this->formNum;
	}
	

	
}

?>