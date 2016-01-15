<?php

namespace Test\Integration;

class AddOrderServiceItemTest extends IntegrationTestCase{
    
    public function testAddOrderItems(){
        $repository = new \Workshop\Integration\OrderRepository($this->db);
        $orderService = new \Workshop\Integration\AddOrderService($repository);
        $orderId = $orderService->execute("aaa", "bbb");
        
        $item = new \Workshop\Integration\OrderItem(1, $orderId, "ItemTitle1", 1, 2, 3);

        $addOrderService = new \Workshop\Integration\AddOrderItemService($this->db);
        $addOrderService->execute($item->getOrderId(), $item->getItemTitle(), $item->getQuantity(), $item->getPaidAmount(),$item->getShippingAmount());

        $orderRepository = new \Workshop\Integration\OrderRepository($this->db);
        $order = $orderRepository->findObjectById($orderId);
        
        $this->assertNotNull($addOrderService);
        $this->assertContains("aaa", $order->getPickupAddress());
       // $this->assertContains("ItemTitle1", $order->getItems()[0]->getItemTitle());
    }
}