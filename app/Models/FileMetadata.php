<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileMetadata extends Model
{
    public $table = 'file_metadatas';

    public $fillable = [
        'file_id',
        'name',
        'description',
        'allow_multiple_use',
        'data_type',
        'string_value',
    ];

    public function file()
    {
        return $this->belongsTo(File::class, 'file_id', 'id');
    }
}
