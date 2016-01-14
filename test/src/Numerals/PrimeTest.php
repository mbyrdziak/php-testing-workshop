<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Workshop\Numerals;

class PrimeTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     * @dataProvider primeProvider
     */
    public function primeFactors($input, $expected) {
        $primes = new PrimeFactors();


        try {
            $result = $primes->generate($input);
            $this->assertEquals($expected, $result);
            //$this->fail();
        } catch (\InvalidArgumentException $e) {
            
        }
    }

//    /**
//     * @test
//     */
//    public function generateForZero() {
//        $primes = new PrimeFactors();
//        $this->setExpectedException("InvalidArgumentException");
//        $primes->generate(0);
//    }

    public function primeProvider() {
        return array(
            array(20, [2, 2, 5])
        );
    }

}
