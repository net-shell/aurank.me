<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Link extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'user_id'];

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }
}
