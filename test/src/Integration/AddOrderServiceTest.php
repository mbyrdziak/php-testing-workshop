<?php

namespace Test\Integration;

class AddOrderServiceTest extends IntegrationTestCase{
    
    public function testAddOrder(){
        $orderService = new \Workshop\Integration\AddOrderService($this->db);
        $orderId = $orderService->execute("aaa", "bbb");

        $orderRepo = new \Workshop\Integration\OrderRepository($this->db);
        $order = $orderRepo->getObjectById($orderId);
        
        $this->assertNotNull($order);
        $this->assertContains("aaa", $order->getPickupAddress());
        $this->assertContains("bbb", $order->getShippingAddress());
    }
}

