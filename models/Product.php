<?php
namespace App\Models;

class Product extends CRUD {
    protected $table = 'product';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'description', 'price', 'stock'];
}