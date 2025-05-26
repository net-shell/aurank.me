<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Evidence extends Model
{
    protected $fillable = ['comment', 'screenshot_path', 'rating_id', 'user_id'];

    public function rating(): BelongsTo
    {
        return $this->belongsTo(Rating::class);
    }
    //
}
