<?php
namespace Kata\Core;

class Test {
	
	private $name;
	private $args;
	private $expectedResult;
	private $assertion;
	
	public function __construct($name, $expectedResult, $args, $assertion='equal'){
		$this->name = $name;
		$this->expectedResult = $expectedResult;
		$this->args = $args;
		$this->assertion = $assertion;
	}
	
	public function getArgs(){
		if(!is_array($this->args)){
			throw new Exception("arguments must be an array");
		}
		return $this->args;
	}
	
	public function getExpectedResult(){
		return $this->expectedResult;
	}
	
	public function checkResult($result){
		switch($this->assertion):
			case "equals":
				return ($result == $this->expectedResult);
			default:
				throw new Exception("Unknown assertion: $this->assertion");
		endswitch;
	}
	
	public function getName(){
		return $this->name;
	}
	
	public static function build($name, $expectedResult, $args, $assertion='equals'){
		return new Test($name, $expectedResult, $args, $assertion);
	}
}