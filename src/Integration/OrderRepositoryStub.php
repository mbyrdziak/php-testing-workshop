<?php

namespace Workshop\Integration;



class OrderRepositoryStub extends OrderRepository {
    
    private $poleDoPrzechowywaniaOrdera;
    
    public function __construct() {
        ;
    }
   
   public function findById($orderId) {
       return $this->poleDoPrzechowywaniaOrdera;
   }
   public function persist(Order $order) {
       $this->poleDoPrzechowywaniaOrdera=$order; //do pola dopisujemy obiekt Order żeby móc go dalej wykorzystać
       return 1;
       
   }
}
