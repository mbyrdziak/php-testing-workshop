<?php
namespace Workshop\Integration;

class AddOrderItemServiceTest extends \Test\Integration\IntegrationTestCase{

    /**
     * @test
     */
    public function shouldNewAddOrderValidArg() {
        $orderRepo = new OrderRepository($this->db);
        $addOrder = new AddOrderService($orderRepo);
        $addItem = new AddOrderItemService($this->db);
        $addedOrderID = $addOrder->execute("smieszki", "heheszki");
        $addItem->execute($addedOrderID, "Testowy", 3, 10, 20);
        $addItem->execute($addedOrderID, "Testowy2", 5, 20, 30);
        $addItem->execute($addedOrderID, "Testowy3", 6, 20, 30);
        
        
        
        $resultOrder = $orderRepo->getOrderByID($addedOrderID);

        $this->assertEquals("smieszki",$resultOrder->getPickupAddress());
        $this->assertEquals("heheszki",$resultOrder->getShippingAddress());
        $this->assertEquals(50,$resultOrder->getPaidAmount());
        $this->assertEquals(80,$resultOrder->getShippingAmount()); 
    }

}
