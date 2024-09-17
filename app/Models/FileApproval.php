<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class FileApproval extends Model
{
    use HasUuids;
    protected $fillable = [
        'file_id',
        'email',
        'file',
        'comment',
        'status',
    ];

    public function files()
    {
        return $this->belongsTo(File::class, 'file_id', 'id');
    }
}
