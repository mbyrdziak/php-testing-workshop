<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Test\ut;

use Workshop\Integration\AddOrderService;

/**
 * Description of OrderRepositoryUnitTest
 *
 * @author epol
 */
class OrderRepositoryUnitTest extends \PHPUnit_Framework_TestCase {
    //put your code here
    
    /**
* @test
*/
public function shouldTestStub(){
        $repo = new OrderRepositoryStub();
        $service = new AddOrderService($repo);
        $orderId = $service->execute("adres1", "Adres2");
        $result = $repo->findById($orderId);
        
        $this->assertEquals("adres1", $result->getPickupAddress());   
}
        
}
