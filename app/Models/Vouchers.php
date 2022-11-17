<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vouchers extends BaseModel {
    const CONDITION_ALL = '1';
    const CONDITION_PRODUCT = '2';

    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'condition',
        'product_list',
        'discount',
        'description',
        'quantity',
        'begin_date',
        'end_date',
        'status',
    ];

    public function getCondition() {
        $retVal = '';
        if ($this->condition) {
            switch ($this->condition) {
                case self::CONDITION_ALL:
                    $retVal = 'Tổng đơn hàng';
                    break;
                case self::CONDITION_PRODUCT:
                    $retVal = 'Sản phẩm';
                    break;
                default:
                    break;
            }
        }
        return $retVal;
    }

    public static function getRule() {
        return [
            'code' => ['required'],
            'quantity' => ['required', 'min:0'],
            'name' => ['required', 'string'],
            'discount' => ['required', 'min:0'],
            'product_list' => ['required','regex:/^[a-z0-9 \,]*$/i'],
        ];
    }

    public static function getRuleTrans() {
        return [
            'required' => ':attribute không được để trống',
            'min' => ':attribute phải lớn hơn :min',
            'email' => 'Phải là định dạng email',
            'unique' => ':attribute đã được sử dụng',
            'string' => 'Phải là định dạng chuỗi',
            'max' => ':attribute có tối đa :max ký tự',
            'regex' => ':attribute chứa giá trị không hợp lệ',
        ];
    }
}
