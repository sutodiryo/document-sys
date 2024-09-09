<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class File extends Model
{
    use HasUuids, SoftDeletes;

    public $fillable = [
        'name',
        'description',
        'status',
        'lock_status',
        'created_by',
        'custom_fields',
        'verified_at',
        'verified_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'name' => 'string',
    //     'description' => 'string',
    //     'status' => 'string',
    //     'lock_status' => 'string',
    //     'created_by' => 'integer',
    //     'verified_by' => 'integer',
    //     'custom_fields' => 'array'
    // ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'description' => 'nullable',
        'tags' => 'required',
        'custom_fields' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by', 'id');
    }

    public function folder()
    {
        return $this->belongsTo(Folder::class, 'folder_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'files_tags', 'file_id', 'tag_id');
    }

    public function getIsVerifiedAttribute()
    {
        return !empty($this->verified_by) && !empty($this->verified_at) && $this->status == config('constants.STATUS.APPROVED');
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'file_id', 'id');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'file_id', 'id')
            ->orderByDesc('id');
    }

    public function metadatas()
    {
        return $this->hasMany(FileMetadata::class, 'file_id', 'id')
            ->orderByDesc('created_at');
    }

    // public function related_documents()
    // {
    //     return $this->hasMany(RelatedDocument::class, 'parent_id', 'id')
    //         ->orderByDesc('created_at');
    // }

    // public function reminders()
    // {
    //     return $this->hasMany(DocumentReminder::class, 'document_id', 'id')
    //         ->orderByDesc('created_at');
    // }

    public function newActivity($id, $activity)
    {
        Activity::create([
            'activity' => $activity,
            // 'activity' => "" . $file_name . " uploaded to " . $folder_name . ' : <a href="' . route('file.index') . '?uuid=' . $id . '">' . $file_name . "</a>",
            'created_by' => Auth::id(),
            'file_id' => $id,
        ]);
    }
}
