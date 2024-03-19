<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campain extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'goal',
        'niche',
        'campain_features',
        'tamplate_id',
        'image_data',
        'cta_text',
        'redirect_link',
        'start',
        'end',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

}
