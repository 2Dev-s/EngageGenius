<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'tags',
        'publish_date',
        'twitter',
        'pinterest',
        'linkedin',
        'instagram',
        'facebook',
        'team_id',
        'campain_id',
        'published'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
    public function campain()
    {
        return $this->belongsTo(Campain::class);
    }
    public function photos()
    {
        return $this->hasMany(PostPhoto::class);
    }
}
