<?php


namespace Test\Integration;


class AddOrderServiceTest extends IntegrationTestCase{
    
    /**
     * @test
     */
    public function shouldAddNewOrder() {
        $repository = new \Workshop\Integration\OrderRepository($this->db);
        $order = new \Workshop\Integration\AddOrderService($repository);
        $pickupAddress = "adres";
        $shippingAddress = "adres1";
        $result = $order->execute($pickupAddress, $shippingAddress);
        $orderFromDB = $repository->findById($result);
        $this->assertEquals($pickupAddress, $orderFromDB->getPickupAddress());
        $this->assertEquals($shippingAddress, $orderFromDB->getShippingAddress());
        $this->assertEquals(0, $orderFromDB->getShippingAmount());
        $this->assertEquals(0, $orderFromDB->getPaidAmount());
        $this->assertEquals($result, $orderFromDB->getId());
//        $this->assertThat($orderFromDB, new OrderConstraint()->pickupAddress("bla")->paidAmount(0));
    }
}
