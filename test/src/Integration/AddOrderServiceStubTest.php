<?php
namespace Test\Integration;

class AddOrderServiceStubTest extends \PHPUnit_Framework_TestCase{
    /**
     * @test
     */
    public function shouldAddOrder(){
        //given
        $orderRepoStub = new OrderRepositoryStub();
        $addOrder = new \Workshop\Integration\AddOrderService($orderRepoStub);
        //when
        $addedOrderID = $addOrder->execute("hahaha", "hehehehe");
        //then
        $res= $orderRepoStub->getOrderByID($addedOrderID);
        $this->assertEquals("hahaha",$res->getPickupAddress());
        $this->assertEquals(1,$addedOrderID);
    }
}
