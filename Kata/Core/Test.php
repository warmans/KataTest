<?php
namespace Kata\Core;

class Test {
	
	private $_name;
	private $_expectedResult;
	private $_args;
	private $_assertion;
	
	public function __construct($name, $expectedResult, $args, $assertion='equal'){
		$this->_name = $name;
		$this->_expectedResult = $expectedResult;
		$this->_args = $args;
		$this->_assertion = $assertion;
	}
	
	public function getArgs(){
		if(!is_array($this->_args)){
			throw new Exception("arguments must be an array");
		}
		return $this->_args;
	}
	
	public function getExpectedResult(){
		return $this->_expectedResult;
	}
	
	public function checkResult($result){
		switch($this->_assertion):
			case "equals":
				return ($result == $this->_expectedResult);
			default:
				throw new Exception("Unknown assertion: $this->assertion");
		endswitch;
	}
	
	public function getName(){
		return $this->_name;
	}
	
	public static function build($name, $expectedResult, $args, $assertion='equals'){
		return new Test($name, $expectedResult, $args, $assertion);
	}
}