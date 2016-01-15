<?php

namespace Test\Unit;

use Workshop\Integration\AddOrderService;

class AddOrderServiceUnitTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     */
    public function shouldCreateNewOrder() {
        //uzycie stuba
        $repo = new OrderRepositoryUnitTest();
        $service = new AddOrderService($repo);
        $orderId = $service->execute("asd", "asd");

        $result = $repo->findOrderById($orderId);

        $this->assertEquals("asd", $result->getPickupAddress());
    }

    /**
     * @test
     */
    public function shouldCreateNewOrderRepository() {
        $orderRepositoryMock = $this->getMockBuilder("\Workshop\Integration\OrderRepository")
                ->disableOriginalConstructor()
                ->getMock();
        $service = new AddOrderService($orderRepositoryMock);

        $order = new \Workshop\Integration\Order(null, "pickup_address", "shipping_address");
        $orderRepositoryMock->expects($this->once())
                ->method("persist")
                ->with($this->equalTo($order));

        $service->execute("pickup_address", "shipping_address");
    }

    /**
     * @test
     */
    public function shouldReturnObjectId() {
        $orderRepositoryMock = $this->getMockBuilder("\Workshop\Integration\OrderRepository")
                ->disableOriginalConstructor()
                ->getMock();
        $service = new AddOrderService($orderRepositoryMock);
        $order = new \Workshop\Integration\Order(null, "pickup_address", "shipping_address");
        
        $orderRepositoryMock->method("persist")
                ->will($this->returnValue(1));
        
        $orderId = $service->execute("pickup_address", "shipping_address");
        $this->assertEquals(1, $orderId);
    }

}
