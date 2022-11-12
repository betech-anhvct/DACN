<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model {
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
        return $this->hasMany(Categories::class, 'id', 'id_image');
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
}
