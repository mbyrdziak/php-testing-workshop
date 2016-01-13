<?php
namespace Test\Integration;

class IntegrationTestCase extends \PHPUnit_Framework_TestCase {
    
    /**
     * @var \PDO
     */
    protected $db;
    
    protected function setUp() {
        $db = new \PDO('sqlite::memory:');
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        
        $db->exec('CREATE TABLE orders ('
                . 'id INTEGER PRIMARY KEY, '
                . 'pickup_address TEXT, '
                . 'shipping_address TEXT, '
                . 'paid_amount INTEGER, '
                . 'shipping_amount INTEGER'
                . ')');
        $db->exec('CREATE TABLE order_items ('
                . 'id INTEGER PRIMARY KEY, '
                . 'order_id INTEGER, '
                . 'paid_amount INTEGER, '
                . 'shipping_amount INTEGER, '
                . 'item_title TEXT, '
                . 'quantity INTEGER, '
                . 'FOREIGN KEY(order_id) REFERENCES orders(id)'
                . ')');
        
        $this->db = $db;
    }
}

