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
    public function proba(){
        $db = $this->setUp();
        $OrderService = new \Workshop\Integration\AddOrderService($db);
        $OrderService->execute("adres1", "adres2");
        
        
    }
    
    
    
}
