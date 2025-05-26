<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Link extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'user_id'];
    protected $appends = ['au_rank', 'ratings_count'];

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeAuRankTop($query)
    {
        $query->withSum('ratings', 'score')
            ->orderBy('ratings_sum_score', 'desc')
            ->withCount('ratings')
            ->limit(5);
    }
    public function getAuRankAttribute()
    {
        return $this->ratings()->sum('score');
    }

    public function getRatingsCountAttribute()
    {
        return $this->ratings()->count();
    }
}
