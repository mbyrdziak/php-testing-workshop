<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Test\Unit;

/**
 * Description of OrderRepositoryStub
 *
 * @author epol
 */
class OrderRepositoryStub extends \Workshop\Integration\OrderRepository{
    private $order;
    public function __construct() {
    }
    public function findById($id) {
        return $this->order;
    }

    public function persist(\Workshop\Integration\Order $order) {
        $this->order = $order;
        return 1;
    }

}
