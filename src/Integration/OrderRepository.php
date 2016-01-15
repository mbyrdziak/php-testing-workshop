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
    
    function __construct(\PDO $db) {
        $this->db = $db;
    }

    public function findOrderById($id){
        $stmt = $this->db->query("SELECT * FROM orders WHERE id = $id");
        
        $stmt->execute();
        $orderRow = $stmt->fetch(\PDO::FETCH_ASSOC);
   
        $order = new Order(
            (int)$orderRow['id'],
            $orderRow['pickup_address'],
            $orderRow['shipping_address'],
            (int)$orderRow['paid_amount'],
            (int)$orderRow['shipping_amount']
        ); 
                
       $stmt = $this->db->query("SELECT * FROM order_items WHERE order_id = $id");
       $stmt->execute();
       $orderItemRows = $stmt->fetchAll(\PDO::FETCH_ASSOC); 
       
       foreach($orderItemRows as $row) {
           $item = new OrderItem(
                (int)$row['id'],
                (int)$row['order_id'],
                $row['item_title'],
                (int)$row['quantity'],
                (int)$row['paid_amount'],
                (int)$row['shipping_amount']
            );
           $order->addItem($item);
        }
        
        return $order;     
    }
    
    public function persist(Order $order) {
        $insert = "INSERT INTO orders (id, pickup_address, shipping_address, paid_amount, shipping_amount) 
                    VALUES (:id, :pickupAddress, :shippingAddress, :paidAmount, :shippingAmount)";
        $stmt = $this->db->prepare($insert);

        $stmt->bindValue(':id', NULL, \PDO::PARAM_NULL);
        $stmt->bindValue(':pickupAddress', $order->getPickupAddress(), \PDO::PARAM_STR);
        $stmt->bindValue(':shippingAddress', $order->getShippingAddress(), \PDO::PARAM_STR);
        $stmt->bindValue(':paidAmount', $order->getPaidAmount(), \PDO::PARAM_INT);
        $stmt->bindValue(':shippingAmount', $order->getShippingAmount(), \PDO::PARAM_INT);
        $stmt->execute();

        return $this->db->lastInsertId();
    }

}
