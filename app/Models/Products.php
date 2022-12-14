<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends BaseModel {
    use HasFactory;

    protected $fillable = [
        'id_category',
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
        return $this->hasMany(Images::class, 'id_product', 'id');
    }
    public static function getRule() {
        return [
            'name' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:1'],
            'stock' => ['required', 'numeric', 'min:0'],
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
        ];
    }

    public function productRule() {
        return [
            'id' => ['required'],
            'id_catogary' => ['required'],
            'id_image' => ['required'],
            'name' => ['required'],
            'description' => ['required'],
            'price' => ['required'],
            'stock' => ['required'],
            'status' => ['required'],
        ];
    }
}
