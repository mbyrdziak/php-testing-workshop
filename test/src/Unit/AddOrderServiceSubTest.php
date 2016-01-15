<?php

namespace Test\Unit;

use Workshop\Integration\AddOrderItemService;

class AddOrderServiceSubTest extends \PHPUnit_Framework_TestCase{
    
    public function testAddOrderService() {
        //given
       $OrderRepositorySub = new \Workshop\Integration\OrderRepositoryStub;
       $addOrderservice = new \Workshop\Integration\AddOrderService($OrderRepositorySub);
       //when (akcja, w testach jednostkowycj zazwyczaj jedna linia)
       $lastOrderId=$addOrderservice->execute("pickupAddress", "shippingAddress");
       //then
       $res=$OrderRepositorySub->findById($lastOrderId);
       $this->assertEquals("pickupAddress", $res->getPickupAddress(), "<--------->");
       $this->assertEquals(1, $lastOrderId, "<--------->");
       
    }
}
