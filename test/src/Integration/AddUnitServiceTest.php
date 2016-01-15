<?php

namespace Test\Integration;


class AddUnitServiceTest extends \PHPUnit_Framework_TestCase {
    
    public function testUnit(){
        //given
        $orderRepoStub = new OrderRepositoryStub();
        $service = new \Workshop\Integration\AddOrderService($orderRepoStub);
        //when
        $order = $service->execute("cos", "cos");
        //then
        $res = $orderRepoStub ->getOrderData($order);
        $this ->assertEquals("cos", $res->getPickupAddress());
        
    }
    
    public function testReturnObjectId(){
        $orderRepositoryMock = $this->getMockBuilder('\Workshop\Integration\OrderRepository')
                ->disableOriginalConstructor()
                ->getMock();
        $service = new \Workshop\Integration\AddOrderService($orderRepositoryMock);
        
        $order = new \Workshop\Integration\Order (null, "pickup_address", "shipping_address");
        $orderRepositoryMock-> method('save')
                ->will($this->returnvalue(1));
                
        $orderId = $service->execute("pickup_address", "shipping_address");
        $this->assertEquals(1, $orderId);
        
    }
    
     public function testCreateNewOrderInRepository(){
        $orderRepositoryMock = $this->getMockBuilder('\Workshop\Integration\OrderRepository')
                ->disableOriginalConstructor()
                ->getMock();
        $service = new \Workshop\Integration\AddOrderService($orderRepositoryMock);
        
        $order = new \Workshop\Integration\Order (null, "pickup_address", "shipping_address");
        $orderRepositoryMock-> expects($this->once())
                ->method('save')
                ->with($this->equalTo($order));
        
        $service->execute("pickup_address", "shipping_address");
        
    }
    

}
