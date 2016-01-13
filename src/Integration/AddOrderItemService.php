<?php
namespace Workshop\Integration;

class AddOrderItemService {

    /**
     * @var \PDO
     */
    private $db;

    public function __construct(\PDO $db) {
         $this->db = $db;
    }
    
    /**
     * 
     * @param integer $orderId
     * @param string $itemTitle
     * @param integer $quantity
     * @param integer $paidAmount
     * @param integer $shippingAmount
     * @throws \Exception
     */
    public function execute($orderId, $itemTitle, $quantity, $paidAmount, $shippingAmount) {
        $stmt = $this->db->query("SELECT * FROM orders WHERE id = :orderId");
        $stmt->bindValue(':orderId', $orderId, \PDO::PARAM_INT);
        $stmt->execute();
        $orderRow = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($orderRow == NULL) {
            throw new \Exception(sprintf("Order with id %d doesn't exists", $orderId));
        }
        
        $order = new Order(
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

        $orderItem = new OrderItem(
            NULL,
            $orderId,
            $itemTitle,
            $quantity,
            $paidAmount,
            $shippingAmount
        );
        $insert = "INSERT INTO order_items (id, order_id, item_title, quantity, paid_amount, shipping_amount) 
                    VALUES (:id, :orderId, :itemTitle, :quantity, :paidAmount, :shippingAmount)";
        $stmt = $this->db->prepare($insert);
        $stmt->bindValue(':id', NULL, \PDO::PARAM_NULL);
        $stmt->bindValue(':orderId', $orderId, \PDO::PARAM_INT);
        $stmt->bindValue(':itemTitle', $itemTitle, \PDO::PARAM_STR);
        $stmt->bindValue(':quantity', $quantity, \PDO::PARAM_STR);
        $stmt->bindValue(':paidAmount', $paidAmount, \PDO::PARAM_INT);
        $stmt->bindValue(':shippingAmount', $shippingAmount, \PDO::PARAM_INT);
        $stmt->execute();
        
        $order->addItem($orderItem);
        $order->setPaidAmount($order->getPaidAmount() + $orderItem->getPaidAmount());
        $order->setShippingAmount($order->getShippingAmount() + $orderItem->getShippingAmount());
        
        $update = "UPDATE orders SET paid_amount = :paidAmount, shipping_amount = :shippingAmount
                    WHERE id = :orderId";
        $stmt = $this->db->prepare($update);
        $stmt->bindValue(':orderId', $orderId, \PDO::PARAM_INT);
        $stmt->bindValue(':paidAmount', $order->getPaidAmount(), \PDO::PARAM_INT);
        $stmt->bindValue(':shippingAmount', $order->getShippingAmount(), \PDO::PARAM_INT);
        $stmt->execute();
    }
}