<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OrderRepositoryStub
 *
 * @author epol
 */

namespace Test\ut;

class OrderRepositoryStub extends \Workshop\Integration\OrderRepository {
    private $order;
    
    //put your code here
    function __construct() {
        ;
    }
    
    public function findById($orderId){
        return $this->order;
    }
    
    public function persist(\Workshop\Integration\Order $order){
        $this->order = $order;
        return 1;
    }
    

    
    
}
