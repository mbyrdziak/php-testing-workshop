<?php
namespace Workshop\Integration;

class AddOrderService {

    /**
     * @var \PDO
     */
    private $db;

    public function __construct(\PDO $db) {
         $this->db = $db;
    }
    
    /**
     * 
     * @param string $pickupAddress
     * @param string $shippingAddress
     * 
     * @return integer order id
     */
    public function execute($pickupAddress, $shippingAddress) {
        $insert = "INSERT INTO orders (id, pickup_address, shipping_address, paid_amount, shipping_amount) 
                    VALUES (:id, :pickupAddress, :shippingAddress, :paidAmount, :shippingAmount)";
        $stmt = $this->db->prepare($insert);
        
        $stmt->bindValue(':id', NULL, \PDO::PARAM_NULL);
        $stmt->bindValue(':pickupAddress', $pickupAddress, \PDO::PARAM_STR);
        $stmt->bindValue(':shippingAddress', $shippingAddress, \PDO::PARAM_STR);
        $stmt->bindValue(':paidAmount', 0, \PDO::PARAM_INT);
        $stmt->bindValue(':shippingAmount', 0, \PDO::PARAM_INT);
        $stmt->execute();
        
        return $this->db->lastInsertId();
    }
}