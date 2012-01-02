<?php
	namespace Kata;
	
	DEFINE('APPLICATION_PATH', realpath(dirname(__FILE__)));
			
	require_once('Kata/Core/Loader.php');
		
	$className = (!empty($argv[1])) ? $argv[1] : NULL;
	$methodName = (!empty($argv[2])) ? $argv[2] : NULL;
				
	$runner = new Core\Runner();
	$runner->test($className, $methodName);