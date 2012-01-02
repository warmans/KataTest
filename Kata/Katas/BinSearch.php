<?php
namespace Kata\Katas;

class BinSearch extends \Kata\Core\KataAbstract {
	
	protected function setUp(){
		$this->setTestSuite(new \Kata\Tests\BinSearch);
	}
	
	/**
	* @enabled: true
	*/
	public function binSearchRecursive($haystack, $needle, $startPos=NULL, $endPos=NULL){		
				
		if(!count($haystack)){
			return FALSE;
		}
				
		$startPos = ($startPos === NULL) ? 0 : $startPos;
		$endPos = ($endPos === NULL) ? count($haystack) : $endPos;
		$midPoint = floor(($startPos + $endPos)/2);
					
		if($haystack[$midPoint] === $needle){
			return $midPoint;
		} else {
			if($midPoint == $startPos || $midPoint == $endPos){
				return FALSE;
			}
			
			if($haystack[$midPoint] < $needle){
				return $this->binSearchRecursive($haystack, $needle, $midPoint, $endPos);
			} else {
				return $this->binSearchRecursive($haystack, $needle, $startPos, $midPoint);
			}
		}
	}
	
	/**
	* @enabled: true
	*/
	public function binSearchIterative($haystack, $needle){
		$l = 0; 
		$r = count($haystack);

		while($l < $r)
		{
			if($needle == $haystack[$i = ($r + $l) >> 1])
				return $i;

			if($haystack[$i] > $needle) $r = $i; else $l = $i + 1;
		}

		return false;
	}
}