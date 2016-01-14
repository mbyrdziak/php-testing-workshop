<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Test\Integration;

class AddOrderServiceTest extends IntegrationTestCase {
    //put your code here

    /**
     * @test
     */
    public function addOrderService() {
        $db = $this->setUp();
        $order = new \Workshop\Integration\AddOrderService($db);
        $order->execute("pickupAdress", "shippingAdress");
    }

}
