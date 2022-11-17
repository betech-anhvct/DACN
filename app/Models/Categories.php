<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends BaseModel
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

    public static function getRule() {
        return [
            'name' => ['required', 'string'],
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
