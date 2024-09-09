<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileShare extends Model
{
    use HasUuids, SoftDeletes;

    public $fillable = [
        'file_id',
        'by_link',
        'email',
        'role',
        'expires_at',
    ];

    public function file()
    {
        return $this->belongsTo(File::class, 'file_id', 'id');
    }
}
