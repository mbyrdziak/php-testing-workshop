<?php
namespace Workshop\Integration;

class OrderItem {
    private $id;
    private $orderId;
    private $itemTitle;
    private $quantity;
    private $paidAmount;
    private $shippingAmount;
 
    public function __construct($id, $orderId, $itemTitle, $quantity, $paidAmount, $shippingAmount) {
        $this->id = $id;
        $this->orderId = $orderId;
        $this->itemTitle = $itemTitle;
        $this->quantity = $quantity;
        $this->paidAmount = $paidAmount;
        $this->shippingAmount = $shippingAmount;
    }

    public function getId() {
        return $this->id;
    }

    public function getOrderId() {
        return $this->orderId;
    }

    public function getItemTitle() {
        return $this->itemTitle;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getPaidAmount() {
        return $this->paidAmount;
    }

    public function getShippingAmount() {
        return $this->shippingAmount;
    }


}

