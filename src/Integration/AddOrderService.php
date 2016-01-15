<?php
namespace Workshop\Integration;

class AddOrderService {

    /**
     * @var \PDO
     */
    private $db;
    private $repo;

    public function __construct(OrderRepository $repo) {
         //$this->db = $db;
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
        $order = new Order(NULL, $pickupAddress, $shippingAddress, 0, 0);
        return $this->repo->persist($order);

    }
}