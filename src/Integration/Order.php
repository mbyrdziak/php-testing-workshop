<?php
namespace Workshop\Integration;

class Order {
    private $id;
    private $pickupAddress;
    private $shippingAddress;
    private $paidAmount;
    private $shippingAmount;
    private $items = array();
    
    public function __construct($id, $pickupAddress, $shippingAddress, $paidAmount, $shippingAmount) {
        $this->id = $id;
        $this->pickupAddress = $pickupAddress;
        $this->shippingAddress = $shippingAddress;
        $this->paidAmount = $paidAmount;
        $this->shippingAmount = $shippingAmount;
    }
    
    function getId() {
        return $this->id;
    }

    function getPickupAddress() {
        return $this->pickupAddress;
    }

    function getShippingAddress() {
        return $this->shippingAddress;
    }

    function getPaidAmount() {
        return $this->paidAmount;
    }

    function getShippingAmount() {
        return $this->shippingAmount;
    }

    function getItems() {
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

