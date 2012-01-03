<?php 
namespace Kata\Core;

abstract class KataAbstract {
	
	private $_testSuite;
	
	protected function _setUp(){
		return TRUE;
	}
	
	/**
	* @enabled: false
	*/
	public function __construct(){
		$this->_setUp();
	}
		
	/**
	* @enabled: false
	*/
	public function setTestSuite(TestSuite $testSuite){
		$this->_testSuite = $testSuite;
	}
	
	/**
	* @enabled: false
	*/
	public function getTestSuite(){
		return $this->_testSuite;
	}
	
}