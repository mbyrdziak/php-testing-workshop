<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Workshop\Numerals;

/**
 * Description of PrimeFactorsTest
 *
 * @author epol
 */
class PrimeFactorsTest extends \PHPUnit_Framework_TestCase  {
    /**
     * @dataProvider generateProvider
     */
    public function testGenerate($a , $b){
        $prime = new PrimeFactors();
        $result = $prime->generate($a);
        $this->assertEquals($b, $result);
    }
    /**
     * @expectedException InvalidArgumentException
     */
    public function testException()
    {
        $prime = new PrimeFactors();
        $result = $prime->generate(0);     
    }
    public function generateProvider(){
         return array(
            array(56,array(2,2,2,7)),
            array(280,array(2,2,2,5,7))
           
        );
    }
    //put your code here
}
