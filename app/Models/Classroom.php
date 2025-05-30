<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classroom extends Model
{
    protected $table = 'classrooms';
    protected $fillable = [
        'classroom',
        'is_active',

    ];

    public function users() : HasMany
    {
        return $this->hasMany(User::class);
    }
}
