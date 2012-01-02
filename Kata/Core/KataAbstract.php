<?php 
namespace Kata\Core;

abstract class KataAbstract {
	
	private $testSuite;
	
	public function __construct(){
		$this->setUp();
	}
	
	protected function setUp(){
		return TRUE;
	}
	
	public function setTestSuite(TestSuite $testSuite){
		$this->testSuite = $testSuite;
	}
	
	public function getTestSuite(){
		return $this->testSuite;
	}
	
}