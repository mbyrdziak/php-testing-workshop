<?php


namespace Test\Integration;

class AddOrderItemServiceTest extends IntegrationTestCase{
    
    /**
     * @test
     */
    public function shouldThrowExceptionOrderIdIsNull(){
        $orderService = new \Workshop\Integration\AddOrderItemService($this->db);
        $this->setExpectedException("Exception");
        $orderService->execute(null, "", 0, 0, 0);
    }
    
    /**
     * @test
     */
    public function shouldAddNewItemToNewOrder(){
        $paid = 10;
        $shipping = 5;
        $itemName = "NowyItem";
        $order = new \Workshop\Integration\AddOrderService($this->db);
        $orderId = $order->execute("Address", "Address1");
        $item = new \Workshop\Integration\AddOrderItemService($this->db);
        $item->execute($orderId, $itemName, 1, $paid, $shipping);
        
        $orderRepository = new \Workshop\Integration\OrderRepository($this->db);
        $orderWithItemDB = $orderRepository->findById($orderId);
        
        $itemFromOrder = $orderWithItemDB->getItems()[0];
        
        $this->assertEquals($paid, $itemFromOrder->getPaidAmount());
        $this->assertEquals($shipping, $itemFromOrder->getShippingAmount());
        $this->assertEquals($itemName, $itemFromOrder->getItemTitle());
    }
}
