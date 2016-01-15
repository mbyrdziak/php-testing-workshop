<?php

namespace Test\Integration;

class OrderRepositoryStub extends \Workshop\Integration\OrderRepository{
    private $order;
    public function __construct() {
    }

    public function findOrderById($id) {
        return $this->order;
    }
    public function persist(\Workshop\Integration\Order $order){
        $this->order = $order;
        return 1;
    }
}
