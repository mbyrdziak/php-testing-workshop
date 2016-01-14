<?php

namespace Workshop\Numerals;

class PrimeFactorTest extends \PHPUnit_Framework_TestCase {
    //* @test -- i wtedy bez słówka test w nazwie metody

    /**
     * @dataProvider primeFactorProvider
     */
    public function testGenerate($input, $expected) {
        $primeFactor = new PrimeFactors();
        $result = $primeFactor->generate($input);
        $this->assertEquals($expected, $result, "<--------->");
    }

    public function primeFactorProvider() {
        return array(
            //pamiętać że tu powinny być wartości progowe, inny typ, NULL, itp.
            array("5", array(5)),
            array(150, array(2, 3, 5, 5)),
            array(525, array(3, 5, 5, 7)),
            array(42, array(2, 3, 7)),
            //array("kasiek", array()),
            //array(-1, array(1))
        );
    }
//jak uzywam metody setExpectedException to nie ma już adnotacji @expectedException InvalidArgumentException

    public function testGenerateForZero(){
        $prime = new PrimeFactors();
        $this ->setExpectedException("InvalidArgumentException");
        $prime->generate(0);
    }

}
