<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Nevadskiy\Tree\AsTree;

class Folder extends Model
{
    use HasUuids, AsTree, SoftDeletes;

    protected $fillable = [
        'parent_id',
        'name',
        'status',
        'created_by',
        'parents',
        'path',
        'approval_status',
        'approval_resolution',
        'active_until',
    ];

    protected $guarded = [];

    protected $cast = [
        'parents' => 'array'
    ];

    // protected $searchable = [
    //     'columns' => [
    //         'file_system_documents.sop_number' => 10,
    //         'file_system_documents.sop_add_win' => 10,
    //         'file_system_documents.sop_add_form' => 10,
    //         'file_system_documents.file_number' => 10,
    //         'file_system_documents.prefix_code' => 10,
    //         'file_system_documents.title' => 8,
    //         'departments.name' => 8,
    //         'users.name' => 8,
    //     ],
    //     'joins' => [
    //         'departments' => ['file_system_documents.department_id', 'departments.id'],
    //         'users' => ['file_system_documents.user_id', 'users.id'],
    //     ]
    // ];

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function files()
    {
        return $this->hasMany(File::class, 'folder_id', 'id')
            ->orderByDesc('created_at');
    }

    public function approvals()
    {
        return $this->hasMany(FolderApproval::class, 'folder_id', 'id');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'folder_id', 'id')
            ->orderByDesc('id');
    }

    public function newActivity($id, $folder_name)
    {
        Activity::create([
            'activity' => "Created new folder" . ' : <a href="' . route('folder.index') . '?uuid=' . $id . '">' . $folder_name . "</a>",
            'created_by' => Auth::id(),
            'folder_id' => $id,
        ]);
    }
}
