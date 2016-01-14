<?php

namespace Workshop\Numerals;

class PrimeTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     * @dataProvider primeProvider
     */
    public function primeFactors($input, $expected) {
        $Primes = new PrimeFactors();
           
            $result = $Primes->generate($input);
            $this->assertEquals($expected, $result);

    }
    

    public function primeProvider() {
        return array(
            array(20, [2, 2, 5])
        );
    }

}
