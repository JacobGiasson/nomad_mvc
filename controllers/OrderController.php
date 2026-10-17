<?php
namespace App\Controllers;

use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use App\Models\OrderProduct;
use App\Providers\View;
use App\Providers\Validator;

class OrderController {

    private array $messages = [
        'created' => 'Order created successfully.',
        'updated' => 'Order updated successfully.',
        'deleted' => 'Order deleted successfully.'
    ];

    // List all orders
    public function index($data = []){
        $orders = (new Order)->selectWithClient();

        return View::render('order/index', [
            'orders' => $orders,
            'success' => $this->messages[$data['success'] ?? ''] ?? null
        ]);
    }

    // Show one order with its client and products
    public function show($data = []){
        $order = $this->findOrder($data);
        if(!$order){
            return View::render('error', ['message' => 'Order not found.']);
        }

        $client = (new Client)->selectId($order['client_id']);
        $lines = (new OrderProduct)->selectByOrder($order['id']);

        return View::render('order/show', [
            'order' => $order,
            'client' => $client,
            'lines' => $lines,
            'success' => $this->messages[$data['success'] ?? ''] ?? null
        ]);
    }

    // Show the create form
    public function create(){
        return View::render('order/create', $this->formLists());
    }

    // Save a new order and its product
    public function store(array $data){
        $val = $this->validate($data);

        if(!$val->isSuccess()){
            return View::render('order/create', array_merge($this->formLists(), [
                'errors' => $val->getErrors(),
                'order' => $data
            ]));
        }

        $product = (new Product)->selectId($data['product_id']);
        if(!$product){
            return View::render('error', ['message' => 'Product not found.']);
        }

        $orderId = (new Order)->insert([
            'client_id' => $data['client_id'],
            'order_date' => $data['order_date'],
            'total' => $data['quantity'] * $product['price']
        ]);

        if(!$orderId){
            return View::render('error', ['message' => 'The order could not be saved.']);
        }

        $this->saveLine($orderId, $product, $data['quantity']);

        return View::redirect('order/show?id=' . $orderId . '&success=created');
    }

    // Show the edit form
    public function edit($data = []){
        $order = $this->findOrder($data);
        if(!$order){
            return View::render('error', ['message' => 'Order not found.']);
        }

        $lines = (new OrderProduct)->selectByOrder($order['id']);
        if($lines){
            $order['product_id'] = $lines[0]['product_id'];
            $order['quantity'] = $lines[0]['quantity'];
        }

        return View::render('order/edit', array_merge($this->formLists(), [
            'order' => $order
        ]));
    }

    // Update an order and its product
    public function update(array $data, $get = []){
        $order = $this->findOrder($get);
        if(!$order){
            return View::render('error', ['message' => 'Order not found.']);
        }

        $val = $this->validate($data);

        if(!$val->isSuccess()){
            $data['id'] = $order['id'];
            return View::render('order/edit', array_merge($this->formLists(), [
                'errors' => $val->getErrors(),
                'order' => $data
            ]));
        }

        $product = (new Product)->selectId($data['product_id']);
        if(!$product){
            return View::render('error', ['message' => 'Product not found.']);
        }

        (new Order)->update([
            'client_id' => $data['client_id'],
            'order_date' => $data['order_date'],
            'total' => $data['quantity'] * $product['price']
        ], $order['id']);

        (new OrderProduct)->deleteByOrder($order['id']);
        $this->saveLine($order['id'], $product, $data['quantity']);

        return View::redirect('order/show?id=' . $order['id'] . '&success=updated');
    }

    // Delete an order and its products
    public function delete(array $data){
        $order = $this->findOrder($data);
        if(!$order){
            return View::render('error', ['message' => 'Order not found.']);
        }

        (new OrderProduct)->deleteByOrder($order['id']);
        (new Order)->delete($order['id']);

        return View::redirect('orders?success=deleted');
    }

    // Find an order from its id
    private function findOrder(array $data){
        if(!isset($data['id'])){
            return false;
        }
        return (new Order)->selectId($data['id']);
    }

    // Client and product lists for the forms
    private function formLists(): array {
        return [
            'clients' => (new Client)->select('name'),
            'products' => (new Product)->select('name')
        ];
    }

    // Validation rules for the order form
    private function validate(array $data): Validator {
        $val = new Validator;
        $val->field('client_id', $data['client_id'] ?? '', 'Client')->required()->int();
        $val->field('order_date', $data['order_date'] ?? '', 'Order date')->required()->date();
        $val->field('product_id', $data['product_id'] ?? '', 'Product')->required()->int();
        $val->field('quantity', $data['quantity'] ?? '', 'Quantity')->required()->int()->numeric();
        return $val;
    }

    // Insert the order line in order_product
    private function saveLine(int $orderId, array $product, $quantity): void {
        (new OrderProduct)->insert([
            'order_id' => $orderId,
            'product_id' => $product['id'],
            'quantity' => $quantity,
            'unit_price' => $product['price']
        ]);
    }
}