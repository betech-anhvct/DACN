<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    public function rCategories()
    {
        return $this->hasOne(Products::class, 'id_category');
    }
}
