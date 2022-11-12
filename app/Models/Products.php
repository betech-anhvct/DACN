<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model {
    use HasFactory;

    protected $fillable = [
        'id_category',
        'id_image',
        'name',
        'description',
        'price',
        'stock',
        'status',
    ];

    public function rCategories() {
        return $this->belongsTo(Categories::class, 'id_category', 'id');
    }

    public function rImages() {
        return $this->hasMany(Categories::class, 'id', 'id_image');
    }
    public function productRule(){
        return[
            'id'=> ['required'],
            'id_catogary'=>['required'],
            'id_image'=>['required'],
            'name'=>['required'],
            'description'=>['required'],
            'price'=>['required'],
            'stock'=>['required'],
            'status'=>['required'],
        ];
    }
}
