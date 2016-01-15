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
    public function shouldTestStub() {
        $repo = new OrderRepositoryStub();
        $service = new AddOrderService($repo);
        $orderId = $service->execute("adres1", "Adres2");
        $result = $repo->findById($orderId);

        $this->assertEquals("adres1", $result->getPickupAddress());
    }

    /**
     * @test
     */
    public function shouldTestWithMock(){
        $orderRepositoryMock = $this->getMockBuilder('\Workshop\Integration\OrderRepository')
                ->disableOriginalConstructor()->getMock();
        
        $service = new AddOrderService($orderRepositoryMock);
        
        $order = new \Workshop\Integration\Order(null, "pickup_address", "shipping_address");
        $orderRepositoryMock->expects($this->once())
                ->method("persist")
                ->with($this->equalTo($order));
        
        $service->execute("pickup_address", "shipping_address");
    }
}
