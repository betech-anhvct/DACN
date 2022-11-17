<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class BaseModel extends Model {
    const STATUS_SHOW = '1';
    const STATUS_HIDDEN = '2';

    use HasFactory;

    public function getStatus() {
        $retVal = '';
        if ($this->status) {
            switch ($this->status) {
                case self::STATUS_SHOW:
                    $retVal = 'Hiển thị';
                    break;
                case self::STATUS_HIDDEN:
                    $retVal = 'Ẩn';
                    break;
                default:
                    break;
            }
        }
        return $retVal;
    }

    public static function getRule() {
        return [];
    }

    public static function getRuleTrans() {
        return [];
    }

    public static function validate($data) {
        return Validator::make($data, self::getRule());
    }
}
