<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalSetting extends Model
{

    public $fillable = [
        'name',
        'value'
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'value' => 'string'
    ];

    public static $rules = [
        'value' => 'required'
    ];
}
