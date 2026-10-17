<?php
namespace App\Models;

class OrderProduct extends CRUD {
    protected $table = 'order_product';
    protected $primaryKey = 'id';
    protected $fillable = ['order_id', 'product_id', 'quantity', 'unit_price'];

    // All products of an order with the product name
    public function selectByOrder(int $orderId): array {
        $sql = "SELECT order_product.*, product.name AS product_name
                FROM order_product
                INNER JOIN product ON order_product.product_id = product.id
                WHERE order_product.order_id = :order_id";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':order_id', $orderId);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Delete all lines of an order
    public function deleteByOrder(int $orderId): bool {
        $sql = "DELETE FROM order_product WHERE order_id = :order_id";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':order_id', $orderId);
        return $stmt->execute();
    }
}