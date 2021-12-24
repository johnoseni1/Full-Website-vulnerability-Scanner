<?php

class InputField{

	private $id;
	private $name;
	private $idOfForm;
	private $nameOfForm;
	private $value;
	private $type;
	private $formNum;
	
	/*public function __construct(){
		$this->id = '';
		$this->name = '';
		$this->idOfForm = '';
		$this->nameOfForm = '';
		$this->value = '';	
	}*/
	
	public function __construct($id, $name, $idOfForm, $nameOfForm, $value, $type, $formNum){
		$this->id = $id;
		$this->name = $name;
		$this->idOfForm = $idOfForm;
		$this->nameOfForm = $nameOfForm;
		$this->value = $value;	
		$this->type = $type;
		$this->formNum = $formNum;
	}
	
	public function setId($id){
		$this->id = $id;
	}
	
	public function setName($name){
		$this->name = $name;
	}
	
	public function setIdOfForm($idOfForm){
		$this->idOfForm = $idOfForm;
	}
	
	public function setNameOfForm($nameOfForm){
		$this->nameOfForm = $nameOfForm;
	}
	
	public function setValue($value){
		$this->value = $value;
	}
	
	public function setType($type){
		$this->type = $type;
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
	
	public function getIdOfForm(){
		return $this->idOfForm;
	}
	
	public function getNameOfForm(){
		return $this->nameOfForm;
	}
	
	public function getValue(){
		return $this->value;
	}
	
	public function getType(){
		return $this->type;
	}
	
	public function getFormNum(){
		return $this->formNum;
	}
}
?>