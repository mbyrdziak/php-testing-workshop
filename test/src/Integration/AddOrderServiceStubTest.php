<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Test\Integration;
use Workshop\Integration\AddOrderService;
use Workshop\Integration\OrderRepository;
/**
 * Description of AddOrderServiceStubTest
 *
 * @author epol
 */
class AddOrderServiceStubTest extends \PHPUnit_Framework_TestCase{
    /**
     * @test
     */
    public function executeInsertRow() {
        $order = new AddOrderService(new OrderRepositoryStub());
        $res = $order->execute("127.0","0.1");
        $this->assertNotFalse($res);
    }
    
    /**
     * @test
     * 
     */
    public function executeInsertedIdEquals1() {
        $order = new AddOrderService(new OrderRepositoryStub());
        $res = $order->execute("127.0","0.1");
        $this->assertEquals("1",$res);
    }
    
    /**
     * @test
     * 
     */
    public function executeShouldAddOrder() {
        //given
        $repo = new OrderRepositoryStub();
        $order = new AddOrderService($repo);
        //when
        $id = $order->execute("127.0","0.1");
        //then
        $orderElement = $repo->findOrderById($id);
        $this->assertEquals("1",$id);
        $this->assertEquals("127.0",$orderElement->getPickupAddress());
        $this->assertEquals("0.1",$orderElement->getShippingAddress());
    }
}
