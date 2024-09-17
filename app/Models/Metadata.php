<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Metadata extends Model
{
    protected $table = 'metadatas';
    public $fillable = [
        'folder_id',
        'file_id',
        'name',
        'description',
        'allow_multiple_use',
        'data_type',
        'string_value',
    ];

    public function folder()
    {
        return $this->belongsTo(Folder::class, 'folder_id', 'id');
    }

    public function file()
    {
        return $this->belongsTo(File::class, 'file_id', 'id');
    }
}
