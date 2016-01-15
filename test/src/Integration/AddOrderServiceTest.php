<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Test\Integration;

class AddOrderServiceTest extends IntegrationTestCase {

    /**
     * @test
     */
    public function shouldCreateNewOrder() {
//        $order = new \Workshop\Integration\AddOrderService($this->db);
//        $orderId = $order->execute("pickupAdress1", "shippingAdress1");
//        $item = new \Workshop\Integration\AddOrderItemService($this->db);
//        $item->execute($orderId, "title", 6, 6, 6);
//        
//        $orderRepository = new \Workshop\Integration\OrderRepository($this->db);
//        $orderObject = $orderRepository->findOrderById($orderId);
//      
//        $this->assertEquals("title", $orderObject->getItems()[0]->getItemTitle());

        $orderRepository = new \Workshop\Integration\OrderRepository($this->db);
        $order = new \Workshop\Integration\AddOrderService($orderRepository);
        $orderId = $order->execute("pickupAdress1", "shippingAdress1");
        $item = new \Workshop\Integration\AddOrderItemService($this->db);
        $item->execute($orderId, "title", 6, 6, 6);
        $orderObject = $orderRepository->findOrderById($orderId);
        $this->assertEquals("title", $orderObject->getItems()[0]->getItemTitle());
    }

}
