<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $primaryKey = "id_order";
    protected $fillable = [
        'id_user',
        'price_total',
        'user_name',
        'address',
        'phone',
        'created_at',
        'update_at',
        'status'
    ];
        // 1 Order có nhiều OrderDetail dùng hasMany( class, 'khoa ngoai', 'khoa chinh')
        public function orderdetails(){
            return $this->hasMany('App\Models\OrderDetail', 'id_order');
        }
        /// khi insert vô db với hàm save() thì migration nó báo lỗi với created_at, thêm dòng sau để tắt nó đi
        public $timestamps = false;

}
