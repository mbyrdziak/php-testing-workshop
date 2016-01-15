<?php
namespace Test\Unit;

class OrderRepositoryStub extends \Workshop\Integration\OrderRepository{
    
    private $order;
    public function __construct() {
        ;
    }
    
    public function findObjectById($orderId){
        return $this->order;
    }

    public function  persist($order){
        $this->order = $order;
        return 1;
    }
}
