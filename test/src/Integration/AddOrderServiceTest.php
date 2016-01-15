<?php



class AddOrderServiceTest extends Test\Integration\IntegrationTestCase {
    
    public function testAddCorrectOrder(){
        $pickupAddress = "jakis";
        $shippingAddress = "inny";
        $repository = new \Workshop\Integration\OrderRepository($this->db);
        $servis = new \Workshop\Integration\AddOrderService($repository);
        $result = $servis ->execute($pickupAddress, $shippingAddress);
        $this-> assertEquals("1", $result);
        
    }
    
     public function testShouldAddCorrectOrder() {
        $shippingAddress = "ad1";
        $pickupAddress = "ad1";
        
        $title = "cos";
        $quantity = 45;
        $amount = 111;
        $shipingAmount = 141;
        
        $repository = new \Workshop\Integration\OrderRepository($this->db);
        
        
        $service = new \Workshop\Integration\AddOrderService($repository);
        $orderId = $service ->execute($pickupAddress, $shippingAddress);
        
        $orderItem = new \Workshop\Integration\AddOrderItemService($this->db);
        $orderItem-> execute($orderId, $title, $quantity, $amount, $shipingAmount);
        
        $item=$repository->getOrderData($orderId);
        
        $this->assertEquals($title, $item->getItems()[0]->getItemTitle());
        $this->assertEquals($quantity, $item->getItems()[0]->getQuantity());
        $this->assertEquals($amount, $item->getItems()[0]->getPaidAmount());
        $this->assertEquals($shipingAmount, $item->getItems()[0]->getShippingAmount());
        
        
        
    }

}
