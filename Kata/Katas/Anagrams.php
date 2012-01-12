<?php

namespace Kata\Katas;

/**
 * The objective of this kata is to take a seed word and find all anagrams and sub words within a word list.
 * 
 */
class Anagrams extends \Kata\Core\KataAbstract {

    protected function _setUp() {
	        
        $testSuite = new \Kata\Core\TestSuite;
        
        $testSuite->addTest(\Kata\Core\Test::build("t.ammo",
            array(
                'a', 'am', 'm', 'ma', 'mamo', 'mao', 'mo', 'o', 'oam', 'om'), 
            array('ammo'))
        );
        
        $testSuite->addTest(\Kata\Core\Test::build("t.mamo",
            array(
                'a', 'am', 'ammo', 'm', 'ma', 'mao', 'mo', 'o', 'oam', 'om'), 
            array('mamo'))
        );
        
        $testSuite->addTest(\Kata\Core\Test::build("t.ab",
            array('a', 'b', 'ba'), 
            array('ab'))
        );
                
        $this->setTestSuite($testSuite);	
        parent::_setUp();
		
    }

    public function lineByLine($anagramSeed) {
        
        $fileinfo = new \SplFileInfo(RESOURCE.'wordlist.txt');
        $file = $fileinfo->openFile('r');
        
        $matchedWords = array();

        //filter any words longer than the requested word, any possible words convert to array. Don't store seed word.
        foreach($file as $line):
            
            //kill whitespace
            $line = trim($line);
            
            //word is empty or too long or the the seed - skip
            if(strlen($line) == 0 || strlen($line) > strlen($anagramSeed) || $line == $anagramSeed){
                continue;
            }
        
            $word = str_split($line);           
            $matchedLetters = 0;
            $letterPool = str_split($anagramSeed);
            
            //compare all it's letters against the anagram seed
            foreach($word as $key=>$letter):
                
                $foundLetterKey = array_search($letter, $letterPool); 
                
                if($foundLetterKey !== FALSE){
                    //once a letter has been used remove it from the possible letters to prevent matches re-using letters
                    unset($letterPool[$foundLetterKey]);
                    //note how many letters have been matched in this word
                    $matchedLetters++;
                }
            endforeach;
            
            //all letters of the current word matched the anagram seed  - this is an anagram or sub-word
            if($matchedLetters == count($word)){
                $matchedWords[] = implode("", $word);
            }
        endforeach;     
        
        return $matchedWords;
    }
		
}