<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vote extends Model
{
    protected $table = 'votes';
    protected $fillable = [
        'vote_name',
        'image',
        'start',
        'end',
        'is_active',
    ];

    public function candidates() : HasMany
    {
        return $this->hasMany(Candidate::class);
    }

    public function boxes() : BelongsTo
    {
        return $this->belongsTo(Box::class);
    }
}
