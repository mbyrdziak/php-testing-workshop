<?php
namespace Workshop\Integration;

class AddOrderService {

    /**
     * @var \OrderRepository
     */
    private $repo;

    public function __construct(OrderRepository $repo) {
         $this->repo = $repo;
    }
    
    /**
     * 
     * @param string $pickupAddress
     * @param string $shippingAddress
     * 
     * @return integer order id
     */
    public function execute($pickupAddress, $shippingAddress) {
        $order = new Order($pickupAddress, $shippingAddress);
        return $this->repo->persist($order);
    }
}