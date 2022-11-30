<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends BaseModel {
    use HasFactory;

    const STATUS_NEW        = '1';
    const STATUS_ACCEPT     = '2';
    const STATUS_DELIVERY   = '3';
    const STATUS_SUCCESS    = '4';
    const STATUS_CANCER     = '5';


    protected $fillable = [
        'id_user',
        'id_voucher',
        'user_name',
        'price_total',
        'address',
        'phone',
        'status',
    ];

    public function rUsers() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function rVouchers() {
        return $this->belongsTo(Vouchers::class, 'id_user');
    }

    public function rOrderDetail() {
        return $this->hasMany(OrderDetail::class, 'id_order');
    }

    public function getStatus() {
        $retVal = '';
        if ($this->status) {
            switch ($this->status) {
                case self::STATUS_NEW:
                    $retVal = 'Mới';
                    break;
                case self::STATUS_ACCEPT:
                    $retVal = 'Chấp nhận';
                    break;
                case self::STATUS_DELIVERY:
                    $retVal = 'Vận chuyển';
                    break;
                case self::STATUS_SUCCESS:
                    $retVal = 'Thành công';
                    break;
                case self::STATUS_CANCER:
                    $retVal = 'Hủy';
                    break;
                default:
                    break;
            }
        }
        return $retVal;
    }

    public static function getRule() {
        return [
            'user_name' => ['required', 'string'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'numeric', 'min:10'],
            'price_total' => ['required', 'min:0'],
        ];
    }

    public static function getRuleTrans() {
        return [
            'required' => ':attribute không được để trống',
            'min' => ':attribute phải có ít nhất :min ký tự',
            'email' => 'Phải là định dạng email',
            'unique' => ':attribute đã được sử dụng',
            'string' => 'Phải là định dạng chuỗi',
            'max' => ':attribute có tối đa :max ký tự'
        ];
    }

    public static function getArrayStatus() {
        return [
            'Mới' => self::STATUS_NEW,
            'Chấp nhận' => self::STATUS_ACCEPT,
            'Vận chuyển' => self::STATUS_DELIVERY,
            'Thành công' => self::STATUS_SUCCESS,
            'Hủy' => self::STATUS_CANCER,
        ];
    }
}
