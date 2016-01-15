<?php
namespace Test\Unit;

class AddOrderServiceStubTest extends \PHPUnit_Framework_TestCase{

    /**
     * @test
     */
//    public function shouldCreateNewOrder() {
//        //given
//        $repo = new OrderRepositoryStub();
//        $service = new \Workshop\Integration\AddOrderService($repo);
//        //when
//        $orderId = $service->execute("CCC", "DDD");
//        //then
//        $order = $repo->findObjectById($orderId);
//        $this->assertEquals("CCC", $order->getPickupAddress());
//    }
    
    public function shouldCreateNewOrderMock() {
        //given
        $orderRepositoryMock = $this->getMockBuilder('\Workshop\Integration\OrderRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $service = new \Workshop\Integration\AddOrderService($orderRepositoryMock);
        //when $id, $pickupAddress, $shippingAddress, $paidAmount, $shippingAmount
        $order = new \Workshop\Integration\Order(NULL, "CCC", "DDD",0,0);
        $orderRepositoryMock->expects($this->once())->method('persist')->with($this->equalTo($order));
        $orderId = $service->execute("CCC", "DDD");
        //then
//        $order = $repo->findObjectById($orderId);
//        $this->assertEquals("CCC", $order->getPickupAddress());
    }
}