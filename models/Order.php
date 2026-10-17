<?php
namespace App\Models;

class Order extends CRUD {
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $fillable = ['client_id', 'order_date', 'total'];

    // All orders with the client name
    public function selectWithClient(): array {
        $sql = "SELECT orders.*, client.name AS client_name
                FROM orders
                INNER JOIN client ON orders.client_id = client.id
                ORDER BY orders.order_date DESC";
        $stmt = $this->query($sql);
        return $stmt->fetchAll();
    }
}