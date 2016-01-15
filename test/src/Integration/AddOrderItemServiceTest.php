<?php

namespace Workshop\Integration;

class AddOrderItemServiceTest extends \Test\Integration\IntegrationTestCase {
    
    public function testExecute() {
        
        $itemTitle="kasiek"; 
        $quantity=4;
        $paidAmount=15;
        $shippingAmount=5;
        $pickupAddress = "adres";
        $shippingAddress = "adres2";
        
        $orderRepository= new OrderRepository($this->db);
        
        $AddOrderService = new AddOrderService($orderRepository);
        $orderId = $AddOrderService->execute($pickupAddress, $shippingAddress);
        
        $AddOrderItemService = new AddOrderItemService($this->db);
        $AddOrderItemService->execute($orderId, $itemTitle, $quantity, $paidAmount, $shippingAmount);

        $order=$orderRepository->findById($orderId);
        
        $this->assertEquals($itemTitle, $order->getItems()[0]->getItemTitle());
        $this->assertEquals($quantity, $order->getItems()[0]->getQuantity());
        $this->assertEquals($paidAmount, $order->getItems()[0]->getPaidAmount());
        $this->assertEquals($shippingAmount, $order->getItems()[0]->getShippingAmount());
        
    }
}
