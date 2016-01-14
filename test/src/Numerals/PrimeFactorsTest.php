<?php

namespace Workshop\Numerals;

class PrimeFactorsTest extends \PHPUnit_Framework_TestCase {

    /**
     * @dataProvider PrimeProvider
     */
    public function testGenerate($a, $b) {
        $factors = new PrimeFactors();
        $result = $factors->generate($a);
        $this->assertEquals($b, $result, "Success");
    }
    /**
     * @expectedException InvalidArgumentException
     */
    public function testGenerateException(){
       $factors = new PrimeFactors();
       $factors->generate(0);
       //$this->assertEquals($b, $result, "Success"); 
    }
    
    public function testGenerateForZero(){
       $factors = new PrimeFactors();
       $this->setExpectedException("InvalidArgumentException");
       $factors->generate(0);
    }

    public function PrimeProvider() {
        return array(
            array(280, array(2, 2, 2, 5, 7)),
            array(48, array(2, 2, 2, 2, 3)),
//            array("", array()),
//            array(-1, array()),
        );
    }

}
