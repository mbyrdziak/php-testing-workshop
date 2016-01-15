<?php
namespace Workshop\Integration;

class AddOrderService {

    public function __construct(OrderRepository $repozytorium) {
         $this->repo = $repozytorium;
    }
    
    /**
     * 
     * @param string $pickupAddress
     * @param string $shippingAddress
     * 
     * @return integer order id
     */
    public function execute($pickupAddress, $shippingAddress) {
        $order = new Order (NULL,$pickupAddress, $shippingAddress,0,0 );
        return $this->repo->save($order);
    }
}