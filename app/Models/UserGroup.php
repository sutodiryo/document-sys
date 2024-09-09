<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserGroup extends Model
{
    use Notifiable, HasUuids;
    protected $fillable = [
        'name',
        'emails',
    ];

    protected function casts(): array
    {
        return [
            // 'emails' => 'array',
            // 'password' => 'hashed',
        ];
    }
}
