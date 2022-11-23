<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model {
    use HasFactory;
    protected $fillable = [
        'id_order',
        'id_product',
        'price',
        'quantity',
    ];

    public function rProducts() {
        return $this->hasOne(Products::class, 'id', 'id_product');
    }
}
