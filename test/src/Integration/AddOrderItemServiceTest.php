<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Test\Integration;
use Workshop\Integration\AddOrderItemService;
use Workshop\Integration\OrderRepository;
use Workshop\Integration\AddOrderService;
/**
 * Description of AddOrderItemServiceTest
 *
 * @author epol
 */
class AddOrderItemServiceTest extends IntegrationTestCase {    
    /**
     * @test
     */
    public function executeEqualsOrderItemValue() {
        $service = new AddOrderService(new OrderRepository($this->db));
        $itemService = new AddOrderItemService($this->db);
        $repo = new OrderRepository($this->db);
        
        $orderId = $service->execute("127.0","0.1");
        $itemService->execute($orderId, "dupa", 1, 5, 15);
        
        $order = $repo->findOrderById($orderId);
        $orderItems = $order->getItems()[0];

        $this->assertEquals("dupa", $orderItems->getItemTitle());
        $this->assertEquals(1, $orderItems->getQuantity());
        $this->assertEquals(5, $orderItems->getPaidAmount());
        $this->assertEquals(15, $orderItems->getShippingAmount());
    }
    
}
