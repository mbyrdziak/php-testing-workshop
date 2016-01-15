<?php

namespace Test\Integration;


class OrderRepositoryStub extends \Workshop\Integration\OrderRepository {
    private $order;
    public function __construct(){
        
    }
    
    public function getOrderData($orderId){
        return $this ->order;
               
        
    }
    
    public function save(\Workshop\Integration\Order $order){
        $this ->order = $order;
        return 1;
    }
}
