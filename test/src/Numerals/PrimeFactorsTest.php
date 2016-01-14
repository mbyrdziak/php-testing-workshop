<?php

namespace Workshop\Numerals;

class PrimeFactorsTest extends \PHPUnit_Framework_TestCase {

    /**
     * @dataProvider generateProvider
     */
    public function testGenerate($a, $b) {
        $prime = new PrimeFactors();
        $result = $prime->generate($a);
        $this->assertEquals($b, $result);
    }
    
    public function testGenerateForZero(){
        $prime = new PrimeFactors();
        $this->setExpectedException("InvalidArgumentException");
        $prime->generate(0);
    }
    

    public function generateProvider() {
        return array(
            array(
                56, array(2, 2, 2, 7)
            ),
            array(
                42, array(2, 3, 7)
            ),
            array(
                192, array(2, 2, 2, 2, 2, 2, 3)
            )
        );
    }

}
