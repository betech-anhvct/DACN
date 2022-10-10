<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class BaseModel extends Model
{
    use HasFactory;
    public static function getRule()
    {
        return [];
    }

    public static function validate($data)
    {
        return Validator::make($data, self::getRule());
    }
}
