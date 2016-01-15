<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Workshop\Integration;

/**
 * Description of OrderRepository
 *
 * @author epol
 */
class OrderRepository {
    private $db;
    public function __construct(\PDO $db) {
        $this->db = $db;
    }
    
    public function findOrderById($id){
        $sql = "SELECT * FROM orders WHERE `id`=:id";
        $stmt = $this->db->query($sql);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $item = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($item == NULL)
            throw new \Exception ("card no found");
        $order = new Order($item['id'],
                    $item['pickup_address'],
                    $item['shipping_address'],
                    $item['paid_amount'],
                    $item['shipping_amount']
        );
        $this->findOrderItemsByOrderId($order);
        return $order;
    }
    
    private function findOrderItemsByOrderId($order){
        $stmt = $this->db->query("SELECT * FROM order_items WHERE order_id = :orderId");
        $stmt->bindValue(':orderId', $order->getId(), \PDO::PARAM_INT);
        $stmt->execute();
        $orderItemRows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        foreach($orderItemRows as $row) {
            $order->addItem(new OrderItem(
                (int)$row['id'],
                (int)$row['order_id'],
                $row['item_title'],
                (int)$row['quantity'],
                (int)$order->getPaidAmount(),
                (int)$order->getShippingAmount()
            ));
        }
    }
    
    public function persist(Order $order){
        $insert = "INSERT INTO orders (id, pickup_address, shipping_address, paid_amount, shipping_amount) 
                    VALUES (:id, :pickupAddress, :shippingAddress, :paidAmount, :shippingAmount)";
        $stmt = $this->db->prepare($insert);
        
        $stmt->bindValue(':id', NULL, \PDO::PARAM_NULL);
        $stmt->bindValue(':pickupAddress', $order->getPickupAddress(), \PDO::PARAM_STR);
        $stmt->bindValue(':shippingAddress', $order->getShippingAddress(), \PDO::PARAM_STR);
        $stmt->bindValue(':paidAmount', 0, \PDO::PARAM_INT);
        $stmt->bindValue(':shippingAmount', 0, \PDO::PARAM_INT);
        $stmt->execute();
        
        return $this->db->lastInsertId();
    }
}
