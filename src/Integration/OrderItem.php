<?php
namespace Workshop\Integration;

class OrderItem {
    private $id;
    private $orderId;
    private $itemTitle;
    private $quantity;
    private $paidAmount;
    private $shippingAmount;
 
    function __construct($id, $orderId, $itemTitle, $quantity, $paidAmount, $shippingAmount) {
        $this->id = $id;
        $this->orderId = $orderId;
        $this->itemTitle = $itemTitle;
        $this->quantity = $quantity;
        $this->paidAmount = $paidAmount;
        $this->shippingAmount = $shippingAmount;
    }

    function getId() {
        return $this->id;
    }

    function getOrderId() {
        return $this->orderId;
    }

    function getItemTitle() {
        return $this->itemTitle;
    }

    function getQuantity() {
        return $this->quantity;
    }

    function getPaidAmount() {
        return $this->paidAmount;
    }

    function getShippingAmount() {
        return $this->shippingAmount;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setOrderId($orderId) {
        $this->orderId = $orderId;
    }

    function setItemTitle($itemTitle) {
        $this->itemTitle = $itemTitle;
    }

    function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    function setPaidAmount($paidAmount) {
        $this->paidAmount = $paidAmount;
    }

    function setShippingAmount($shippingAmount) {
        $this->shippingAmount = $shippingAmount;
    }



}

