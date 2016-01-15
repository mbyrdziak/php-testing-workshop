<?php

namespace Test\Unit;

class AddOrderServiceUnit extends \PHPUnit_Framework_TestCase{
    public function testAddNewOrder(){
        $repo = new OrderRepositoryStub();
        
        $service = new \Workshop\Integration\AddOrderService($repo);
        $addedOrderId = $service->execute("adres", "adres");
        
        $order = $repo->findById($addedOrderId);
        $this->assertEquals("adres", $order->getPickupAddress());
        $this->assertEquals("adres", $order->getShippingAddress());
    }
}
