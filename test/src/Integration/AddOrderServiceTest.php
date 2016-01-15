<?php

namespace Test\Integration;
use Workshop\Integration\AddOrderService;
use Workshop\Integration\OrderRepository;

class AddOrderServiceTest extends IntegrationTestCase {

    /**
     * @test
     */
    public function executeInsertRow() {
        $order = new AddOrderService(new OrderRepository($this->db));
        //$order = new AddOrderService(new OrderRepositoryStub());
        $res = $order->execute("127.0","0.1");
        
        $this->assertNotFalse($res);
    }
    
    /**
     * @test
     */
    public function executeEqualsValue() {
        //$service = new AddOrderService($this->db);
        $service = new AddOrderService(new OrderRepository($this->db));
        $id = $service->execute("127.0","0.1");
        //$repo = new OrderRepository($this->db);
        $repo = new OrderRepository($this->db);
        $order = $repo->findOrderById($id);
        $this->assertEquals("127.0", $order->getPickupAddress());
        $this->assertEquals("0.1", $order->getShippingAddress());
        $this->assertEquals($id, $order->getId());
        $this->assertEquals("0", $order->getPaidAmount());
        $this->assertEquals("0", $order->getShippingAmount());
    }
}
