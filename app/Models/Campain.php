<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campain extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "description",
        "niche",
        "tamplate_id",
        "posts_count",
        "product_description",
        "product_features",
        "image_data",
        "discount",
        "cta_text",
        "redirect_link",
        "start_date",
        "end_date",
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function tamplate()
    {
        return $this->belongsTo(PromptTamplate::class);
    }

}
