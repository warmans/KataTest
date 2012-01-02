<?php
namespace Kata\Core;

class TestSuite implements \Iterator {
	private $position = 0;	
	private $tests = array();	

	public function current() {
		return $this->tests[$this->position];
	}
	
	public function key(){
		return $this->position;
	}
	
	public function next(){
		++$this->position;
	}
	
	public function rewind(){
		$this->position = 0;
	}
	
	public function valid(){
		return isset($this->tests[$this->position]);
	}
	
	public function addTest(Test $test){
		$this->tests[] = $test;
	}
}