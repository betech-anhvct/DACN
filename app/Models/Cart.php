<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = "cart";
    public $timestamps = false;

    public $fillable=[
        'id_user',
        'id_product_detail',
        'quantity'

    ];public function product_detail(){
        return $this->belongsTo('App\Models\ProductDetail', 'id_product_detail');
    }


}
