<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Test\Integration;
use Workshop\Integration\AddOrderService;
use Workshop\Integration\OrderRepository;
use \Workshop\Integration\Order;
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
     * TestDoubles - imitacja 
     * STUB / MOCK - stub - pisanie klasy(sprawdza przeplyw, sciezke)/ mock sam generuje klase(sprawdza zachowanie)
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
    
    /**
     * @test
     * MOCK 
     */
    public function executeShouldAddOrderMock() {
        //given
        $orderRepoMock = $this->getMockBuilder("Workshop\Integration\OrderRepository")
                ->disableOriginalConstructor()->getMock();
        $service = new AddOrderService($orderRepoMock);
        //when
        $order = new Order(null,"pickup","shipping",0,0);
        $orderRepoMock->expects($this->once())->method('persist')
                ->with($this->equalTo($order));
        //then
        $service->execute("pickup","shipping");
    }
    
    /**
     * @test
     * MOCK 
     */
    public function executePersistReturnValueMock() {
        //given
        $orderRepoMock = $this->getMockBuilder("Workshop\Integration\OrderRepository")
                ->disableOriginalConstructor()->getMock();
        $orderRepoMock->method("persist")->will($this->returnValue(1));
        $service = new AddOrderService($orderRepoMock);
        //when
        $orderId = $service->execute("addr","ship");
        //then
        $this->assertEquals(1, $orderId);
    }
    
    /**
     * @test
     * MOCK 
     */
    public function executeShouldAddOrderMock2() {
        //given
        $orderRepoMock = $this->getMockBuilder("Workshop\Integration\OrderRepository")
                ->disableOriginalConstructor()->getMock();
        $service = new AddOrderService($orderRepoMock);
        //when
        $order = new Order(null,"pickup","shipping",0,0);
//        $orderRepoMock->
        $orderRepoMock->expects($this->once())->method('persist')
                ->with($this->equalTo($order));
        //then
        $service->execute("pickup","shipping");
    }
}
