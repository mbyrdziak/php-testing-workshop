<?php

namespace Workshop\Numerals;

class PrimeFactorsTest extends \PHPUnit_Framework_TestCase {
    
    /**
     * @dataProvider numberProvider
     */
    public function testGenerate($input, $expected) {
        $primeFactors = new PrimeFactors();
        $result = $primeFactors->generate($input);
        $this->assertEquals($expected, $result);
    }

    public function numberProvider(){
        return array(
            array(56, array(2,2,2,7)),
            array(42, array(2,3,7)),
            //array(-1, array())
        );
    }
    
    /**
     * @expectedException InvalidArgumentException
     */
    public function testGenerateForZero(){
        $t = new PrimeFactors();
        $t->generate(0);
    }
    
    
    public function testGenerateForZeroBest(){      // Najlepszy sposób
        $t = new PrimeFactors();
        $this->setExpectedException("InvalidArgumentException");
        $t->generate(0);
    }
}