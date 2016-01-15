<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Test\Unit;

/**
 * Description of AddOrderServiceMockTest
 *
 * @author epol
 */
class AddOrderServiceMockTest extends \PHPUnit_Framework_TestCase{
    
    private $orderRepositoryMock;
    private $service;
    /**
     * @before
     */
    public function init(){
        $this->orderRepositoryMock = $this->getMockBuilder('Workshop\Integration\OrderRepository')
                ->disableOriginalConstructor()
                ->getMock();
        $this->service = new \Workshop\Integration\AddOrderService($this->orderRepositoryMock);
    }
    /**
     * @test
     */
    public function shouldCreateNewOrderInRepository(){
        $order = new \Workshop\Integration\Order("pickup","shipping");
        $this->orderRepositoryMock->expects($this->once())
                ->method("persist")
                ->with($this->equalTo($order));
        
        $this->service->execute("pickup", "shipping");
    }
    
    /**
     * @test
     */
    public function shouldReturnObjectId(){
        $this->orderRepositoryMock->method("persist")
                ->will($this->returnValue(1));
        
        $orderId = $this->service->execute("pickup", "shipping");
        
        $this->assertEquals(1,$orderId);
    }
}
