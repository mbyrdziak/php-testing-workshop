<?php

class AddOrderSewviceMockTest extends \PHPUnit_Framework_TestCase{
    
    public function testShouldCreateOrderInRepository() {
        $orderRepositoryMock= $this->getMockBuilder('\Workshop\Integration\OrderRepository')
                ->disableOriginalConstructor()
                ->getMock();
        $service=new Workshop\Integration\AddOrderService($orderRepositoryMock);
        
        $order=new \Workshop\Integration\Order(null,"pickupAddress","shippingAddress");
        
        $orderRepositoryMock->expects($this->once())
                ->method('persist')
                ->with($this->equalTo($order));
        
        $service->execute("pickupAddress","shippingAddress");
        
    }
    
}
