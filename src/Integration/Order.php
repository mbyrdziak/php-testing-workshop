<?php
namespace Workshop\Integration;

class Order {
    private $id;
    private $pickupAddress;
    private $shippingAddress;
    private $paidAmount;
    private $shippingAmount;
    private $items = array();
    
    public function __construct($id, $pickupAddress, $shippingAddress, $paidAmount=0, $shippingAmount=0) {
        $this->id = $id;
        $this->pickupAddress = $pickupAddress;
        $this->shippingAddress = $shippingAddress;
        $this->paidAmount = $paidAmount;
        $this->shippingAmount = $shippingAmount;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getPickupAddress() {
        return $this->pickupAddress;
    }

    public function getShippingAddress() {
        return $this->shippingAddress;
    }

    public function getPaidAmount() {
        return $this->paidAmount;
    }

    public function getShippingAmount() {
        return $this->shippingAmount;
    }

    public function getItems() {
        return $this->items;
    }

    public function addItem($item) {
        $this->items[] = $item;
    }
    
    public function setPaidAmount($paidAmount) {
        $this->paidAmount = $paidAmount;
    }

    public function setShippingAmount($shippingAmount) {
        $this->shippingAmount = $shippingAmount;
    }

}

