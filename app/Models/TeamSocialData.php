<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeamSocialData extends Model
{
    use HasFactory;

    protected $fillable = [
        'twitter_access_token',
        "twitter_access_token_secret",  
        'pinterest',
        'linkedin',
        'facebook',
        'instagram',
    ];

    public function team() : BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
