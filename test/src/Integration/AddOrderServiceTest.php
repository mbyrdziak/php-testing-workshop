<?php

namespace Workshop\Integration;

class AddOrderServiceTest extends \Test\Integration\IntegrationTestCase {

    /**
     * @test
     */
    public function shouldNewAddOrderValidArg() {

        $addOrder = new AddOrderService($orderRepo = new OrderRepository($this->db));
        $addedOrderID = $addOrder->execute("hahaha", "hehehehe");
        
        $resultOrder = $orderRepo->getOrderByID($addedOrderID);
        
        $expectedOrder = new Order(
            1,
            "hahaha",
            "hehehehe",
            0,
            0,
            array()
        );
        
        $this->assertEquals($expectedOrder,$resultOrder);
    }

}
