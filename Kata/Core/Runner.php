<?php
namespace Kata\Core;

class Runner {

	public function test($className = NULL, $methodName = NULL){
		switch(TRUE):
			case (!$className && !$methodName):
				$this->_testAllClasses();
				break;
			case ($className && !$methodName):
				$this->_testClass($className);
				break;
			case ($className && $methodName):
				$kataInstance = $this->_getKataClassInstance($className);
				$this->_testMethod($kataInstance, $this->_getPublicClassMethod($kataInstance, $methodName));
				break;
			default:
				throw new Exception('You cannot test a method without specifying a class');
		endswitch;
			
		return TRUE;
	}
	
	private function _getKataClassInstance($className){
		$realClassName = "\Kata\\Katas\\".$className;
		return new $realClassName;
	}
	
	protected function _testAllClasses(){
		foreach($this->_getKataClasses() as $className => $fileInfo):
			$this->_testClass($className);
		endforeach;
	}
	
	private function _getKataClasses(){
		$kataClasses = array();
		$dirIterator = new \RecursiveDirectoryIterator(APPLICATION_PATH.'/Kata/Katas');		
		foreach(new \RecursiveIteratorIterator($dirIterator) as $filename=>$fileInfo):
			$kataClasses[basename($filename, '.php')] = $fileInfo;
		endforeach;
		return $kataClasses;
	}
	
	protected function _testClass($className){
		Log::log("Testing Class $className");
		return $this->_testAllMethods($this->_getKataClassInstance($className));
	}
	
	protected function _testAllMethods($kataInstance){
		foreach($this->_getPublicClassMethods($kataInstance) as $method):
			if($this->_getCommentTagValue($method->getDocComment(), '@enabled') != 'false'){
				$this->_testMethod($kataInstance, $method);
			}
		endforeach;				
	}
	
	private function _getPublicClassMethods($classInstance){
		$classInfo = new \ReflectionClass($classInstance);
		return $classInfo->getMethods(\ReflectionMethod::IS_PUBLIC);
	}
	
	private function _getPublicClassMethod($classInstance, $methodName){
		$classInfo = new \ReflectionClass($classInstance);
		return $classInfo->getMethod($methodName);
	}
	
	private function _getCommentTagValue($docComment, $tagName){
		$matches = array();
		preg_match('#'.$tagName.':(.*)(\r\n|\r|\n)#U', $docComment, $matches);
		if (isset($matches[1])){
			return trim($matches[1]);
		}
		return FALSE;
	}
	
	protected function _testMethod(\Kata\Core\KataAbstract $kataInstance, \ReflectionMethod $method){
		Log::log("Testing Method ".$method->getName());
		$mStartTime = microtime();
		foreach($kataInstance->getTestSuite() as $test):
			$tStartTime = microtime();
			$result = $method->invokeArgs($kataInstance, $test->getArgs());
			$tEndTime = microtime();
			Log::log($test->getName()." ".(($test->checkResult($result)) ? "passed" : "*failed*"));
		endforeach;
		$mEndTime = microtime();
		Log::log('Completed all tests in '.($mEndTime - $mStartTime).'ms');
	}
}