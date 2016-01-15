<?php


namespace Workshop\Integration;

class OrderRepository {

    /**
     * @var \PDO
     */
    private $db;

    public function __construct(\PDO $db) {
         $this->db = $db;
    }
    
    public function getOrderData($orderId){
        $stmt = $this->db->query("SELECT * FROM orders WHERE id = :orderId");
        $stmt->bindValue(':orderId', $orderId, \PDO::PARAM_INT);
        $stmt->execute();
        $orderRow = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($orderRow == NULL) {
            throw new \Exception(sprintf("Order with id %d doesn't exists", $orderId));
        }
        
        $order= new Order(
            (int)$orderRow['id'],
            $orderRow['pickup_address'],
            $orderRow['shipping_address'],
            (int)$orderRow['paid_amount'],
            (int)$orderRow['shipping_amount']
        );
        
        
        $stmt = $this->db->query("SELECT * FROM order_items WHERE order_id = :orderId");
        $stmt->bindValue(':orderId', $orderId, \PDO::PARAM_INT);
        $stmt->execute();
        $orderItemRows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        foreach($orderItemRows as $row) {
            $order->addItem(new OrderItem(
                (int)$row['id'],
                (int)$row['order_id'],
                $row['item_title'],
                (int)$row['quantity'],
                (int)$orderRow['paid_amount'],
                (int)$orderRow['shipping_amount']
            ));
        }
        
        return $order;
        

    }
    
       public function save(Order $order) {
        $insert = "INSERT INTO orders (id, pickup_address, shipping_address, paid_amount, shipping_amount) 
                    VALUES (:id, :pickupAddress, :shippingAddress, :paidAmount, :shippingAmount)";
        $stmt = $this->db->prepare($insert);
        
        $stmt->bindValue(':id', NULL, \PDO::PARAM_NULL);
        $stmt->bindValue(':pickupAddress', $order->getPickupAddress(), \PDO::PARAM_STR);
        $stmt->bindValue(':shippingAddress', $order->getShippingAddress(), \PDO::PARAM_STR);
        $stmt->bindValue(':paidAmount', $order->getPaidAmount(), \PDO::PARAM_INT);
        $stmt->bindValue(':shippingAmount',$order->getShippingAmount() , \PDO::PARAM_INT);
        $stmt->execute();
        
        return $this->db->lastInsertId();
    }
    
    
    
}
