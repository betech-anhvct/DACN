<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id_category',
        'name',
        'description',
        'price',
        'status',
    ];

    public function rCategories(){
        return $this->belongsTo(Categories::class, 'id_category', 'id');
    }
}
