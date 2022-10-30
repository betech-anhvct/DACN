<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_parent',
        'name',
        'status',
    ];

    public function rCategories()
    {
        return $this->hasOne(Products::class, 'id_category');
    }
}
