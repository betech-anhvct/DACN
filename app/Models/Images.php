<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_product',
        'name',
        'status',
    ];

    public function rProducts() {
        return $this->belongsTo(Products::class, 'id_image', 'id');
    }
}
