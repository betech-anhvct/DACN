<?php

namespace App\Models;

use Illuminate\Http\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class Images extends Model
{
    protected $fillable = [
        'id_product',
        'name',
        'status',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return string part of img
     */
    public static function imageUploadPost($image)
    {
        // Validator::make($image, [
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3000',
        // ]);
        $name = Storage::disk('public')->put('', new File($image));
        // Move to pulic folder
        $image->move(public_path('images'), $name);
        /* Store $imageName name in DATABASE from HERE */
        return  $name;
    }

    public function rProduct() {
        return $this->belongsTo(Products::class, 'id_product', 'id');
    }

    public static function getRule() {
        return [];
    }

    public static function getRuleTrans() {
        return [];
    }
} 
