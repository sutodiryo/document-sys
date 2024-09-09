<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    public $table = 'tags';

    public $fillable = [
        'name',
        'color',
        'created_by',
        'custom_fields'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        // 'id' => 'integer',
        // 'name' => 'string',
        // 'color' => 'string',
        // 'created_by' => 'integer',
        // 'custom_fields' => 'array'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|unique:tags,name',
        'color' => 'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function documents()
    {
        return $this->belongsToMany(File::class, 'files_tags', 'tag_id','file_id');
    }
}
