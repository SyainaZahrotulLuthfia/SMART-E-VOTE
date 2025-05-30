<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Candidate extends Model
{
    protected $table = 'candidates';
    protected $fillable = [
        'vote_id',
        'number_candidate',
        'name_candidate',
        'classroom_candidate',
        'image_candidate',
        'vision',
        'mission',
        'is_active',
    ];

    public function vote() : BelongsTo
    {
        return $this->belongsTo(Vote::class);
    }

    public function boxes() : HasMany
    {
        return $this->hasMany(Box::class);
    }
}
