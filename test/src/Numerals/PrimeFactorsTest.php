<?php

namespace Workshop\Numerals;

class PrimeFactorsTest extends \PHPUnit_Framework_TestCase {

    /**
     * @dataProvider provider
     */

    public function testDirectKeyHasEqualsValueInArray($n, $key, $expected) {
        $prime = new PrimeFactors();
        $result = $prime->generate($n);
        $this->assertEquals($expected, $result[$key]);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testThrowingExceptionWhenLessThanOneGiven() {
        $prime = new PrimeFactors();
        $prime->generate(0);
    }

    public function provider() {
        return array(
            array(56, 0, 2),
            array(192, 6, 3),
            array(348, 3, 29)
        );
    }
    
    /**
     * @test
     */
    public function Excepton() {
       $prime = new PrimeFactors();
       $this->setExpectedException("InvalidArgumentException");
       $prime->generate(0);
    }
        

}
