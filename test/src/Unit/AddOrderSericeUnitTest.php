<?php

namespace Test\Unit;

use Workshop\Integration\AddOrderService;

class AddOrderSericeUnitTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     */
    public function shouldCreateNewOrder() {
        $repo = new OrderRepositoryUnitTest();
        $service = new AddOrderService($repo);
        $orderId = $service->execute("asd", "asd");
        
        $result = $repo->findOrderById($orderId);
        
        $this->assertEquals("asd", $result->getPickupAddress());
    }

}
