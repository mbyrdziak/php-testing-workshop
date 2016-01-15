<?php

namespace Workshop\Integration;

class AddOrderSerwisTest extends \Test\Integration\IntegrationTestCase {

    public function testAddOrderSerwis() {
        $pickupAddress = "adres";
        $shippingAddress = "adres2";
        
        $AddOrderService = new AddOrderService($this->db);
        $idLastestSql = $AddOrderService->execute($pickupAddress, $shippingAddress);
        
        $orderRepository= new OrderRepository($this->db);
        $order=$orderRepository->findById($idLastestSql);
        
        $this->assertEquals($shippingAddress, $order->getShippingAddress());
        $this->assertEquals($pickupAddress, $order->getPickupAddress());
       
        
        
    }

}
