<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Workshop\Numerals;

/**
 * Description of PrimeFactorTest
 *
 * @author epol
 */
class PrimeFactorTest extends \PHPUnit_Framework_TestCase{
    /**
     * @test
     * @dataProvider primeProvider
     */
    public function primeFactorsGenerateFromNumbers($input, $expected){
        $factors = new PrimeFactors();
        $result = $factors->generate($input);
        $this->assertEquals($expected, $result,"buuuu\n");
    }
    
    public function primeProvider(){
        return array(
            array(42,array(2,3,7)),
            array(56,array(2,2,2,7)),
            array(348,array(2,2,3,29))
        );
    }
    /**
     * @test
     */
    public function primeFactorsGenerateContainsTwo(){
        $factors = new PrimeFactors();
        $result = $factors->generate(56);
        $this->assertContains(2,$result);
    }
    
    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function primeFactorsGenerateForZero(){
        $factors = new PrimeFactors();
        $res = $factors->generate(0);
    }
    /**
     * @test
     */
    public function primeFactorsGenerateForNumberLessThanZero(){
        $factors = new PrimeFactors();
        try {
            $factors->generate(-1);
            $this->fail();
        } catch (\InvalidArgumentException $e) {
            $res = -1;
            $this->assertEquals(-1,$res);
        }
    }
    
    /**
     * @test
     */
    public function primeFactorsGenerateForZeroWithSetExpectedMethod(){
        $factors = new PrimeFactors();
        $this->setExpectedException("InvalidArgumentException");
        $factors->generate(-1);
    }

}
