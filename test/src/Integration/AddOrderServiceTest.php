<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Test\Integration;

/**
 * Description of AddOrderServiceTest
 *
 * @author epol
 */
class AddOrderServiceTest extends IntegrationTestCase {
    //put your code here
    
    
    /**
     * @var @test
     */
    public function shouldCheckOrder(){
        $orderRepository = new \Workshop\Integration\OrderRepository($this->db); 
        $order = new \Workshop\Integration\AddOrderService($orderRepository);
        $orderId = $order->execute("adres1", "adres2");
        $orderItem = new \Workshop\Integration\AddOrderItemService($this->db);
        $orderItem->execute($orderId, "Tytul", 2, 200, 3);
        
           
        $orderObject = $orderRepository->findOrderById($orderId);   
   
        $this->assertEquals("Tytul", $orderObject->getItems()[0]->getItemTitle());
    }
    
    /**
     * @var @test
     */
//    public function shouldCheckOrder2(){
//        $orderRepository = new \Workshop\Integration\OrderRepository($this->db);
//        
//        $order = new \Workshop\Integration\AddOrderService($orderRepository);
//        $orderId = $order->execute("adres1", "adres2");
//        $orderItem = new \Workshop\Integration\AddOrderItemService($this->db);
//        $orderItem->execute($orderId, "Tytul", 2, 200, 3);
//        
//        
//    }
    
    
    
}
