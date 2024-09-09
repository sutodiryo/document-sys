<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasUlids;

    public $fillable = [
        'file_id',
        'name',
        'file',
        'custom_fields',
        'created_by',
        'user_id'
    ];

    public function file()
    {
        return $this->belongsTo(File::class, 'file_id', 'id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
