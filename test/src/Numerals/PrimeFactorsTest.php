<?php
namespace Workshop\Numerals;

class PrimeFactorsTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     * @dataProvider primeProvider
     */
    public function computePrimeFactors($input, $expected) {
        $testObj = new PrimeFactors;
        $result = $testObj->generate($input);
        $this->assertEquals($expected, $result);
    }

    public function primeProvider() {
        return array(
            array(2, array(2)),
            array(3, array(3)),
            array(4, array(2,2)),
            array(11, array(11)),
            array(15, array(3,5)),
            array(42, array(2,3,7)),
            array(234, array(2,3,3,13))
        );
    }
   
    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function computePrimeFactorsExeption() {
        $testObj = new PrimeFactors;
        $testObj->generate(0);
    }
    
    /**
     * @test
     */
    public function computePrimeFactorsExeption2() {
        $testObj = new PrimeFactors;
        $this->setExpectedException("InvalidArgumentException");
        $testObj->generate(0);
    }
    
        /**
     * @test
     */
    public function computePrimeFactorsExeption3() {
        $testObj = new PrimeFactors;
        try {
            $testObj->generate(0);
            $this->fail();
        } catch (\InvalidArgumentException $ex) {
            
        }
        
    }

}
