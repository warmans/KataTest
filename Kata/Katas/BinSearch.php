<?php
namespace Kata\Katas;

class BinSearch extends \Kata\Core\KataAbstract {
	
	protected function setUp(){
		$this->setTestSuite(new \Kata\Tests\BinSearch);
	}
	
	/**
	* Implements binary search using a recursive approach
	* 
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
	* Implements binary search iteratively using bitwise division
	*
	* @enabled: true
	*/
	public function binSearchIterativeBitwise($haystack, $needle){
		$left = 0; 
		$right = count($haystack);

		while($left < $right) {
				
			$midPoint = ($right + $left) >> 1;
						
			if($needle == $haystack[$midPoint]){
				return $midPoint;
			}

			if($haystack[$midPoint] > $needle){
				$right = $midPoint;
			} else {
				$left = $midPoint + 1;
			}
		}

		return false;
	}
	
	/**
	* Implements binary search iteratively using
	*
	* @enabled: true
	*/
	public function binSearchIterative($haystack, $needle){
		$left = 0; 
		$right = count($haystack);

		while($left < $right) {
				
			$midPoint = floor(($right + $left)/2);
						
			if($needle == $haystack[$midPoint]){
				return $midPoint;
			}

			if($haystack[$midPoint] > $needle){
				$right = $midPoint;
			} else {
				$left = $midPoint + 1;
			}
		}

		return false;
	}
}