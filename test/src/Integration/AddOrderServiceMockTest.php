<?php

namespace Test\Integration;
use \Workshop\Integration\AddOrderService;
use Workshop\Integration\Order;
class AddOrderServiceMockTest extends \PHPUnit_Framework_TestCase{
    /**
     * @test
     */
    public function shouldAddOrder(){
        $orderRepositryMock = $this->getMockBuilder('Workshop\Integration\OrderRepository')
                ->disableOriginalConstructor()
                ->getMock();
        $service = new AddOrderService($orderRepositryMock);
        $order = new Order(NULL, "pickupAddress", "shippingAddress", 0, 0);
        $orderRepositryMock->expects($this->once())
                ->method('persist')
                ->with($this->equalTo($order));
        
        $service->execute("pickupAddress", "shippingAddress");
    }
    
    /**
     * @test
     */
    public function shouldReturnObjectId(){
        $orderRepositryMock = $this->getMockBuilder('Workshop\Integration\OrderRepository')
                ->disableOriginalConstructor()
                ->getMock();
        $service = new AddOrderService($orderRepositryMock);
        
        $orderRepositryMock->method('persist')
                ->will($this->returnValue(1));
        
        $result = $service->execute(NULL, "pickupAddress", "shippingAddress", 0, 0);
        $this->assertEquals("1", $result);
    }
}
