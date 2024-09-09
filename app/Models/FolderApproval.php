<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class FolderApproval extends Model
{
    use HasUuids;
    protected $fillable = [
        'folder_id',
        'email',
        'file',
        'comment',
        'status',
    ];

    public function folder()
    {
        return $this->belongsTo(Folder::class, 'folder_id', 'id');
    }
}
